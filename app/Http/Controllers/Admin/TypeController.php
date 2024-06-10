<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Types;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $query = Types::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%');
            });
        }
        $data['types'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/types/manage_types', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'banner' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => 'Invaid Title For Property Type.'));
        }

        $type = Types::where('title', $request->title)->first();
        if (!empty($type)) {
            return response()->json(array('msg' => 'error', 'response' => 'Property type already exists.'));
        }

        $type = new Types();
        $type->title = $request->title;
        $type->slug = slugify($request->title);
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/types/', $filename);
            $type->banner = $filename;
        }
        $type->save();

        if ($type->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Property type added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function show(Request $request)
    {
        $type = Types::where('id', $request->id)->first();
        if (!empty($type)) {
            $htmlresult = view('admin/types/types_ajax', compact('type'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Property type not found.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => 'Invaid Title For Property Type.'));
        }

        $type = Types::where('title', $request->title)->first();

        if (!empty($type) && $type->id != $request->id) {
            return response()->json(array('msg' => 'error', 'response' => 'Property type with this title already exists.'));
        }

        $type = Types::find($request->id);
        if (!empty($type)) {
            $type->title = $request->title;
            $type->slug = slugify($request->title);
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/types/', $filename);
                $type->banner = $filename;
            }
            $type->save();
            return response()->json(['msg' => 'success', 'response' => 'Property type updated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Property type not found.']);
        }
    }
    public function delete(Request $request)
    {
        $type = Types::find($request->id);
        if (!empty($type)) {
            // delete banner first 
            if (!empty($type->banner)) {
                $file_path = public_path() . '/uploads/types/' . $type->banner;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $type->delete();
            return response()->json(['msg' => 'success', 'response' => 'Property type deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Property type not found.']);
        }
    }
}
