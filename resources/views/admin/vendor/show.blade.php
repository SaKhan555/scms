@extends('template.master')
@section('title', 'Vendor')
<style type="text/css" media="screen">
.card-body span {
	border-bottom: 1px solid grey;
}	
</style>
@section('content')
<div class="card">
	<div class="card-header">
		<h6 class="float-left">Vendor {{ ucfirst($vendor->name) }} Details</h6>
		<div class="float-right">
			<div class="dropdown">
  <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    File
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{ route('admin.vendor.edit',[$vendor->id]) }}" title="Edit {{$vendor->name}}"><i class="fa fa-edit"></i> Edit</a>
    <a class="dropdown-item" href="{{ route('admin.vendor.generate_pdf',[$vendor->id]) }}" title="Generate Details PDF"><i class="fa fa-file"></i> Generate PDF</a>
    <a class="dropdown-item" href="{{ route('admin.vendor.index') }}" title="Close"><i class="fa fa-times"></i> Exit</a>
  </div>
</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-8">
				<table class="table table-striped">
						<tr>
							<th>Code Number</th><td>{{ $vendor->vendor_code_number }}</td>
						</tr>
						<tr>
							<th>Email</th><td>{{ $vendor->email }}</td>
						</tr>
						<tr>
							<th>Contact Number</th><td>{{ $vendor->contact_number_primary }}</td>
							</tr>
							<tr>
							<th>Country</th><td>{{ $vendor->country->name }}</td>
							</tr>
							<tr>
							<th>City</th><td>{{ $vendor->city->name }}</td>
							</tr>
							<tr>
							<th>Address</th><td>{{ $vendor->address }}</td>
						</tr>
				</table>
			</div>   
			<div class="col-md-4">
				<img class="img-thumbnail" src="{{asset('uploads/vendor/'.$vendor->image_url)}}" alt="{{ $vendor->name }}">
			</div>    	  	
		</div>
		<div class="float-right mt-5">
			<table>
				<tr>
					<th>Created By</th>
					<td>Admin</td>
				</tr>	    
				<tr>
					<th>Created On</th>
					<td>{{ $vendor->created_at->toDayDateTimeString() }}</td>
				</tr>		
			</table>	
		</div>
	</div>
</div>
	<a href="{{ route('admin.vendor.index') }}" class="btn btn-danger btn-sm mt-5" title="Go Back">Back</a>
@endsection