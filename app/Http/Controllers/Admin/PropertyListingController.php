<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
use App\Models\Feature;
use App\Models\Types;
use App\Models\Neighborhood;

class PropertyListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();
        // $search_type = $request->input('search_type');
        $search_query = $request->input('search_query');
        if (($request->has('search_query') && !empty($search_query))) {
            $query->where(function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%')
                    ->orWhere('code', 'like', '%' . $search_query . '%')
                    ->orWhere('address', 'like', '%' . $search_query . '%')
                    ->orWhere('country', 'like', '%' . $search_query . '%')
                    ->orWhere('state', 'like', '%' . $search_query . '%')
                    ->orWhere('city', 'like', '%' . $search_query . '%');
            });
        }
        $data['properties'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/property/manage_properties', $data);
    }
}
