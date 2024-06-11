<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('name', 'like', '%' . $search_query . '%')
                    ->orWhere('state', 'like', '%' . $search_query . '%')
                    ->orWhere('country', 'like', '%' . $search_query . '%');
            });
        }
        $data['cities'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/cities/manage_cities', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'error', 'response' => 'City Name is required!']);
        }

        $city = new City();
        $city->name = $request->name;
        $city->state = $request->state ?? '';
        $city->country = $request->country ?? '';
        $city->slug = slugify($request->name);
        $city->save();

        if ($city->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'City added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function show(Request $request)
    {
        $city = City::where('id', $request->id)->first();
        if (!empty($city)) {
            $htmlresult = view('admin/cities/cities_ajax', compact('city'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg' => 'error', 'response' => 'City not found.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'error', 'response' => 'City Name is required!']);
        }
        $city = City::where('id', $request->id)->first();
        if (!empty($city)) {
            $city->name = $request->name;
            $city->state = $request->state ?? '';
            $city->country = $request->country ?? '';
            $city->slug = slugify($request->name);
            $city->save();
            return response()->json(['msg' => 'success', 'response' => 'City updated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'City not found.']);
        }
    }
    public function delete(Request $request)
    {
        $city = City::find($request->id);
        if (!empty($city)) {
            $city->delete();
            return response()->json(['msg' => 'success', 'response' => 'City deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'City not found.']);
        }
    }
}
