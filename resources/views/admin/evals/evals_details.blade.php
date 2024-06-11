@extends('admin.admin_app')
@push('styles')
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
        <h2>Home Evaluation Details</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/home-evaluation-requests') }}"> Home Evaluation Requests </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Request Details</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" href="{{url('admin/home-evaluation-requests')}}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to All Requests
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="edit_eval_form" method="post">
                        @csrf
                        <input type="hidden" name="id" class="form-control" value="{{ $eval['id'] }}">
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Client Name</strong></label>
                                    <input type="text" disabled name="fname" class="form-control" placeholder="fname" value="{{ $eval['fname'] . $eval['lname'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Email</strong></label>
                                    <input type="text" disabled name="email" class="form-control" placeholder="email" value="{{ $eval['email'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Phone</strong></label>
                                    <input type="text" disabled name="phone" class="form-control" placeholder="phone" value="{{ $eval['phone'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Address <small>(Line 1)</small></strong></label>
                                    <input type="text" disabled name="address" class="form-control" placeholder="address" value="{{ $eval['address'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>City</strong></label>
                                    <input type="text" disabled name="city" class="form-control" placeholder="city" value="{{ $eval['city'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>State</strong></label>
                                    <input type="text" disabled name="state" class="form-control" placeholder="state" value="{{ $eval['state'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Zip Code</strong></label>
                                    <input type="text" disabled name="zip" class="form-control" placeholder="zip" value="{{ $eval['zip'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Year Built</strong></label>
                                    <input type="text" disabled name="year_built" class="form-control" placeholder="year_built" value="{{ $eval['year_built'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Size <small>(sqft)</small></strong></label>
                                    <input type="text" disabled name="size" class="form-control" placeholder="size" value="{{ $eval['size'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Bedrooms</strong></label>
                                    <input type="text" disabled name="bedroom" class="form-control" placeholder="bedroom" value="{{ $eval['bedroom'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Bathrooms</strong></label>
                                    <input type="text" disabled name="bathroom" class="form-control" placeholder="bathroom" value="{{ $eval['bathroom'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Half Bathroom</strong></label>
                                    <input type="text" disabled name="half_bathroom" class="form-control" placeholder="half_bathroom" value="{{ $eval['half_bathroom'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Has Suite</strong></label>
                                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapHasSuite($eval['has_suite']) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>No of Garages</strong></label>
                                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapGarage($eval['garage']) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Garage Type</strong></label>
                                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapGarageType($eval['garage_type']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Basement Type</strong></label>
                                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapBaseType($eval['basement_type']) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Development Level</strong></label>
                                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapDevLvl($eval['dev_lvl']) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Plan to Move</strong></label>
                                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapMovePlan($eval['move_plan']) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group row mx-1">
                                    <label class="form-label"><strong>Notes</strong></label>
                                    <p>{{$eval['notes']}}</p>
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