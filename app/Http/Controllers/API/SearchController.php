<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $types = Types::all();
        $property_types = [];
        foreach ($types as $type) {
            $property_types[] = [
                'id' => $type->id,
                'title' => $type->title
            ];
        }
        // return response()->json(['message' => 'Search input options retreived successfully'], 200);
    }
    public function index(Request $requst)
    {
        dd($requst->all());
    }
}
