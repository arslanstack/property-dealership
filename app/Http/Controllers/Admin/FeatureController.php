<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use Illuminate\Support\Facades\Validator;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        // Neighborhood ID
        // Listing Status
        // Development Level
        // Rent Cycle
        $query = Feature::query();
        $search_type = $request->input('search_type');
        $search_query = $request->input('search_query');
        if (($request->has('search_query') && !empty($search_query)) || ($request->has('search_type') && !empty($search_type))) {
            if ($search_type == '99') {
                $query->where(function ($query) use ($search_query) {
                    $query->where('title', 'like', '%' . $search_query . '%');
                });
            } else {
                $query->where(function ($query) use ($search_query, $search_type) {
                    $query->where('title', 'like', '%' . $search_query . '%')->where('type', $search_type)
                        ->where('type', $search_type . '%')->where('type', $search_type);
                });
            }
        }
        $data['features'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/features/manage_features', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => 'Invaid Feature Title.'));
        }

        $feature = Feature::where('title', $request->title)->first();
        if (!empty($feature)) {
            return response()->json(array('msg' => 'error', 'response' => 'Feature already exists.'));
        }

        $feature = new Feature();
        $feature->title = $request->title;
        $feature->slug = slugify($request->title);
        $feature->type = $request->type;
        $feature->save();

        if ($feature->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Feature added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function show(Request $request)
    {
        $feature = Feature::where('id', $request->id)->first();
        if (!empty($feature)) {
            $htmlresult = view('admin/features/feature_ajax', compact('feature'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Feature not found.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => 'Invaid Feature Title.'));
        }

        $feature = Feature::where('title', $request->title)->first();

        if (!empty($feature) && $feature->id != $request->id) {
            return response()->json(array('msg' => 'error', 'response' => 'Feature with this title already exists.'));
        }

        $feature = Feature::find($request->id);
        if (!empty($feature)) {
            $feature->title = $request->title;
            $feature->slug = slugify($request->title);
            $feature->type = $request->type;
            $feature->save();
            return response()->json(['msg' => 'success', 'response' => 'Feature updated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Feature not found.']);
        }
    }
    public function delete(Request $request)
    {
        $feature = Feature::find($request->id);
        if (!empty($feature)) {
            $feature->delete();
            return response()->json(['msg' => 'success', 'response' => 'Feature deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Feature not found.']);
        }
    }
}
