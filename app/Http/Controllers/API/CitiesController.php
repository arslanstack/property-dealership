<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return response()->json(['message' => 'Cities retrieved successfully', 'data' => $cities], 200);
    }

    public function show($id)
    {
        $city = City::find($id);
        if ($city) {
            return response()->json(['message' => 'City retrieved successfully', 'data' => $city], 200);
        } else {
            return response()->json(['message' => 'City not found'], 404);
        }
    }
}
