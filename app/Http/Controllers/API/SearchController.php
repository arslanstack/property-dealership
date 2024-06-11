<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Neighborhood;
use App\Models\Types;
use App\Models\Feature;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
use App\Models\User;

class SearchController extends Controller
{
    public function input()
    {

        $city = City::all();
        $property_cities = [];
        foreach ($city as $city) {
            $property_cities[] = [
                'id' => $city->id,
                'name' => $city->name
            ];
        }

        $types = Types::all();
        $property_types = [];
        foreach ($types as $type) {
            $property_types[] = [
                'id' => $type->id,
                'title' => $type->title
            ];
        }

        $features = Feature::all();
        $property_features = [];
        foreach ($features as $feature) {
            $property_features[] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'feature_type' => mapfeaturetype($feature->type)
            ];
        }
        return response()->json(['message' => 'Search input options retreived successfully', 'cities' => $property_cities], 200);
    }
    public function index(Request $requst)
    {
        dd($requst->all());
    }
}
