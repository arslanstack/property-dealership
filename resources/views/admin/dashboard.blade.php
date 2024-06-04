@extends('admin.admin_app')
@section('content')
<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Client Users</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">12</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/users') }}"><span class="label label-primary">View</span></a></div>
					<small>Client Users</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Property Listings</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">12</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/properties') }}"><span class="label label-primary">View</span></a></div>
					<small>Property Listings</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Property Features</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">12</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/features') }}"><span class="label label-primary">View</span></a></div>
					<small>Property Features</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Property Types</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">12</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/types') }}"><span class="label label-primary">View</span></a></div>
					<small>Property Types</small>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection