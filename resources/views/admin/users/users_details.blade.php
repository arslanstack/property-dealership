@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2> Users Details </h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">
				<strong> Users Details </strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-4 text-right">
		<a class="btn btn-primary t_m_25" href="{{ url('admin/users') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Users
		</a>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
				<div class="row ibox-content" style="border: none !important;">
					<div class="col-md-4">
						<div class="ibox-title" style="border: none !important;">
							<h5>Profile Image</h5>
						</div>
						<div>
							<div class="ibox-content p-4 border-left-right text-center">
								<img alt="image" class="img-fluid" src="{{ asset('assets/upload_images') }}/{{$user->image_name}}" style="width: 250px; height: 250px; object-fit:contain;">
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="ibox">
							<div class="ibox-title" style="border: none !important;">
								<h5>User Details</h5>
							</div>
							<div class="ibox-content">
								<div>
									<div class="feed-activity-list">
										<div class="row">
											<div class="col-lg-12">
												<div class="row">
													<strong class="col-sm-2 col-form-label">User Name</strong>
													<div class="col-sm-4 col-form-label text-danger">
														{{ $user->fname . ' ' . $user->lname  }}
													</div>
													<strong class="col-sm-2 col-form-label">Email</strong>
													<div class="col-sm-4 col-form-label">
														{{ $user->email }}
													</div>
												</div>
												<div class="row">
													<strong class="col-sm-2 col-form-label">Phone No</strong>
													<div class="col-sm-4 col-form-label">
														{{ $user->phone_no }}
													</div>
												</div>
												<div class="row">
													<strong class="col-sm-2 col-form-label">Joining Date</strong>
													<div class="col-sm-4 col-form-label">
														{{ date_formated($user->created_at) }}
													</div>
													<strong class="col-sm-2 col-form-label">Status</strong>
													<div class="col-sm-4 col-form-label">
														@if($user->is_blocked == 1)
														<label class="label label-danger"> Blocked </label>
														@else
														@if ($user->status==1)
														<label class="label label-primary"> Active </label>
														@else
														<label class="label label-warning"> Inactive </label>
														@endif
													</div>
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(document).on("click", ".btn_update_status", function() {
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status');
		var show_text = $(this).attr('data-text');
		swal({
				title: "Are you sure?",
				text: show_text,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Please!",
				cancelButtonText: "No, Cancel Please!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$(".confirm").prop("disabled", true);
					$.ajax({
						url: "{{ url('admin/product-posts/update_statuses') }}",
						type: 'post',
						data: {
							"_token": "{{ csrf_token() }}",
							'id': id,
							'status': status
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
	$(document).on("click", ".btn_update_status_requests", function() {
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status');
		var show_text = $(this).attr('data-text');
		swal({
				title: "Are you sure?",
				text: show_text,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Please!",
				cancelButtonText: "No, Cancel Please!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$(".confirm").prop("disabled", true);
					$.ajax({
						url: "{{ url('admin/product-requests/update_statuses') }}",
						type: 'post',
						data: {
							"_token": "{{ csrf_token() }}",
							'id': id,
							'status': status
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
</script>
@endpush