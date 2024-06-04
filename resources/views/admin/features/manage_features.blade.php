@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Features </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Features </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" data-toggle="modal" data-target="#add_modalbox">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Feature
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="search_form" action="{{url('admin/features')}}" method="GET" enctype="multipart/form-data">
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control" style="height: auto !important;" name="search_type">
                                        <option value="99" {{ old('search_type', $searchParams['search_type'] ?? '') == 99 ? 'selected' : '' }}>All Feature Types</option>
                                        <option value="1" {{ old('search_type', $searchParams['search_type'] ?? '') == 1 ? 'selected' : '' }}>Interior Feature</option>
                                        <option value="2" {{ old('search_type', $searchParams['search_type'] ?? '') == 2 ? 'selected' : '' }}>Exterior Finish</option>
                                        <option value="3" {{ old('search_type', $searchParams['search_type'] ?? '') == 3 ? 'selected' : '' }}>Featured Amenities</option>
                                        <option value="4" {{ old('search_type', $searchParams['search_type'] ?? '') == 4 ? 'selected' : '' }}>Appliances</option>
                                        <option value="5" {{ old('search_type', $searchParams['search_type'] ?? '') == 5 ? 'selected' : '' }}>Views</option>
                                        <option value="6" {{ old('search_type', $searchParams['search_type'] ?? '') == 6 ? 'selected' : '' }}>Heating</option>
                                        <option value="7" {{ old('search_type', $searchParams['search_type'] ?? '') == 7 ? 'selected' : '' }}>Cooling</option>
                                        <option value="8" {{ old('search_type', $searchParams['search_type'] ?? '') == 8 ? 'selected' : '' }}>Roof</option>
                                        <option value="9" {{ old('search_type', $searchParams['search_type'] ?? '') == 9 ? 'selected' : '' }}>Sewer-Water Systems</option>
                                        <option value="10" {{ old('search_type', $searchParams['search_type'] ?? '') == 10 ? 'selected' : '' }}>Extra Features</option>
                                    </select>
                                    <input type="text" class="form-control" name="search_query" placeholder="Search by Feature Title or Leave Blank" value="{{ old('search_query', $searchParams['search_query'] ?? '') }}">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="manage_tbl" class="table table-striped table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Title</th>
                                    <th>Feature Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($features as $item)
                                <tr class="gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->title  }}</td>
                                    <td>{{ mapfeaturetype($item->type) }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn_feature_edit" data-id="{{$item->id}}" type="button"><i class="fa-solid fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm btn_delete" data-id="{{$item->id}}" data-text="you want to delete this feature?" type="button" data-placement="top" title="Delete">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <p>Showing {{ $features->firstItem() }} to {{ $features->lastItem() }} of {{ $features->total() }} entries</p>
                        </div>
                        <div class="col-md-3 text-right">
                            {{ $features->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal show fade" id="add_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Add New Feature</h5>
            </div>
            <div class="modal-body">
                <form id="add_feature_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Feature Title</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" placeholder="Feature Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Feature Type</strong></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="type">
                                <option value="1">Interior Feature</option>
                                <option value="2">Exterior Finish</option>
                                <option value="3">Featured Amenities</option>
                                <option value="4">Appliances</option>
                                <option value="5">Views</option>
                                <option value="6">Heating</option>
                                <option value="7">Cooling</option>
                                <option value="8">Roof</option>
                                <option value="9">Sewer-Water Systems</option>
                                <option value="10" selected>Extra Features</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_feature_button"> Submit </button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal show fade" id="edit_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY" id="edit_modalbox_body">
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#manage_tbl').dataTable({
        "paging": false,
        "searching": false,
        "bInfo": false,
        "responsive": true,
        "columnDefs": [{
                "responsivePriority": 1,
                "targets": 0
            },
            {
                "responsivePriority": 2,
                "targets": -1
            },
        ]
    });
    $(document).on("click", ".btn_delete", function() {
        var id = $(this).attr('data-id');
        var show_text = $(this).attr('data-text');
        swal({
                title: "Are you sure",
                text: show_text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, please!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $(".confirm").prop("disabled", true);
                    $.ajax({
                        url: "{{ url('admin/features/delete') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                        },
                        dataType: 'json',
                        success: function(status) {
                            $(".confirm").prop("disabled", false);
                            if (status.msg == 'success') {
                                swal({
                                        title: "Success!",
                                        text: status.response,
                                        type: "success"
                                    },
                                    function(data) {
                                        location.reload();
                                    });
                            } else if (status.msg == 'error') {
                                swal("Error", status.response, "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "", "error");
                }
            });
    });

    $(document).on("click", "#save_feature_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#add_feature_form")[0]);
        $.ajax({
            url: "{{ url('admin/features/store') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                console.log(status);
                if (status.msg == 'success') {
                    $("#add_feature_form")[0].reset();
                    btn.ladda('stop');
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
    $(document).on("click", ".btn_feature_edit", function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('admin/features/feature-show') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success: function(status) {
                $("#edit_modalbox_body").html(status.response);
                $("#edit_modalbox").modal('show');
            }
        });
    });
    $(document).on("click", "#update_feature_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#edit_feature_form")[0]);
        $.ajax({
            url: "{{ url('admin/features/update-feature') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
</script>
@endpush