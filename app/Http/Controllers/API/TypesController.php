<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\Types;

class TypesController extends Controller
{
    public function index()
    {
        $types = Types::all();
        foreach ($types as $type) {
            $type->banner = asset('uploads/types/' . $type->banner);
            $type->property_count = PropertyType::where('type_id', $type->id)->count();
        }
        return response()->json(['message' => 'Types retrieved successfully.', 'data' => $types], 200);
    }
}
