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
            $neighborhood->property_count = Property::where('neighborhood_id', $neighborhood->id)->count();
        }
        return response()->json(['message' => 'Neighborhoods retrieved successfully.', 'data' => $neighborhoods], 200);
    }
}
