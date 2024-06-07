@extends('admin.admin_app')
@push('styles')
<link href="{{asset('admin_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
<script src="{{asset('admin_assets/js/plugins/jqueryMask/jquery.mask.min.js')}}"></script>

<style>
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
                    <form action="{{url('admin/property-listings/update')}}" class="m-4" id="neighborhood-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{$property->id}}" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Title</strong></label>
                                    <input type="text" name="title" id="title-content" value="{{$property->title}}" required class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label"><strong>Banner Image</strong></label>
                                    <input type="file" name="banner" id="Bannerimage" required class="form-control" accept="image/*">
                                </div>
                                <div class="form-group row">
                                    <label for="listing_type" class="form-label"><strong>Listing Type</strong></label>
                                    <select required name="listing_type" id="listing_type" class="form-control">
                                        <option value="1" {{$property->listing_type == 1 ? 'selected' : ''}}>Sale</option>
                                        <option value="2" {{$property->listing_type == 2 ? 'selected' : ''}}>Rent</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="listing_status" class="form-label"><strong>Listing Status</strong></label>
                                    <select required name="listing_status" id="listing_status" class="form-control">
                                        <option value="1" {{$property->listing_status == 1 ? 'selected' : ''}}>For Sale</option>
                                        <option value="2" {{$property->listing_status == 2 ? 'selected' : ''}}>For Rent</option>
                                        <option value="3" {{$property->listing_status == 3 ? 'selected' : ''}}>Rented</option>
                                        <option value="4" {{$property->listing_status == 4 ? 'selected' : ''}}>Sales Pending</option>
                                        <option value="5" {{$property->listing_status == 5 ? 'selected' : ''}}>Sold</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="Bannerimage" style="cursor: pointer;" class="form-label float-right float-end">
                                    <div id="my-auto">
                                        <img id="imageView" src="{{asset('/uploads/properties/' . $property->banner)}}" class="img-fluid" style="width: 450px; height: 310px; overflow: contain;" alt="Image View">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="row mt-2 rent_fields">
                            <div class="col-md-6">

                                <div class="form-group row mr-1">
                                    <label for="date_available" class="form-label"><strong>Date of Availability</strong></label>
                                    <input type="date" name="date_available" id="date_available" class="form-control" value="{{$property->date_available}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label for="rent_cycle" class="form-label"><strong>Rent Cycle</strong></label>
                                    <select required name="rent_cycle" id="rent_cycle" class="form-control">
                                        <option value="1" {{$property->rent_cycle == 1 ? 'selected' : ''}}>Monthly</option>
                                        <option value="2" {{$property->rent_cycle == 2 ? 'selected' : ''}}>Quarterly</option>
                                        <option value="3" {{$property->rent_cycle == 3 ? 'selected' : ''}}>Semi-Annually</option>
                                        <option value="4" {{$property->rent_cycle == 4 ? 'selected' : ''}}>Annually</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 sales_feilds">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="property_tax" class="form-label"><strong>Property Tax (USD Yearly)</strong></label>
                                    <input type="text" class="form-control" name="property_tax" id="property_tax" value="{{$property->property_tax}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label for="hoa_fee" class="form-label"><strong>HOA Fee (USD Monthly)</strong></label>
                                    <input type="text" name="hoa_fee" id="hoa_fee" class="form-control" value="{{$property->hoa_fee}}">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2 g-1">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label class="form-label"><strong>Price/Rent (USD)</strong></label>
                                    <input type="text" name="price" required class="form-control" value="{{$property->price}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label class="form-label"><strong>Map Location Link</strong> <a data-toggle="modal" data-target="#exampleModal" class="" style="color: red; text-decoration: underline;">Need Help?</a> </label>
                                    <input type="text" name="map" required class="form-control" value="{{$property->map}}">
                                </div>
                            </div>

                        </div>
                        <!-- Neighborhood and Address -->
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="neighborhood" class="form-label"><strong>Neighborhood</strong></label>
                                    <select required name="neighborhood" id="neighborhood" class="form-control">
                                        @foreach($neighborhoods as $neighborhood)
                                        <option value="{{$neighborhood->id}}" {{$property->neighborhood_id == $neighborhood->id ? 'selected' : ''}}>{{$neighborhood->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label for="address" class="form-label"><strong>Street Address</strong></label>
                                    <input type="text" name="address" required class="form-control" value="{{$property->address}}">
                                </div>
                            </div>
                        </div>
                        <!-- Size and Parking Spaces -->
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="size" class="form-label"><strong>Size (sqft)</strong></label>
                                    <input type="text" name="size" class="form-control" value="{{$property->size}}" accept="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label for="parking_spaces" class="form-label"><strong>Parking Spaces</strong></label>
                                    <input type="text" name="parking_spaces" class="form-control" value="{{$property->parking_spaces}}" accept="" required>
                                </div>
                            </div>
                        </div>
                        <!-- Bed and Bathrooms -->
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="bedrooms" class="form-label"><strong>Number of Bedrooms</strong></label>
                                    <input type="text" name="bedrooms" class="form-control" value="{{$property->bedrooms}}" accept="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label for="bathrooms" class="form-label"><strong>Number of Bathrooms</strong></label>
                                    <input type="text" name="bathrooms" class="form-control" value="{{$property->bathrooms}}" accept="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="dev_lvl" class="form-label"><strong>Development Level</strong></label>
                                    <select required name="dev_lvl" id="dev_lvl" class="form-control">
                                        <option value="1" {{$property->dev_lvl == 1 ? 'selected' : ''}}>Under Construction</option>
                                        <option value="2" {{$property->dev_lvl == 2 ? 'selected' : ''}}>Built</option>
                                        <option value="3" {{$property->dev_lvl == 3 ? 'selected' : ''}}>Under Renovation</option>
                                        <option value="4" {{$property->dev_lvl == 4 ? 'selected' : ''}}>Renovated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label for="year_built" class="form-label"><strong>Year Built</strong></label>
                                    <input type="number" name="year_built" id="year_built" class="form-control" value="{{$property->year_built}}">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row mr-1">
                                    <label class="form-label"><strong>Property Type</strong></label>
                                </div>
                                <div class="form-group row ml-1">
                                    @foreach($types as $type)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$type->slug}}" id="{{$type->slug}}" value="{{$type->id}}" {{$type->show == 2 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="{{$type->slug}}">{{$type->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Interior Features</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($interior_features as $feature)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$feature->slug}}" id="{{$feature->slug}}" value="{{$feature->id}}" {{$feature->show == 2 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="{{$feature->slug}}">{{$feature->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Exterior Finish</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($exterior_finish as $finish)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$finish->slug}}" id="{{$finish->slug}}" value="{{$finish->id}}" {{$finish->show == 2 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="{{$finish->slug}}">{{$finish->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Featured Amenitis</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($featured_amenities as $amenities)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$amenities->slug}}" id="{{$amenities->slug}}" value="{{$amenities->id}}" {{$amenities->show == 2 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="{{$amenities->slug}}">{{$amenities->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Appliances</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($appliances as $appliance)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$appliance->slug}}" id="{{$appliance->slug}}" value="{{$appliance->id}}" {{$appliance->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$appliance->slug}}">{{$appliance->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Views</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($views as $view)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$view->slug}}" id="{{$view->slug}}" value="{{$view->id}}" {{$view->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$view->slug}}">{{$view->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Heating</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($heatings as $heating)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$heating->slug}}" id="{{$heating->slug}}" value="{{$heating->id}}" {{$heating->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$heating->slug}}">{{$heating->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Cooling</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($coolings as $cooling)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$cooling->slug}}" id="{{$cooling->slug}}" value="{{$cooling->id}}" {{$cooling->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$cooling->slug}}">{{$cooling->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Roof</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($roofs as $roof)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$roof->slug}}" id="{{$roof->slug}}" value="{{$roof->id}}" {{$roof->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$roof->slug}}">{{$roof->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Sewer-Water System</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($sewer_water_systems as $sewer_water_system)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$sewer_water_system->slug}}" id="{{$sewer_water_system->slug}}" value="{{$sewer_water_system->id}}" {{$sewer_water_system->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$sewer_water_system->slug}}">{{$sewer_water_system->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Extra Features</strong></label>
                                </div>
                                <div class="form-group row">
                                    @foreach($extra_features as $extra_feature)
                                    <div class="form-check abc-checkbox abc-checkbox-success form-check-inline mx-4 mb-1">
                                        <input class="form-check-input" type="checkbox" name="{{$extra_feature->slug}}" id="{{$extra_feature->slug}}" value="{{$extra_feature->id}}" {{$extra_feature->show == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{$extra_feature->slug}}">{{$extra_feature->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="gallery" class="form-label"><strong>Image Gallery</strong></label>
                                    <input type="file" name="gallery[]" id="gallery" class="form-control" accept="image/*" multiple required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="description" class="form-label"><strong>Description</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div id="loader" class="text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden"></span>
                                        </div>
                                    </div>
                                    <textarea class="form-control" id="description" name="description" hidden placeholder="Enter the Description" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade .bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><strong>How to add google maps location</strong></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-1">
                <img src="{{asset('assets/img/mapstut.gif')}}" style="width: 100%; height:auto; overflow:contain; margin:none;" alt="">
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

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
    document.addEventListener('DOMContentLoaded', function() {
        var loader = document.getElementById('loader');
        CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
            ckfinder: {},
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
                    'link', '|',
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
            minHeight: '100px',
            placeholder: 'Enter the Description',

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
            contentLanguageDirection: 'rtl',

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
        }).then(editor => {
            loader.style.display = 'none';
        }).catch(error => {
            console.error('Error initializing CKEditor:', error);
            loader.style.display = 'none';
        });
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