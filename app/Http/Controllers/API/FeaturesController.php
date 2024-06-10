<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyFeature;

class FeaturesController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        foreach ($features as $feature) {
            $feature->type = mapfeaturetype($feature->type);
            $feature->property_count = PropertyFeature::where('feature_id', $feature->id)->count();
        }
        return response()->json(['message' => 'Features retrieved successfully.', 'data' => $features], 200);
    }

    public function show($id)
    {
        $feature = Feature::find($id);
        if ($feature) {
            $feature->type = mapfeaturetype($feature->type);
            $feature->property_count = PropertyFeature::where('feature_id', $feature->id)->count();
            return response()->json(['message' => 'Feature retrieved successfully.', 'data' => $feature], 200);
        } else {
            return response()->json(['message' => 'Feature not found.'], 404);
        }
    }
}
