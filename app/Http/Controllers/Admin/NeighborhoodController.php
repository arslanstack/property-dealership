<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Neighborhood;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;

class NeighborhoodController extends Controller
{
    public function index(Request $request)
    {
        $query = Neighborhood::query();
        // $search_type = $request->input('search_type');
        $search_query = $request->input('search_query');
        if (($request->has('search_query') && !empty($search_query))) {
            $query->where(function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%')
                    ->orWhere('code', 'like', '%' . $search_query . '%')
                    ->orWhere('zip', 'like', '%' . $search_query . '%')
                    ->orWhere('country', 'like', '%' . $search_query . '%')
                    ->orWhere('state', 'like', '%' . $search_query . '%')
                    ->orWhere('city', 'like', '%' . $search_query . '%');
            });
        }
        $data['neighborhoods'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/neighborhoods/manage_neighborhoods', $data);
    }

    public function add()
    {
        $cities = City::all();
        return view('admin/neighborhoods/add_neighborhood', compact('cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'banner' => 'required',
            'zip' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        };

        $city = City::where('name', $request->city)->first();
        $neighborhood = new Neighborhood();
        $neighborhood->title = $request->title;
        $neighborhood->slug = slugify($request->title) . rand(1, 99);
        $neighborhood->code = NHCodes($request->title, $city->state, $city->country);
        $neighborhood->zip = $request->zip;
        $neighborhood->country = $city->country ?? '';
        $neighborhood->state = $city->state ?? '';
        $neighborhood->city = $city->name;
        $neighborhood->amenity_title1 = $request->amenity_title1 ?? '';
        $neighborhood->amenity_title2 = $request->amenity_title2 ?? '';
        $neighborhood->amenity_title3 = $request->amenity_title3 ?? '';
        $neighborhood->amenity_desc1 = $request->amenity_desc1 ?? '';
        $neighborhood->amenity_desc2 = $request->amenity_desc2 ?? '';
        $neighborhood->amenity_desc3 = $request->amenity_desc3 ?? '';
        $neighborhood->images = $request->images;
        $neighborhood->latitude = $request->latitude;
        $neighborhood->longitude = $request->longitude;
        $neighborhood->description = $request->description ?? '';

        if ($request->has('amenity_icon1')) {
            $file = $request->file('amenity_icon1');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . 1 . time() . '.' . $extension;
            $file->move(public_path('uploads/amenities/'), $filename);
            $neighborhood->amenity_icon1 = $filename;
        }
        if ($request->has('amenity_icon2')) {
            $file = $request->file('amenity_icon2');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . 2 . time() . '.' . $extension;
            $file->move(public_path('uploads/amenities/'), $filename);
            $neighborhood->amenity_icon2 = $filename;
        }
        if ($request->has('amenity_icon3')) {
            $file = $request->file('amenity_icon3');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . 3 . time() . '.' . $extension;
            $file->move(public_path('uploads/amenities/'), $filename);
            $neighborhood->amenity_icon3 = $filename;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . time() . '.' . $extension;
            $file->move(public_path('uploads/neighborhoods/'), $filename);
            $neighborhood->banner = $filename;
        }
        $query = $neighborhood->save();
        if ($query) {
            return redirect('admin/neighborhoods')->with('success', 'Neighborhood added successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {

        $neighborhood = Neighborhood::where('id', $id)->first();
        if (!empty($neighborhood)) {
            $cities = City::all();
            $images = [];
            if (!empty($neighborhood->images)) {
                $images = json_decode($neighborhood->images);
                foreach ($images as $key => $image) {
                    $images[$key] = asset('uploads/neighborhoods/' . $image);
                }
            }
            $images_array = json_encode($images);
            $neighborhood->images = $images;
            return view('admin/neighborhoods/edit_neighborhood', ['neighborhood' => $neighborhood, 'cities' => $cities, 'images_array' => $images_array]);
        } else {
            return back()->with('error', 'Neighborhood not found');
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'zip' => 'required',
            'city' => 'required',
        ]);

        $images_urls = json_decode($request->images);
        foreach ($images_urls as $key => $url) {
            $parsedUrl = parse_url($url, PHP_URL_PATH);
            $filename = basename($parsedUrl);
            $images_urls[$key] = $filename;
        }
        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        };

        $neighborhood = Neighborhood::where('id', $request->id)->first();
        if (empty($neighborhood)) {
            return back()->with('error', 'Neighborhood not found');
        }
        $city = City::where('name', $request->city)->first();
        $neighborhood->title = $request->title;
        $neighborhood->slug = slugify($request->title) . rand(1, 99);
        $neighborhood->code = NHCodes($request->title, $city->state, $city->country);
        $neighborhood->zip = $request->zip;
        $neighborhood->country = $city->country ?? '';
        $neighborhood->state = $city->state ?? '';
        $neighborhood->city = $city->name;
        $neighborhood->amenity_title1 = $request->amenity_title1 ?? '';
        $neighborhood->amenity_title2 = $request->amenity_title2 ?? '';
        $neighborhood->amenity_title3 = $request->amenity_title3 ?? '';
        $neighborhood->amenity_desc1 = $request->amenity_desc1 ?? '';
        $neighborhood->amenity_desc2 = $request->amenity_desc2 ?? '';
        $neighborhood->amenity_desc3 = $request->amenity_desc3 ?? '';
        $neighborhood->images = json_encode($images_urls);
        $neighborhood->latitude = $request->latitude;
        $neighborhood->longitude = $request->longitude;
        $neighborhood->description = $request->description ?? '';
        if ($request->hasFile('banner')) {
            $file_path = public_path('uploads/neighborhoods/' . $neighborhood->banner);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . time() . '.' . $extension;
            $file->move(public_path('uploads/neighborhoods/'), $filename);
            $neighborhood->banner = $filename;
        }
        if ($request->has('amenity_icon1')) {
            $file_path = public_path('uploads/amenities/' . $neighborhood->amenity_icon1);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $file = $request->file('amenity_icon1');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . 1 . time() . '.' . $extension;
            $file->move(public_path('uploads/amenities/'), $filename);
            $neighborhood->amenity_icon1 = $filename;
        }
        if ($request->has('amenity_icon2')) {
            $file_path = public_path('uploads/amenities/' . $neighborhood->amenity_icon2);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $file = $request->file('amenity_icon2');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . 2 . time() . '.' . $extension;
            $file->move(public_path('uploads/amenities/'), $filename);
            $neighborhood->amenity_icon2 = $filename;
        }
        if ($request->has('amenity_icon3')) {
            $file_path = public_path('uploads/amenities/' . $neighborhood->amenity_icon3);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $file = $request->file('amenity_icon3');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . 3 . time() . '.' . $extension;
            $file->move(public_path('uploads/amenities/'), $filename);
            $neighborhood->amenity_icon3 = $filename;
        }
        $query = $neighborhood->save();
        if ($query) {
            return back()->with('success', 'Neighborhood updated successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    public function delete(Request $request)
    {
        $neighborhood = Neighborhood::where('id', $request->id)->first();
        if (!empty($neighborhood)) {
            $properties = Property::where('neighborhood_id', $neighborhood->id)->count();
            if ($properties > 0) {
                return response()->json(['msg' => 'error', 'response' => 'Neighborhood cannot be deleted because it has property listings associated with it.']);
            }
            if (!empty($neighborhood->banner)) {
                $file_path = public_path('uploads/neighborhoods/' . $neighborhood->banner);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                if (!empty($neighborhood->amenity_icon1)) {
                    $file_path = public_path('uploads/neighborhoods/' . $neighborhood->amenity_icon1);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                if (!empty($neighborhood->amenity_icon2)) {
                    $file_path = public_path('uploads/neighborhoods/' . $neighborhood->amenity_icon2);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                if (!empty($neighborhood->amenity_icon3)) {
                    $file_path = public_path('uploads/neighborhoods/' . $neighborhood->amenity_icon3);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                if (!empty($neighborhood->images)) {
                    $images = json_decode($neighborhood->images);
                    foreach ($images as $image) {
                        $file_path = public_path('uploads/neighborhoods/' . $image);
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                }
            }
            $query = Neighborhood::where('id', $request->id)->delete();
            if ($query) {
                return response()->json(['msg' => 'success', 'response' => 'Neighborhood deleted successfully.']);
            } else {
                return response()->json(['msg' => 'error', 'response' => 'Something went wrong.']);
            }
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Neighborhood not found.']);
        }
    }

    public function deleteImage(Request $request)
    {
        $url = $request->url;
        $parsedUrl = parse_url($url, PHP_URL_PATH);
        $filename = basename($parsedUrl);
        $neighborhood = Neighborhood::where('id', $request->id)->first();

        if (!empty($neighborhood)) {
            $images = json_decode($neighborhood->images);
            $key = array_search($filename, $images);
            if ($key !== false) {
                unset($images[$key]);
                $images = array_values($images);
                $neighborhood->images = json_encode($images);
                $query = $neighborhood->save();
                if ($query) {
                    $file_path = public_path('uploads/neighborhoods/' . $filename);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    return response()->json(['msg' => 'success', 'response' => 'Image deleted successfully.']);
                } else {
                    return response()->json(['msg' => 'error', 'response' => 'Something went wrong.']);
                }
            } else {
                // just delete the image from the folder
                $file_path = public_path('uploads/neighborhoods/' . $filename);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                return response()->json(['msg' => 'success', 'response' => 'Image deleted successfully.']);
            }
        } else {
            $file_path = public_path('uploads/neighborhoods/' . $filename);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            return response()->json(['msg' => 'success', 'response' => 'Image deleted successfully.']);
        }
    }
    public function imageManagement(Request $request)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $image_name = rand(1, 999) . time() . '.' . $file->getClientOriginalExtension();
            if ($file->move(public_path('uploads/neighborhoods'), $image_name)) {
                return response()->json([
                    'status' => 'success',
                    'image' => $image_name,
                    'image_url' => asset('uploads/neighborhoods/' . $image_name)
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Image could not be uploaded.'
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No files uploaded.'
            ], 400);
        }
    }

    public function addCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'error', 'response' => 'City Name is required!']);
        }
        $city = new City();
        $city->name = $request->name;
        $city->state = $request->state ?? '';
        $city->country = $request->country ?? '';
        $city->slug = slugify($request->name);
        $city->save();

        if ($city->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'City added successfully.', 'city' => $city]);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }
}
