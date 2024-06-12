@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2> User Details </h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">
				<strong> User Details </strong>
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
					<!-- <div class="col-md-4">
						<div class="ibox-title" style="border: none !important;">
							<h5>Profile Image</h5>
						</div>
						<div>
							<div class="ibox-content p-4 border-left-right text-center">
								<label for="image" class="">
									<img alt="image" class="img-fluid" id="perviewImg" src="{{$user->image}}" style="width: 250px; height: 250px; object-fit:contain;">
								</label>
							</div>
						</div>
					</div> -->
					<div class="col-md-12">
						<div class="ibox">
							<div class="ibox-title" style="border: none !important;">
								<h5>User Details</h5>
							</div>
							<div class="ibox-content">
								<div>
									<form action="{{url('admin/users/update')}}" method="post" enctype="multipart/form-data">
										@csrf
										<input type="text" name="id" value="{{$user->id}}" hidden>
										<div class="feed-activity-list">
											<div class="row mt-4">
												<div class="col-lg-12">
													<div class="row">
														<strong class="col-sm-2 col-form-label">First Name<sup class="text-danger">*</sup></strong>
														<div class="col-sm-4">
															<input type="text" class="form-control" name="fname" id="fname" value="{{$user->fname}}" required>
														</div>
														<strong class="col-sm-2 col-form-label">Last Name<sup class="text-danger">*</sup></strong>
														<div class="col-sm-4">
															<input type="text" class="form-control" name="lname" id="lname" value="{{$user->lname}}" required>
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col-lg-12">
													<div class="row">
														<strong class="col-sm-2 col-form-label">Email</strong>
														<div class="col-sm-4">
															<input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" readonly disabled required>
														</div>
														<strong class="col-sm-2 col-form-label" data-placement="top" title="Add new password to reset or leave blank.">New Password</strong>
														<div class="col-sm-4" data-placement="top" title="Add new password to reset or leave blank.">
															<input type="text" class="form-control" name="password" id="password" placeholder="New Password To Reset or Leave Blank">
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col-lg-12">
													<div class="row">
														<strong class="col-sm-2 col-form-label">Phone</strong>
														<div class="col-sm-4">
															<input type="text" class="form-control" name="phone_no" id="phone_no" value="{{$user->phone_no ?? ''}}">
														</div>
														<strong class="col-sm-2 col-form-label">Image</strong>
														<div class="col-sm-4">
															<input type="file" class="form-control" name="image" id="image">
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col-lg-12">
													<div class="row">
														<div class="col-sm-12 text-right">
															<button type="submit" class="btn btn-primary">Save</button>
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
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(document).ready(function() {
		$('#image').change(function() {
			var file = this.files[0];
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#perviewImg').attr('src', e.target.result);
			}
			reader.readAsDataURL(file);
		});
	});

	var session = "{{Session::has('error') ? 'true' : 'false'}}";
	if (session == 'true') {
		toastr.options = {
			"closeButton": true,
			"progressBar": true,
			"positionClass": "toast-top-right"
		}
		toastr.error("{{Session::get('error')}}");
	}
	var session = "{{Session::has('success') ? 'true' : 'false'}}";
	if (session == 'true') {
		toastr.options = {
			"closeButton": true,
			"progressBar": true,
			"positionClass": "toast-top-right"
		}
		toastr.success("{{Session::get('success')}}");

	}
</script>
@endpush