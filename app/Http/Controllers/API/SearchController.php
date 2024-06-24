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
use App\Models\SearchSave;
use Tymon\JWTAuth\Facades\JWTAuth;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['input', 'index', 'refine', 'feature_mapping']]);
    }
    public function input()
    {
        $sorting = [
            ['id' => '1', 'title' => 'default'],
            ['id' => '2', 'title' => 'Featured'],
            ['id' => '3', 'title' => 'Most Viewed'],
            ['id' => '4', 'title' => 'Price (Low to High)'],
            ['id' => '5', 'title' => 'Price (High to Low)'],
            ['id' => '6', 'title' => 'Date (Old to New)'],
            ['id' => '7', 'title' => 'Date (New to Old)'],
        ];
        $min_bed = [
            ['id' => 0, 'title' => 'Any'],
            ['id' => 1, 'title' => '1'],
            ['id' => 2, 'title' => '2'],
            ['id' => 3, 'title' => '3'],
            ['id' => 4, 'title' => '4'],
            ['id' => 5, 'title' => '5'],
            ['id' => 6, 'title' => '6'],
            ['id' => 7, 'title' => '7'],
            ['id' => 8, 'title' => '8'],
            ['id' => 9, 'title' => '9'],
            ['id' => 10, 'title' => '10'],
            ['id' => 11, 'title' => 'More than 10'],
        ];

        $min_bath = [
            ['id' => 0, 'title' => 'Any'],
            ['id' => 1, 'title' => '1'],
            ['id' => 2, 'title' => '2'],
            ['id' => 3, 'title' => '3'],
            ['id' => 4, 'title' => '4'],
            ['id' => 5, 'title' => '5'],
            ['id' => 6, 'title' => '6'],
            ['id' => 7, 'title' => '7'],
            ['id' => 8, 'title' => '8'],
            ['id' => 9, 'title' => '9'],
            ['id' => 10, 'title' => '10'],
            ['id' => 11, 'title' => 'More than 10'],
        ];

        $listing_status = [
            ['id' => 1, 'title' => 'For Sale'],
            ['id' => 2, 'title' => 'For Rent'],
            ['id' => 3, 'title' => 'Rented'],
            ['id' => 4, 'title' => 'Sale Pending'],
            ['id' => 5, 'title' => 'Sold']
        ];

        $neighborhoods = Neighborhood::all();
        $property_neighborhoods = [];
        foreach ($neighborhoods as $neighborhood) {
            $property_neighborhoods[] = [
                'id' => $neighborhood->id,
                'title' => $neighborhood->title,
                'code' => $neighborhood->code
            ];
        }

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

        $interior_features = Feature::where('type', 1)->get();
        $exterior_finish = Feature::where('type', 2)->get();
        $featured_amenities = Feature::where('type', 3)->get();
        $appliances = Feature::where('type', 4)->get();
        $views = Feature::where('type', 5)->get();
        $heatings = Feature::where('type', 6)->get();
        $coolings = Feature::where('type', 7)->get();
        $roofs = Feature::where('type', 8)->get();
        $sewer_water_systems = Feature::where('type', 9)->get();
        $extra_features = Feature::where('type', 10)->get();
        $property_features = [];
        foreach ($interior_features as $feature) {
            $property_features['interior_features'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($exterior_finish as $feature) {
            $property_features['exterior_finish'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($featured_amenities as $feature) {
            $property_features['featured_amenities'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($appliances as $feature) {
            $property_features['appliances'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($views as $feature) {
            $property_features['views'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($heatings as $feature) {
            $property_features['heatings'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($coolings as $feature) {
            $property_features['coolings'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($roofs as $feature) {
            $property_features['roofs'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($sewer_water_systems as $feature) {
            $property_features['sewer_water_systems'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        foreach ($extra_features as $feature) {
            $property_features['extra_features'][] = [
                'id' => $feature->id,
                'title' => $feature->title,
                'slug' => $feature->slug
            ];
        }
        $data = [
            'sorting' => $sorting,
            'min_bed' => $min_bed,
            'min_bath' => $min_bath,
            'listing_status' => $listing_status,
            'neighborhoods' => $property_neighborhoods,
            'cities' => $property_cities,
            'types' => $property_types,
            'features' => $property_features
        ];
        return response()->json(['message' => 'Search input options retreived successfully', 'data' => $data], 200);
    }
    public function index(Request $request)
    {
        // dd($request->all());
        $properties = Property::query();
        $min_price = $request->min_price ? intval($request->min_price) : 0;
        $max_price = $request->max_price ? intval($request->max_price) : 0;
        $min_bed = $request->min_bed ? intval($request->min_bed) : 0;
        $min_bath = $request->min_bath ? intval($request->min_bath) : 0;
        $min_size = $request->min_size ? intval($request->min_size) : 0;
        $max_size = $request->max_size ? intval($request->max_size) : 0;
        $neighborhood_id = $request->neighborhood_id;
        $city_id = $request->city_id;
        $type_id = $request->type_id;
        $features_id_array = $request->features_id_array;
        $listing_status = $request->listing_status;
        $title = $request->title;
        $sorting = $request->sorting ? $request->sorting : 1;

        $city = $request->city_id != null ? City::where('id', $request->city_id)->first() : null;
        if ($min_price > 0) {
            $properties = $properties->where('price', '>=', $min_price);
        }

        if ($max_price > 0) {
            $properties = $properties->where('price', '<=', $max_price);
        }

        if ($min_bed > 0) {
            $properties = $properties->where('bedrooms', '>=', $min_bed);
        }

        if ($min_bath > 0) {
            $properties = $properties->where('bathrooms', '>=', $min_bath);
        }

        if ($min_size > 0) {
            $properties = $properties->where('size', '>=', $min_size);
        }

        if ($max_size > 0) {
            $properties = $properties->where('size', '<=', $max_size);
        }

        if ($listing_status != '' && $listing_status != null) {
            $properties = $properties->where('listing_status', $request->listing_status);
        }
        if ($neighborhood_id != '' && $neighborhood_id != null) {
            $neighborhood = Neighborhood::where('id', $request->neighborhood_id)->first();
            if (!$neighborhood) {
                return response()->json(['message' => 'Neighborhood not found.'], 404);
            }
            $properties = $properties->where('neighborhood_id', $neighborhood->id);
        }
        if ($city_id != '' && $city_id != null) {
            $city = City::where('id', $city_id)->first();
            if (!$city) {
                return response()->json(['message' => 'City not found.'], 404);
            }
            $properties = $properties->where('city', $city->name);
        }
        if ($type_id != '' && $type_id != null) {
            $type = Types::where('id', $request->type_id)->first();
            if (!$type) {
                return response()->json(['message' => 'Type not found.'], 404);
            }
            $property_types = PropertyType::where('type_id', $type->id)->get();
            $property_ids = [];
            foreach ($property_types as $property_type) {
                $property_ids[] = $property_type->property_id;
            }
            $properties = $properties->whereIn('id', $property_ids);
        }

        if ($features_id_array != '' && $features_id_array != null) {
            // features_id_array input is like [1,56,12]
            $features_id_array = json_decode($request->features_id_array);
            $property_features = PropertyFeature::whereIn('feature_id', $features_id_array)->get();
            $property_ids = [];
            foreach ($property_features as $property_feature) {
                $property_ids[] = $property_feature->property_id;
            }
            $properties = $properties->whereIn('id', $property_ids);
        }

        if ($title != '' && $title != null) {
            $properties = $properties->where('title', 'like', '%' . $request->title . '%');
        }

        switch ($sorting) {
            case 2:
                $properties = $properties->orderBy('is_featured', 'desc');
                break;
            case 3:
                $properties = $properties->orderBy('views', 'desc');
                break;
            case 4:
                $properties = $properties->orderBy('price');
                break;
            case 5:
                $properties = $properties->orderBy('price', 'desc');
                break;
            case 6:
                $properties = $properties->orderBy('created_at');
                break;
            case 7:
                $properties = $properties->orderBy('created_at', 'desc');
                break;
            default:
                $properties = $properties->orderBy('created_at', 'desc');  // Default sorting
                break;
        }

        $properties = $properties->paginate(6);

        foreach ($properties as $property) {
            $property = $this->refine($property);
        }

        if ($request->page) {
            return response()->json(['message' => 'Properties retrieved successfully.', 'data' => $properties], 200);
        } else {
            try {
                $user = JWTAuth::parseToken()->authenticate();
                if ($user) {
                    $user = auth()->user();
                    $search = SearchSave::where('user_id', $user->id)->where('search_query', json_encode($request->all()))->first();
                    if (!$search) {
                        $search = new SearchSave();
                        $search->user_id = $user->id;
                        $search->title = $request->title;
                        $search->search_query = json_encode($request->all());
                        $search->save();
                    } else {
                        $search->touch();
                    }
                }
                return response()->json(['message' => 'Properties retrieved successfully.', 'data' => $properties], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Properties retrieved successfully.', 'data' => $properties], 200);
            }
        }
    }



    public function savedSearches(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $searches = SearchSave::where('user_id', $user->id)->get();
        return response()->json(['message' => 'Saved searches retreived successfully', 'data' => $searches], 200);
    }
    public function savedSearchResults($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $search = SearchSave::where('user_id', $user->id)->where('id', $id)->first();
        if (!$search) {
            return response()->json(['message' => 'Search not found.'], 404);
        }
        $search_query = json_decode($search->search_query);

        $properties = Property::query();
        $min_price = $search_query->min_price ? intval($search_query->min_price) : 0;
        $max_price = $search_query->max_price ? intval($search_query->max_price) : 0;
        $min_bed = $search_query->min_bed ? intval($search_query->min_bed) : 0;
        $min_bath = $search_query->min_bath ? intval($search_query->min_bath) : 0;
        $min_size = $search_query->min_size ? intval($search_query->min_size) : 0;
        $max_size = $search_query->max_size ? intval($search_query->max_size) : 0;
        $neighborhood_id = $search_query->neighborhood_id;
        $city_id = $search_query->city_id;
        $type_id = $search_query->type_id;
        $features_id_array = $search_query->features_id_array;
        $listing_status = $search_query->listing_status;
        $title = $search_query->title;
        $sorting = $search_query->sorting ? $search_query->sorting : 1;

        $city = $search_query->city_id != null ? City::where('id', $search_query->city_id)->first() : null;
        if ($min_price > 0) {
            $properties = $properties->where('price', '>=', $min_price);
        }

        if ($max_price > 0) {
            $properties = $properties->where('price', '<=', $max_price);
        }

        if ($min_bed > 0) {
            $properties = $properties->where('bedrooms', '>=', $min_bed);
        }

        if ($min_bath > 0) {
            $properties = $properties->where('bathrooms', '>=', $min_bath);
        }

        if ($min_size > 0) {
            $properties = $properties->where('size', '>=', $min_size);
        }

        if ($max_size > 0) {
            $properties = $properties->where('size', '<=', $max_size);
        }

        if ($listing_status != '' && $listing_status != null) {
            $properties = $properties->where('listing_status', $search_query->listing_status);
        }
        if ($neighborhood_id != '' && $neighborhood_id != null) {
            $neighborhood = Neighborhood::where('id', $search_query->neighborhood_id)->first();
            if (!$neighborhood) {
                return response()->json(['message' => 'Neighborhood not found.'], 404);
            }
            $properties = $properties->where('neighborhood_id', $neighborhood->id);
        }
        if ($city_id != '' && $city_id != null) {
            $city = City::where('id', $city_id)->first();
            if (!$city) {
                return response()->json(['message' => 'City not found.'], 404);
            }
            $properties = $properties->where('city', $city->name);
        }
        if ($type_id != '' && $type_id != null) {
            $type = Types::where('id', $search_query->type_id)->first();
            if (!$type) {
                return response()->json(['message' => 'Type not found.'], 404);
            }
            $property_types = PropertyType::where('type_id', $type->id)->get();
            $property_ids = [];
            foreach ($property_types as $property_type) {
                $property_ids[] = $property_type->property_id;
            }
            $properties = $properties->whereIn('id', $property_ids);
        }

        if ($features_id_array != '' && $features_id_array != null) {
            // features_id_array input is like [1,56,12]
            $features_id_array = json_decode($search_query->features_id_array);
            $property_features = PropertyFeature::whereIn('feature_id', $features_id_array)->get();
            $property_ids = [];
            foreach ($property_features as $property_feature) {
                $property_ids[] = $property_feature->property_id;
            }
            $properties = $properties->whereIn('id', $property_ids);
        }

        if ($title != '' && $title != null) {
            $properties = $properties->where('title', 'like', '%' . $search_query->title . '%');
        }

        // if ($sorting) {
        //     if ($sorting == 2) {
        //         $properties = $properties->orderByDesc('is_featured');
        //     } elseif ($sorting == 3) {
        //         $properties = $properties->orderByDesc('views');
        //     } elseif ($sorting == 4) {
        //         $properties = $properties->orderBy('price');
        //     } elseif ($sorting == 5) {
        //         $properties = $properties->orderByDesc('price');
        //     } elseif ($sorting == 6) {
        //         $properties = $properties->orderBy('created_at');
        //     } elseif ($sorting == 7) {
        //         $properties = $properties->orderByDesc('created_at');
        //     } else {
        //         $properties = $properties->orderByDesc('created_at');
        //     }
        // }

        $properties = $properties->paginate(6);
        $properties = $properties->map(function ($property) {
            return $this->refine($property);
        });

        return response()->json(['message' => 'Properties from saved search retrieved successfully.', 'data' => $properties], 200);
    }
    public function refine($property)
    {
        $property->banner = asset('uploads/properties/' . $property->banner);
        $gallery = json_decode($property->gallery);
        foreach ($gallery as $key => $image) {
            $gallery[$key] = asset('uploads/properties/' . $image);
        }
        $property->gallery = $gallery;
        $property->neighborhood = $property->neighborhood;
        $property->neighborhood->banner = asset('uploads/neighborhoods/' . $property->neighborhood->banner);
        unset($property->neighborhood->map);
        unset($property->neighborhood->images);
        unset($property->neighborhood->description);
        $property->development_level = developmentlvl($property->dev_lvl);
        unset($property->map);
        unset($property->neighborhood_id);
        unset($property->dev_lvl);
        if ($property->listing_type == 1) {
            $property->listing_type = 'buy';
            unset($property->rent_cycle);
            unset($property->date_available);
        } else if ($property->listing_type == 2) {
            $property->listing_type = 'rent';
            unset($property->property_tax);
            unset($property->hoa_fees);
        }
        if ($property->is_featured == 2) {
            $property->is_featured = true;
        } elseif ($property->is_featured == 1) {
            $property->is_featured = false;
        }
        $property->listing_status = mapListingStatus($property->listing_status);
        $property->rent_cycle = mapRentCycle($property->rent_cycle);
        $interior_features = Feature::where('type', 1)->get();
        $exterior_finish = Feature::where('type', 2)->get();
        $featured_amenities = Feature::where('type', 3)->get();
        $appliances = Feature::where('type', 4)->get();
        $views = Feature::where('type', 5)->get();
        $heatings = Feature::where('type', 6)->get();
        $coolings = Feature::where('type', 7)->get();
        $roofs = Feature::where('type', 8)->get();
        $sewer_water_systems = Feature::where('type', 9)->get();
        $extra_features = Feature::where('type', 10)->get();
        $property_features = PropertyFeature::where('property_id', $property->id)->get();
        $features['interior_features'] = $this->feature_mapping($interior_features, $property_features);
        $features['exterior_finish'] = $this->feature_mapping($exterior_finish, $property_features);
        $features['featured_amenities'] = $this->feature_mapping($featured_amenities, $property_features);
        $features['appliances'] = $this->feature_mapping($appliances, $property_features);
        $features['views'] = $this->feature_mapping($views, $property_features);
        $features['heatings'] = $this->feature_mapping($heatings, $property_features);
        $features['coolings'] = $this->feature_mapping($coolings, $property_features);
        $features['roofs'] = $this->feature_mapping($roofs, $property_features);
        $features['sewer_water_systems'] = $this->feature_mapping($sewer_water_systems, $property_features);
        $features['extra_features'] = $this->feature_mapping($extra_features, $property_features);
        $property->features = $features;
        $types = Types::all();
        $property_types = PropertyType::where('property_id', $property->id)->get();
        $property_types = $property_types->map(function ($property_type) use ($types) {
            return $types->where('id', $property_type->type_id)->first();
        });
        $property->types = $property_types;
        return $property;
    }
    public function feature_mapping($features, $property_features)
    {
        foreach ($features as $feature) {
            $found = false;
            foreach ($property_features as $property_feature) {
                if ($property_feature->feature_id == $feature->id) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $features = $features->except($feature->id);
            }
        }
        return $features;
    }
}
