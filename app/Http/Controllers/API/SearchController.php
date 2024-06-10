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
    public function index(Request $requst)
    {
        dd($requst->all());
    }
}
