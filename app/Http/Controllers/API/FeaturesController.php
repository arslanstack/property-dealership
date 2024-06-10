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
            if ($feature->type == 1) {
                $feature->type = mapfeaturetype($feature->type);
            }
            $feature->property_count = PropertyFeature::where('feature_id', $feature->id)->count();
        }
        return response()->json(['message' => 'Features retrieved successfully.', 'data' => $features], 200);
    }
}
