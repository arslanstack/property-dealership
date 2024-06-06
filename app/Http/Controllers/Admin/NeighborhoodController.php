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
            'map' => 'required',
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
        $neighborhood->map = $request->map;
        $neighborhood->description = $request->description ?? '';
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . time() . '.' . $extension;
            $file->move('uploads/neighborhoods/', $filename);
            $neighborhood->banner = $filename;
        }
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $neighborhood->code . rand(1, 999) . '.' . $extension;
                $file->move('uploads/neighborhoods/', $filename);
                $images[] = $filename;
            }
            $neighborhood->images = json_encode($images);
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
            $neighborhood->images = $images;
            // dd($neighborhood);
            return view('admin/neighborhoods/edit_neighborhood', ['neighborhood' => $neighborhood]);
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
            'map' => 'required',
        ]);

        if ($validator->fails()) {
            // create a list of all the required fields that are missing and return message
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
        $neighborhood->city = $request->city;
        $neighborhood->map = $request->map;
        $neighborhood->description = $request->description ?? '';
        if ($request->hasFile('banner')) {
            $file_path = public_path('uploads/neighborhoods/' . $neighborhood->banner);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = $neighborhood->code . time() . '.' . $extension;
            $file->move('uploads/neighborhoods/', $filename);
            $neighborhood->banner = $filename;
        }
        // I want existing images to be retained and new images to be added
        // existing:
        // "[\"LJEBM74.webp\",\"LJEBM761.webp\",\"LJEBM425.webp\"]"
        // new : 
        // "[\"LJEBM74.webp\",\"LJEBM761.webp\",\"LJEBM425.webp\",\"LJEBM425.webp\"]"
        if ($request->hasFile('images')) {
            $images = [];
            if (!empty($neighborhood->images)) {
                $images = json_decode($neighborhood->images);
            }
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $neighborhood->code . rand(1, 999) . '.' . $extension;
                $file->move('uploads/neighborhoods/', $filename);
                $images[] = $filename;
            }
            $neighborhood->images = json_encode($images);
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
                return response()->json(['msg' => 'error', 'response' => 'Image not found.']);
            }
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Neighborhood not found.']);
        }
    }
}
