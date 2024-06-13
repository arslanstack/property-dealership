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
        min-height: 100px;
    }

    select.form-control {
        height: 2.25rem !important;
    }
</style>
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Add New Property Listing </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/property-listings') }}"> Property Listings </a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Add New Property Listing </strong>
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
                    <form action="{{url('admin/property-listings/store')}}" class="m-4" id="property-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Title</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="title" id="title-content" placeholder="e.g. Suite 301 – Tower 4" required class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label ps-3"><strong>Banner Image</strong></label>
                                    <div class="col-sm-4">
                                        <input type="file" name="banner" id="Bannerimage" required class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Listing Type</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="listing_type" id="listing_type" class="form-control">
                                            <option value="1" selected>Sale</option>
                                            <option value="2">Rent</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Listing Status</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="listing_status" id="listing_status" class="form-control">
                                            <option value="1" selected>For Sale</option>
                                            <option value="4">Sales Pending</option>
                                            <option value="5">Sold</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4 rent_fields">
                                    <label class="col-sm-2 col-form-label"><strong>Date of Availability</strong></label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_available" id="date_available" class="form-control avail_date" value="{{date('d/m/Y')}}">
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label ps-3"><strong>Rent Cycle</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="rent_cycle" id="rent_cycle" class="form-control">
                                            <option value="0" selected>One Day</option>
                                            <option value="1" selected>Monthly</option>
                                            <option value="2">Quarterly</option>
                                            <option value="3">Semi-Annually</option>
                                            <option value="4">Annually</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4 sales_feilds">
                                    <label class="col-sm-2 col-form-label"><strong>Property Tax (Yearly)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control money" name="property_tax" id="property_tax" placeholder="e.g. 2300">
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>HOA Fee (Monthly)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="hoa_fees" id="hoa_fees" class="form-control money" placeholder="e.g. 200">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Price/Rent (USD)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="price" required class="form-control money" placeholder="e.g. 30000 ">
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Size (sqft)</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="size" id="size" class="form-control money" placeholder="e.g. 200">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Neighborhood</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="neighborhood" id="neighborhood" class="select2 form-control">
                                            <option value="" selected disabled>Select an option</option>
                                            @foreach($neighborhoods as $neighborhood)
                                            <option value="{{$neighborhood->id}}">{{$neighborhood->title}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Street Address</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="address" required class="form-control" placeholder="e.g. 221-B Baker Street">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Parking Spaces</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="parking_spaces" id="parking_spaces" class="form-control">
                                            <option value="" selected disabled>Select an option</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10 or more</option>

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Bedrooms</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="bedrooms" id="bedrooms" class="form-control">
                                            <option value="" selected disabled>Select an option</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10 or more</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Bathrooms</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="bathrooms" id="bathrooms" class="form-control">
                                            <option value="" selected disabled>Select an option</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10 or more</option>

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>Year Built</strong></label>
                                    <div class="col-sm-4">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" name="year_built" id="year_built" class="form-control money" value="{{date('Y')}}">
                                        </div>
                                        <!-- <input type="number" min="1900" max="{{date('Y')}}" step="1" name="year_built" id="year_built" class="form-control money" value="{{date('Y')}}"> -->
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Development Level</strong></label>
                                    <div class="col-sm-4">
                                        <select required name="dev_lvl" id="dev_lvl" class="form-control">
                                            <option value="" selected>Select an Option</option>
                                            <option value="1" selected>Under Construction</option>
                                            <option value="2" selected>Built</option>
                                            <option value="3" selected>Under Renovation</option>
                                            <option value="4" selected>Renovated</option>
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
                                                <input type="text" name="latitude" id="latitude" class="form-control" required>
                                            </div>
                                            <label class="col-sm-2 col-form-label ps-3"><strong>Longitude</strong></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="longitude" id="longitude" class="form-control" required>
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
                                                <div class="dropzone col-12" id="myDropzone"></div>
                                                <input type="text" name="gallery" id="gallery" hidden>
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
                                                <textarea name="short_description" id="short_description" required class="form-control"></textarea>
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
                                                    <label class="form-check-label unselectable" for="{{$type->slug}}"> <input class="i-checks {{$type->slug == 'commercial' ? 'unchecked' : 'checked' }}" type="checkbox" name="{{$type->slug}}" id="{{$type->slug}}" value="{{$type->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$feature->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$feature->slug}}" id="{{$feature->slug}}" value="{{$feature->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$finish->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$finish->slug}}" id="{{$finish->slug}}" value="{{$finish->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$amenities->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$amenities->slug}}" id="{{$amenities->slug}}" value="{{$amenities->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$appliance->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$appliance->slug}}" id="{{$appliance->slug}}" value="{{$appliance->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$view->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$view->slug}}" id="{{$view->slug}}" value="{{$view->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$heating->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$heating->slug}}" id="{{$heating->slug}}" value="{{$heating->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$cooling->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$cooling->slug}}" id="{{$cooling->slug}}" value="{{$cooling->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$sewer_water_system->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$sewer_water_system->slug}}" id="{{$sewer_water_system->slug}}" value="{{$sewer_water_system->id}}" style="position: absolute; opacity: 0;">
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
                                                    <label class="form-check-label" for="{{$extra_feature->slug}}"> <input class="i-checks checked" type="checkbox" name="{{$extra_feature->slug}}" id="{{$extra_feature->slug}}" value="{{$extra_feature->id}}" style="position: absolute; opacity: 0;">
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
                                                <textarea class="form-control" id="description" name="description" hidden placeholder="Enter the Description" rows="10"></textarea>

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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.unchecked').iCheck('uncheck');
        $('.checked').iCheck('check');

    });
    //    for inputs with class name money if user enters characters other than numbers then prevent adding them
    $(document).ready(function() {
        // Attach event listener to all input fields with class 'money'
        $('.money').on('input', function() {
            // Allow only numbers, backspace, and decimal point
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
    $(".select2").select2({
        placeholder: "Select a neighborhood",
        allowClear: true
    });
</script>
<script src="{{asset('admin_assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('admin_assets/js/plugins/iCheck/icheck.min.js')}}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    gallery_images = [];
    let myDropzone = new Dropzone("#myDropzone", {
        url: "{{url('/admin/property-listings/imageManagement')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            if (response.status === 'success') {
                gallery_images.push(response.image);
                console.log(gallery_images);
                $('#gallery').val(JSON.stringify(gallery_images));
            } else {
                console.error('Error uploading images');
            }
        }
    });
</script>
<script>
    // on form submit i want to validate request 
    $('#property-form').submit(function() {

        // if listing type selected is sale then property tax and hoa fee fields are mandatory
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
        if (gallery_images.length < 1) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please upload at least one image for the gallery");
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
        const myLatlng = {
            lat: 32.35269,
            lng: -117.0417087
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: myLatlng,
        });
        let infoWindow = new google.maps.InfoWindow({
            content: "Click on the map to select coordinates.",
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
</script>
@endpush