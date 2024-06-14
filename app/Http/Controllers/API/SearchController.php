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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
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
            ['0' => 'Any'],
            ['1' => '1'],
            ['2' => '2'],
            ['3' => '3'],
            ['4' => '4'],
            ['5' => '5'],
            ['6' => '6'],
            ['7' => '7'],
            ['8' => '8'],
            ['9' => '9'],
            ['10' => '10'],
            ['11' => 'More than 10'],
        ];

        $min_bath = [
            ['0' => 'Any'],
            ['1' => '1'],
            ['2' => '2'],
            ['3' => '3'],
            ['4' => '4'],
            ['5' => '5'],
            ['6' => '6'],
            ['7' => '7'],
            ['8' => '8'],
            ['9' => '9'],
            ['10' => '10'],
            ['11' => 'More than 10'],
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
        try {
            if ($request->page)
                throw new JWTException();

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
            $properties = Property::query();
            $properties = $properties->where('price', '>=', intval($request->min_price));
            $properties = $properties->where('price', '<=', intval($request->max_price));
            $properties = $properties->where('size', '>=', intval($request->min_size));
            $properties = $properties->where('size', '<=', intval($request->max_size));
            $properties = $properties->where('bedrooms', '>=', intval($request->min_bed));
            $properties = $properties->where('bathrooms', '>=', intval($request->min_bath));
            if ($request->sorting) {
                if ($request->sorting == 1) {
                    $properties = $properties->orderBy('created_at', 'desc');
                } else if ($request->sorting == 2) {
                    $properties = $properties->orderBy('is_featured', 'desc');
                } elseif ($request->sorting == 3) {
                    $properties = $properties->orderBy('views', 'desc');
                } elseif ($request->sorting == 4) {
                    $properties = $properties->orderBy('price', 'asc');
                } elseif ($request->sorting == 5) {
                    $properties = $properties->orderBy('price', 'desc');
                } elseif ($request->sorting == 6) {
                    $properties = $properties->orderBy('created_at', 'asc');
                } elseif ($request->sorting == 7) {
                    $properties = $properties->orderBy('created_at', 'desc');
                }
            } else {
                $properties = $properties->orderBy('created_at', 'desc');
            }
            if ($request->listing_status) {
                $properties = $properties->where('listing_status', $request->listing_status);
            }
            if ($request->city_id) {
                $city = City::where('id', $request->city_id)->first();
                if (!$city) {
                    return response()->json(['message' => 'City not found.'], 404);
                }
                $properties = $properties->where('city', $city->name);
            }
            if ($request->neighborhood_id) {
                $neighborhood = Neighborhood::where('id', $request->neighborhood_id)->first();
                if (!$neighborhood) {
                    return response()->json(['message' => 'Neighborhood not found.'], 404);
                }
                $properties = $properties->where('neighborhood_id', $neighborhood->id);
            }
            if ($request->type_id) {
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
            if ($request->features_id_array) {
                // features_id_array input is like [1,56,12]
                $features_id_array = json_decode($request->features_id_array);
                $property_features = PropertyFeature::whereIn('feature_id', $features_id_array)->get();
                $property_ids = [];
                foreach ($property_features as $property_feature) {
                    $property_ids[] = $property_feature->property_id;
                }
                $properties = $properties->whereIn('id', $property_ids);
            }
            if ($request->title) {
                $properties = $properties->where('title', 'like', '%' . $request->title . '%');
            }

            $properties->paginate(6);
            $properties = $properties->get();
            $properties = $properties->map(function ($property) {
                return $this->refine($property);
            });
            return response()->json(['message' => 'Search results retreived successfully', 'data' => $properties], 200);
        } catch (JWTException $e) {
            $properties = Property::query();
            $properties = $properties->where('price', '>=', intval($request->min_price));
            $properties = $properties->where('price', '<=', intval($request->max_price));
            $properties = $properties->where('size', '>=', intval($request->min_size));
            $properties = $properties->where('size', '<=', intval($request->max_size));
            $properties = $properties->where('bedrooms', '>=', intval($request->min_bed));
            $properties = $properties->where('bathrooms', '>=', intval($request->min_bath));
            if ($request->sorting) {
                if ($request->sorting == 1) {
                    $properties = $properties->orderBy('created_at', 'desc');
                } else if ($request->sorting == 2) {
                    $properties = $properties->orderBy('is_featured', 'desc');
                } elseif ($request->sorting == 3) {
                    $properties = $properties->orderBy('views', 'desc');
                } elseif ($request->sorting == 4) {
                    $properties = $properties->orderBy('price', 'asc');
                } elseif ($request->sorting == 5) {
                    $properties = $properties->orderBy('price', 'desc');
                } elseif ($request->sorting == 6) {
                    $properties = $properties->orderBy('created_at', 'asc');
                } elseif ($request->sorting == 7) {
                    $properties = $properties->orderBy('created_at', 'desc');
                }
            } else {
                $properties = $properties->orderBy('created_at', 'desc');
            }
            if ($request->listing_status) {
                $properties = $properties->where('listing_status', $request->listing_status);
            }
            if ($request->city_id) {
                $city = City::where('id', $request->city_id)->first();
                if (!$city) {
                    return response()->json(['message' => 'City not found.'], 404);
                }
                $properties = $properties->where('city', $city->name);
            }
            if ($request->neighborhood_id) {
                $neighborhood = Neighborhood::where('id', $request->neighborhood_id)->first();
                if (!$neighborhood) {
                    return response()->json(['message' => 'Neighborhood not found.'], 404);
                }
                $properties = $properties->where('neighborhood_id', $neighborhood->id);
            }
            if ($request->type_id) {
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
            if ($request->features_id_array) {
                // features_id_array input is like [1,56,12]
                $features_id_array = json_decode($request->features_id_array);
                $property_features = PropertyFeature::whereIn('feature_id', $features_id_array)->get();
                $property_ids = [];
                foreach ($property_features as $property_feature) {
                    $property_ids[] = $property_feature->property_id;
                }
                $properties = $properties->whereIn('id', $property_ids);
            }
            if ($request->title) {
                $properties = $properties->where('title', 'like', '%' . $request->title . '%');
            }

            $properties->paginate(6);
            $properties = $properties->get();
            $properties = $properties->map(function ($property) {
                return $this->refine($property);
            });
            return response()->json(['message' => 'Search results retreived successfully', 'data' => $properties], 200);
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
        $properties = $properties->where('price', '>=', intval($search_query->min_price));
        $properties = $properties->where('price', '<=', intval($search_query->max_price));
        $properties = $properties->where('size', '>=', intval($search_query->min_size));
        $properties = $properties->where('size', '<=', intval($search_query->max_size));
        $properties = $properties->where('bedrooms', '>=', intval($search_query->min_bed));
        $properties = $properties->where('bathrooms', '>=', intval($search_query->min_bath));
        if ($search_query->sorting) {
            if ($search_query->sorting == 2) {
                $properties = $properties->orderBy('is_featured', 'desc');
            } elseif ($search_query->sorting == 3) {
                $properties = $properties->orderBy('views', 'desc');
            } elseif ($search_query->sorting == 4) {
                $properties = $properties->orderBy('price', 'asc');
            } elseif ($search_query->sorting == 5) {
                $properties = $properties->orderBy('price', 'desc');
            } elseif ($search_query->sorting == 6) {
                $properties = $properties->orderBy('created_at', 'asc');
            } elseif ($search_query->sorting == 7) {
                $properties = $properties->orderBy('created_at', 'desc');
            } else {
                $properties = $properties->orderBy('created_at', 'desc');
            }
        }
        if ($search_query->listing_status) {
            $properties = $properties->where('listing_status', $search_query->listing_status);
        }
        if ($search_query->city_id) {
            $city = City::where('id', $search_query->city_id)->first();
            if (!$city) {
                return response()->json(['message' => 'City not found.'], 404);
            }
            $properties = $properties->where('city', $city->name);
        }
        if ($search_query->neighborhood_id) {
            $neighborhood = Neighborhood::where('id', $search_query->neighborhood_id)->first();
            if (!$neighborhood) {
                return response()->json(['message' => 'Neighborhood not found.'], 404);
            }
            $properties = $properties->where('neighborhood_id', $neighborhood->id);
        }
        if ($search_query->type_id) {
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
        if ($search_query->features_id_array) {
            // features_id_array input is like [1,56,12]
            $features_id_array = json_decode($search_query->features_id_array);
            $property_features = PropertyFeature::whereIn('feature_id', $features_id_array)->get();
            $property_ids = [];
            foreach ($property_features as $property_feature) {
                $property_ids[] = $property_feature->property_id;
            }
            $properties = $properties->whereIn('id', $property_ids);
        }
        if ($search_query->title) {
            $properties = $properties->where('title', 'like', '%' . $search_query->title . '%');
        }

        $properties->paginate(6);
        $properties = $properties->get();
        $properties = $properties->map(function ($property) {
            return $this->refine($property);
        });
        return response()->json(['message' => 'Search results retreived successfully', 'data' => $properties], 200);
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
