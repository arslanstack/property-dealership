<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('name', 'like', '%' . $search_query . '%');
            });
        }
        $data['testimonials'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/testimonials/manage_testimonials', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'designation' => 'required',
            'location' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        }

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->content = $request->content;
        $testimonial->designation = $request->designation;
        $testimonial->location = $request->location;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/testimonials/'), $filename);
            $testimonial->image = $filename;
        }
        $testimonial->save();

        if ($testimonial->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Testimonial added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function show(Request $request)
    {
        $testimonial = Testimonial::where('id', $request->id)->first();
        if (!empty($testimonial)) {
            $htmlresult = view('admin/testimonials/testimonials_ajax', compact('testimonial'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Testimonial not found.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'designation' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        }
        $testimonial = Testimonial::where('id', $request->id)->first();
        if (!empty($testimonial)) {
            $testimonial->name = $request->name;
            $testimonial->content = $request->content;
            $testimonial->designation = $request->designation;
            $testimonial->location = $request->location;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/testimonials/'), $filename);
                $testimonial->image = $filename;
            }
            $testimonial->save();
            return response()->json(['msg' => 'success', 'response' => 'Testimonial updated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Testimonial not found.']);
        }
    }
    public function delete(Request $request)
    {
        $testimonial = Testimonial::find($request->id);
        if (!empty($testimonial)) {
            // delete image first 
            if (!empty($testimonial->image)) {
                $file_path = public_path() . '/uploads/testimonials/' . $testimonial->image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $testimonial->delete();
            return response()->json(['msg' => 'success', 'response' => 'Testimonial deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Testimonial not found.']);
        }
    }
}
