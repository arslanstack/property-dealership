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
        $neighborhood->slug = slugify($request->title);
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
}
