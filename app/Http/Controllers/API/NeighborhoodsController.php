<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Neighborhood;
use App\Models\Property;

class NeighborhoodsController extends Controller
{
    public function index()
    {
        $neighborhoods = Neighborhood::all();
        foreach ($neighborhoods as $neighborhood) {
            $neighborhood->banner = asset('uploads/neighborhoods/' . $neighborhood->banner);
            $images = json_decode($neighborhood->images);
            $neighborhood_images = [];
            foreach ($images as $image) {
                $neighborhood_images[] = asset('uploads/neighborhoods/' . $image);
            }
            $neighborhood->images = $neighborhood_images;
            $neighborhood->property_count = Property::where('neighborhood_id', $neighborhood->id)->count();
        }
        return response()->json(['message' => 'Neighborhoods retrieved successfully.', 'data' => $neighborhoods], 200);
    }

    public function show($id)
    {
        $neighborhood = Neighborhood::find($id);
        if ($neighborhood) {
            $neighborhood->banner = asset('uploads/neighborhoods/' . $neighborhood->banner);
            $images = json_decode($neighborhood->images);
            $neighborhood_images = [];
            foreach ($images as $image) {
                $neighborhood_images[] = asset('uploads/neighborhoods/' . $image);
            }
            $neighborhood->images = $neighborhood_images;
            $neighborhood->property_count = Property::where('neighborhood_id', $neighborhood->id)->count();
            return response()->json(['message' => 'Neighborhood retrieved successfully.', 'data' => $neighborhood], 200);
        } else {
            return response()->json(['message' => 'Neighborhood not found.'], 404);
        }
    }
}
