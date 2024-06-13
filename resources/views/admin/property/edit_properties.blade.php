@extends('admin.admin_app')
@push('styles')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="{{asset('admin_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
<script src="{{asset('admin_assets/js/plugins/jqueryMask/jquery.mask.min.js')}}"></script>
<script src="{{asset('admin_assets/css/plugins/iCheck/custom.css')}}"></script>
<script src="{{asset('admin_assets/css/plugins/datapicker/datepicker3.css')}}"></script>
<script src="{{asset('admin_assets/css/plugins/select2/select2.min.css')}}"></script>
<script src="{{asset('admin_assets/css/plugins/select2/select2-bootstrap4.min.css')}}"></script>

<style>
    .unselectable {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .ck.ck-reset.ck-editor.ck-rounded-corners {
        box-sizing: border-box;
        height: auto;
        position: static;
        width: 100%;
    }

    .switch-container {
        display: flex;
        flex-direction: column;
        align-items: start;
        margin-top: 29px;
        margin-left: -118px;
    }

    .ck-editor__editable_inline {
        min-height: 500px;
    }

    .plus-icon {
        z-index: 99999;
        background-color: rgba(255, 244, 236, 0.88);
        cursor: pointer;
        position: absolute;
        bottom: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        display: flex;
        justify-content: center;
        width: 40px;
        padding: 2px;
        height: 40px;
        align-items: center;
        border-radius: 50%;
    }

    .delete-icon {
        z-index: 99999;
        background-color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        position: absolute;
        bottom: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        display: flex;
        justify-content: center;
        width: 40px;
        padding: 2px;
        height: 40px;
        align-items: center;
        border-radius: 50%;
    }

    #add-more {
        border: 1px dashed #CE713EFF;
        cursor: pointer;
        border-radius: 5%;
    }

    .trash-icon {
        color: red;
    }

    .trash-icon:hover {
        color: gray;
    }

    .add-icon {
        color: #CE713EFF;
    }

    .add-icon:hover {
        color: gray;
    }
</style>
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Edit Property Listing </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/property-listings') }}"> Property Listings </a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Edit Property Listing </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" href="{{url('admin/property-listings')}}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Property Listings
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form action="{{url('admin/property-listings/update')}}" class="m-4" id="property-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{$property->id}}" hidden>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Title</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="title" id="title-content" value="{{$property->title}}" required class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label ps-3"><strong>Banner Image</strong></label>
                                    <div class="col-sm-4">
                                        <input type="file" name="banner" id="Bannerimage" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Listing Type</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="listing_type" id="listing_type" class="form-control">
                                            <option value="1" {{$property->listing_type == 1 ? 'selected' : ''}}>Sale</option>
                                            <option value="2" {{$property->listing_type == 2 ? 'selected' : ''}}>Rent</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Listing Status</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="listing_status" id="listing_status" class="form-control">
                                            <option value="1" {{$property->listing_status == 1 ? 'selected' : ''}}>For Sale</option>
                                            <option value="2" {{$property->listing_status == 2 ? 'selected' : ''}}>For Rent</option>
                                            <option value="3" {{$property->listing_status == 3 ? 'selected' : ''}}>Rented</option>
                                            <option value="4" {{$property->listing_status == 4 ? 'selected' : ''}}>Sales Pending</option>
                                            <option value="5" {{$property->listing_status == 5 ? 'selected' : ''}}>Sold</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4 rent_fields">
                                    <label class="col-sm-2 col-form-label"><strong>Date of Availability</strong></label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" name="date_available" id="date_available" class="form-control avail_date" value="{{$property->date_available}}">
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label ps-3"><strong>Rent Cycle</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="rent_cycle" id="rent_cycle" class="form-control">
                                            <option value="0" {{$property->rent_cycle == 0 ? 'selected' : ''}}>One Day</option>
                                            <option value="1" {{$property->rent_cycle == 1 ? 'selected' : ''}}>Monthly</option>
                                            <option value="2" {{$property->rent_cycle == 2 ? 'selected' : ''}}>Quarterly</option>
                                            <option value="3" {{$property->rent_cycle == 3 ? 'selected' : ''}}>Semi-Annually</option>
                                            <option value="4" {{$property->rent_cycle == 4 ? 'selected' : ''}}>Annually</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4 sales_feilds">
                                    <label class="col-sm-2 col-form-label"><strong>Property Tax (Yearly)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control money" name="property_tax" id="property_tax" value="{{$property->property_tax}}">
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>HOA Fee (Monthly)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="hoa_fees" id="hoa_fees" class="form-control money" value="{{$property->hoa_fees}}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Price/Rent (USD)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="price" required class="form-control money" value="{{$property->price}}">
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Size (sqft)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="size" id="size" class="form-control money" value="{{$property->size}}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Neighborhood</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="neighborhood" id="neighborhood" class="form-control select2">
                                            @foreach($neighborhoods as $neighborhood)
                                            <option value="{{$neighborhood->id}}" {{$property->neighborhood_id == $neighborhood->id ? 'selected' : ''}}>{{$neighborhood->title}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Street Address</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="address" required class="form-control" value="{{$property->address}}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Parking Spaces</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="parking_spaces" id="parking_spaces" class="form-control">
                                            <option value="0" {{$property->parking_spaces == 0 ? 'selected' : ''}}>0</option>
                                            <option value="1" {{$property->parking_spaces == 1 ? 'selected' : ''}}>1</option>
                                            <option value="2" {{$property->parking_spaces == 2 ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$property->parking_spaces == 3 ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$property->parking_spaces == 4 ? 'selected' : ''}}>4</option>
                                            <option value="5" {{$property->parking_spaces == 5 ? 'selected' : ''}}>5</option>
                                            <option value="6" {{$property->parking_spaces == 6 ? 'selected' : ''}}>6</option>
                                            <option value="7" {{$property->parking_spaces == 7 ? 'selected' : ''}}>7</option>
                                            <option value="8" {{$property->parking_spaces == 8 ? 'selected' : ''}}>8</option>
                                            <option value="9" {{$property->parking_spaces == 9 ? 'selected' : ''}}>9</option>
                                            <option value="10" {{$property->parking_spaces >= 10 ? 'selected' : ''}}>10 or more</option>

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Bedrooms</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="bedrooms" id="bedrooms" class="form-control">
                                            <option value="0" {{$property->bedrooms == 0 ? 'selected' : ''}}>0</option>
                                            <option value="1" {{$property->bedrooms == 1 ? 'selected' : ''}}>1</option>
                                            <option value="2" {{$property->bedrooms == 2 ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$property->bedrooms == 3 ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$property->bedrooms == 4 ? 'selected' : ''}}>4</option>
                                            <option value="5" {{$property->bedrooms == 5 ? 'selected' : ''}}>5</option>
                                            <option value="6" {{$property->bedrooms == 6 ? 'selected' : ''}}>6</option>
                                            <option value="7" {{$property->bedrooms == 7 ? 'selected' : ''}}>7</option>
                                            <option value="8" {{$property->bedrooms == 8 ? 'selected' : ''}}>8</option>
                                            <option value="9" {{$property->bedrooms == 9 ? 'selected' : ''}}>9</option>
                                            <option value="10" {{$property->bedrooms >= 10 ? 'selected' : ''}}>10 or more</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Bathrooms</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="bathrooms" id="bathrooms" class="form-control">
                                            <option value="0" {{$property->bathrooms == 0 ? 'selected' : ''}}>0</option>
                                            <option value="1" {{$property->bathrooms == 1 ? 'selected' : ''}}>1</option>
                                            <option value="2" {{$property->bathrooms == 2 ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$property->bathrooms == 3 ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$property->bathrooms == 4 ? 'selected' : ''}}>4</option>
                                            <option value="5" {{$property->bathrooms == 5 ? 'selected' : ''}}>5</option>
                                            <option value="6" {{$property->bathrooms == 6 ? 'selected' : ''}}>6</option>
                                            <option value="7" {{$property->bathrooms == 7 ? 'selected' : ''}}>7</option>
                                            <option value="8" {{$property->bathrooms == 8 ? 'selected' : ''}}>8</option>
                                            <option value="9" {{$property->bathrooms == 9 ? 'selected' : ''}}>9</option>
                                            <option value="10" {{$property->bathrooms >= 10 ? 'selected' : ''}}>10 or more</option>

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Year Built</strong></label>
                                    <div class="col-sm-4">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" name="year_built" id="year_built" class="form-control date money" value="{{$property->year_built}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Development Level</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="dev_lvl" id="dev_lvl" class="form-control">
                                            <option value="1" {{$property->dev_lvl == 1 ? 'selected' : ''}}>Under Construction</option>
                                            <option value="2" {{$property->dev_lvl == 2 ? 'selected' : ''}}>Built</option>
                                            <option value="3" {{$property->dev_lvl == 3 ? 'selected' : ''}}>Under Renovation</option>
                                            <option value="4" {{$property->dev_lvl == 4 ? 'selected' : ''}}>Renovated</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label"><strong>Location (Select Latitude & Longitude Coordinates By Clicking The Map)</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="map" style="height: 50vh !important;"></div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <label class="col-sm-2 col-form-label"><strong>Latitude</strong></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="latitude" id="latitude" class="form-control" value="{{$property->lattitude}}" required>
                                            </div>
                                            <label class="col-sm-2 col-form-label ps-3"><strong>Longitude</strong></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="longitude" id="longitude" class="form-control" value="{{$property->longitude}}" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label"><strong>Image Gallery</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row" id="showImgGal">
                                                    @if(!empty($galleries))
                                                    @foreach($galleries as $gallery)
                                                    <div class="col-md-2 col-sm-6 my-2" style="height: 102px;" id="img-gallery">
                                                        <img src="{{$gallery}}" class="img-fluid images-img" style="width: 100%; height: 100%; overflow: contain; border-radius: 5%;" alt="Image View">
                                                        <div class="delete-icon" onclick="deleteImage(this)" data-url="{{$gallery}}" data-id="{{$property->id}}"><i class="fa fa-trash trash-icon"></i></div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="dropzone col-12" id="myDropzone"></div>
                                                <input type="text" name="gallery" id="gallery" value="{{$gallery_array}}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label"><strong>Short Description</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea name="short_description" id="short_description" required class="form-control">{{$property->short_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Property Type</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($types as $type)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label unselectable" for="{{$type->slug}}"> <input class="i-checks {{$type->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$type->slug}}" id="{{$type->slug}}" value="{{$type->id}}" style="position: absolute; opacity: 0;">
                                                        {{$type->title}} </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Interior Features</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($interior_features as $feature)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$feature->slug}}"> <input class="i-checks {{$feature->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$feature->slug}}" id="{{$feature->slug}}" value="{{$feature->id}}" style="position: absolute; opacity: 0;">
                                                        {{$feature->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Exterior Finish</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($exterior_finish as $finish)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$finish->slug}}"> <input class="i-checks {{$finish->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$finish->slug}}" id="{{$finish->slug}}" value="{{$finish->id}}" style="position: absolute; opacity: 0;">
                                                        {{$finish->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Featured Amenitis</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($featured_amenities as $amenities)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$amenities->slug}}"> <input class="i-checks {{$amenities->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$amenities->slug}}" id="{{$amenities->slug}}" value="{{$amenities->id}}" style="position: absolute; opacity: 0;">
                                                        {{$amenities->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Appliances</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($appliances as $appliance)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$appliance->slug}}"> <input class="i-checks {{$appliance->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$appliance->slug}}" id="{{$appliance->slug}}" value="{{$appliance->id}}" style="position: absolute; opacity: 0;">
                                                        {{$appliance->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Views</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($views as $view)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$view->slug}}"> <input class="i-checks {{$view->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$view->slug}}" id="{{$view->slug}}" value="{{$view->id}}" style="position: absolute; opacity: 0;">
                                                        {{$view->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Heating</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($heatings as $heating)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$heating->slug}}"> <input class="i-checks {{$heating->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$heating->slug}}" id="{{$heating->slug}}" value="{{$heating->id}}" style="position: absolute; opacity: 0;">
                                                        {{$heating->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Cooling</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($coolings as $cooling)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$cooling->slug}}"> <input class="i-checks {{$cooling->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$cooling->slug}}" id="{{$cooling->slug}}" value="{{$cooling->id}}" style="position: absolute; opacity: 0;">
                                                        {{$cooling->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Roof</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($roofs as $roof)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$roof->slug}}"> <input class="i-checks {{$roof->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$roof->slug}}" id="{{$roof->slug}}" value="{{$roof->id}}" style="position: absolute; opacity: 0;">
                                                        {{$roof->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Sewer-Water System</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($sewer_water_systems as $sewer_water_system)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$sewer_water_system->slug}}"> <input class="i-checks {{$sewer_water_system->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$sewer_water_system->slug}}" id="{{$sewer_water_system->slug}}" value="{{$sewer_water_system->id}}" style="position: absolute; opacity: 0;">
                                                        {{$sewer_water_system->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label"><strong>Extra Features</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($extra_features as $extra_feature)
                                                <div class="form-check form-check-inline mx-4 mb-1">
                                                    <label class="form-check-label" for="{{$extra_feature->slug}}"> <input class="i-checks {{$extra_feature->show == 2 ? 'checked' : 'unchecked'}}" type="checkbox" name="{{$extra_feature->slug}}" id="{{$extra_feature->slug}}" value="{{$extra_feature->id}}" style="position: absolute; opacity: 0;">
                                                        {{$extra_feature->title}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="description" class="form-label"><strong>Description</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea class="form-control" id="description" name="description" hidden placeholder="Enter the Description" rows="10">{{$property->description}}</textarea>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save Record</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin_assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('admin_assets/js/plugins/iCheck/icheck.min.js')}}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    gallery_array_string = $('#gallery').val();
    gallery_array = gallery_array_string ? JSON.parse(gallery_array_string) : [];
    console.log(gallery_array);
    let myDropzone = new Dropzone("#myDropzone", {
        url: "{{url('/admin/property-listings/imageManagement')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            if (response.status === 'success') {
                gallery_array.push(response.image_url);
                console.log(gallery_array);
                $('#gallery').val(JSON.stringify(gallery_array));
                console.log("input: " + $('#gallery').val());
                var img = document.createElement('img');
                img.src = response.image_url;
                img.className = 'img-fluid images-img';
                img.style = 'width: 100%; height: 100%; overflow: contain; border-radius: 5%;';
                img.alt = 'Image View';
                var deleteIcon = document.createElement('div');
                deleteIcon.className = 'delete-icon';
                deleteIcon.onclick = function() {
                    deleteImage(this);
                };
                deleteIcon.setAttribute('data-url', response.image_url);
                deleteIcon.setAttribute('data-id', '{{$property->id}}');
                var icon = document.createElement('i');
                icon.className = 'fa fa-trash trash-icon';
                deleteIcon.appendChild(icon);
                var div = document.createElement('div');
                div.className = 'col-md-2 col-sm-6 my-2';
                div.id = 'img-gallery';
                div.style = 'height: 102px;';
                div.appendChild(img);
                div.appendChild(deleteIcon);
                document.getElementById('showImgGal').appendChild(div);
                myDropzone.removeFile(file);
            } else {
                console.error('Error uploading images');
            }
        }
    });
</script>
<script>
    $('#property-form').submit(function() {
        if ($('#listing_type').val() == 1) {
            if ($('#property_tax').val() == '') {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error("Please enter the property tax");
                return false;
            }
            if ($('#hoa_fees').val() == '') {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error("Please enter the HOA fee");
                return false;
            }
        } else if ($('#listing_type').val() == 2) {
            if ($('#date_available').val() == '') {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error("Please enter the date of availability");
                return false;
            }
        }
        if (gallery_array.length == 0) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please upload at least one gallery image");
            return false;
        }

        if ($('#latitude').val() == '' || $('#longitude').val() == '') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please select the latitude and longitude coordinates");
            return false;
        }
        return true;
    });
</script>
<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })
    ({
        key: "AIzaSyBy2l4KGGTm4cTqoSl6h8UAOAob87sHBsA",
        v: "weekly"
    });
</script>
<script>
    async function initMap() {
        const {
            Map
        } = await google.maps.importLibrary("maps");
        latitude = Number($('#latitude').val());
        longitude = Number($('#longitude').val());
        const myLatlng = {
            lat: latitude,
            lng: longitude
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: myLatlng,
        });
        let infoWindow = new google.maps.InfoWindow({
            content: "Latitude: " + latitude + "</br>Longitude: " + longitude + "</br>Click on the map to select coordinates.",
            position: myLatlng,
        });
        infoWindow.open(map);
        map.addListener("click", (mapsMouseEvent) => {
            infoWindow.close();
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
            });
            coordinates = mapsMouseEvent.latLng.toJSON();
            infoWindow.setContent(
                "Latitude: " + coordinates.lat + "<br>Longitude: " + coordinates.lng,
            );
            infoWindow.open(map);
            $('#latitude').val(coordinates.lat);
            $('#longitude').val(coordinates.lng);
        });
    }

    initMap();
</script>
<script>
    function deleteImage(e) {
        var id = $(e).data('id');
        var url = $(e).data('url');
        $.ajax({
            url: "{{url('admin/property-listings/delete-image')}}",
            type: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                url: url,
                id: id
            },
            success: function(data) {
                console.log(data);
                if (data.msg == 'success') {
                    $(e).parent().remove();
                    gallery_array = gallery_array.filter(gallery => gallery !== url);
                    $('#gallery').val(JSON.stringify(gallery_array));
                    console.log($('#gallery').val());
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    }
                    toastr.success(data.response);
                } else {
                    console.log(data);
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    }
                    toastr.error(data.response);
                }

            },
            error: function(data) {
                console.log(data);
                // show toastr
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error(data.response);
            }
        });
    }
</script>


<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.unchecked').iCheck('uncheck');
        $('.checked').iCheck('check');

    });
    $(document).ready(function() {
        $('.money').on('input', function() {
            this.value = this.value.replace(/[^0-9\.]/g, '');

            // Ensure only one decimal point
            if (this.value.indexOf('.') !== -1) {
                this.value = this.value.replace(/\.+$/, ''); // Remove extra decimal points
                this.value = this.value.replace(/\.(\d{2})\./, '.$1'); // Allow only two digits after decimal
            }
        });
    });

    $('.date').datepicker({
        startView: 2, // Start at the year view
        minViewMode: 2, // Set the minimum view mode to year
        viewMode: "years", // Display only years in the view
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy"
    });
    $('.avail_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: new Date() // Set default to today's date
    });
    $('.date').datepicker({
        startView: 2, // Start at the year view
        minViewMode: 2, // Set the minimum view mode to year
        viewMode: "years", // Display only years in the view
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy"
    });
    $('.avail_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: new Date() // Set default to today's date
    });
    $(".select2").select2({
        placeholder: "Select a neighborhood",
        allowClear: true
    });
</script>
<script>
    $(document).ready(function() {
        $('#listing_type').change(function() {
            if ($(this).val() == 1) {
                $('.rent_fields').hide();
                $('.sales_feilds').show();
                $('#listing_status').html('<option value="1" selected>For Sale</option><option value="4">Sales Pending</option><option value="5">Sold</option>');
            } else {
                $('.rent_fields').show();
                $('.sales_feilds').hide();
                $('#listing_status').html('<option value="2" selected>For Rent</option><option value="3">Rented</option>');
            }
        });
        $('#listing_type').trigger('change');
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
        ckfinder: {
            uploadUrl: "{{ url('admin/ckeditor-upload').'?_token='.csrf_token() }}"
        },
        toolbar: {
            items: [
                'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'underline', 'code', 'removeFormat', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', '|',
                'specialCharacters', '|',
            ],
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        placeholder: 'Enter Description Here!',

        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },

        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },

        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced'
        ]
    });
</script>
<script>
    var session = "{{Session::has('error') ? 'true' : 'false'}}";
    if (session == 'true') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        }
        toastr.error("{{Session::get('error')}}");

    }
    $('#Bannerimage').change(function() {
        $('#imageView').show();
        $('#imageView').attr('src', URL.createObjectURL(event.target.files[0]));
    });
</script>
<script>
    var session = "{{Session::has('error') ? 'true' : 'false'}}";
    if (session == 'true') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        }
        toastr.error("{{Session::get('error')}}");

    }
    var succession = "{{Session::has('success') ? 'true' : 'false'}}";
    if (succession == 'true') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        }
        toastr.success("{{Session::get('success')}}");

    }
    $('#Bannerimage').change(function() {
        $('#imageView').show();
        $('#imageView').attr('src', URL.createObjectURL(event.target.files[0]));
    });
</script>
@endpush