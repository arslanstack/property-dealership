<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Neighborhood;
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
        return view('admin/neighborhoods/add_neighborhood');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'banner' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            // create a list of all the required fields that are missing and return message
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        };
        $neighborhood = new Neighborhood();
        $neighborhood->title = $request->title;
        $neighborhood->slug = slugify($request->title) . rand(1, 99);
        $neighborhood->code = NHCodes($request->title, $request->state, $request->country);
        $neighborhood->zip = $request->zip;
        $neighborhood->country = $request->country;
        $neighborhood->state = $request->state;
        $neighborhood->city = $request->city;
        $neighborhood->images = $request->images;
        $neighborhood->latitude = $request->latitude;
        $neighborhood->longitude = $request->longitude;
        $neighborhood->description = $request->description ?? '';
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
            $images = [];
            if (!empty($neighborhood->images)) {
                $images = json_decode($neighborhood->images);
                foreach ($images as $key => $image) {
                    $images[$key] = asset('uploads/neighborhoods/' . $image);
                }
            }
            $images_array = json_encode($images);
            $neighborhood->images = $images;
            return view('admin/neighborhoods/edit_neighborhood', ['neighborhood' => $neighborhood, 'images_array' => $images_array]);
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
            'country' => 'required',
            'state' => 'required',
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
        $neighborhood->title = $request->title;
        $neighborhood->slug = slugify($request->title) . rand(1, 99);
        $neighborhood->code = NHCodes($request->title, $request->state, $request->country);
        $neighborhood->zip = $request->zip;
        $neighborhood->country = $request->country;
        $neighborhood->state = $request->state;
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
            if (!empty($neighborhood->banner)) {
                $file_path = public_path('uploads/neighborhoods/' . $neighborhood->banner);
                if (file_exists($file_path)) {
                    unlink($file_path);
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
}
