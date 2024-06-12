@extends('admin.admin_app')
@push('styles')
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
                <a href="{{ url('admin/evaluations') }}"> Home Evaluation Requests </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Request Details:</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" href="{{url('admin/evaluations')}}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to All Requests
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 class="text-navy">Request Sent By {{$eval['fname'] . ' '. $eval['lname']}} on {{date_formated($eval['created_at'])}}.</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- <form id="edit_eval_form" method="post">
                        @csrf -->
                    <!-- <input type="hidden" name="id" class="form-control" value="{{ $eval['id'] }}"> -->
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Client Name
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['fname'] . ' ' . $eval['lname'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Email
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['email'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Phone
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['phone'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Address
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['address']}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        City
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['city'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        State
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['state'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Zip Code
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['zip']}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Year Built
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['year_built'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Size <small>(sqft)</small>
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['size'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Bedrooms
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['bedroom']}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Bathrooms
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['bathroom'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Plan to Move
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['move_plan'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Has Suite
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['has_suite']}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Garages
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['garage'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Garage Type
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['garage_type'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Basement Type
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['basement_type']}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Development Level
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['dev_lvl'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group row"><label class="col-5 col-form-label"><strong>
                                        Half Bathrooms
                                        :</strong></label>

                                <div class="col-7">
                                    <label class="col-form-label">{{ $eval['half_bathroom'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <p style="text-align:justify;"><strong class="mr-3">Notes: :</strong> {{$eval['notes']}}</p>
                        </div>
                    </div>

                    <!-- </form> -->
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