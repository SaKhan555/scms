@extends('template.master')
@section('title', 'Customer')
<style type="text/css" media="screen">
.card-body span {
	border-bottom: 1px solid grey;
}	

</style>
@section('content')
<div class="card">
	<div class="card-header">
		<button type="button" onclick="print_doc('print_div')">Print</button>
		<h6 class="float-left">Customer {{ ucfirst($customer->name) }} Details</h6>
		<div class="float-right">
			<div class="dropdown">
  <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    File
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{ route('admin.customer.edit',[$customer->id]) }}" title="Edit {{$customer->name}}"><i class="fa fa-edit"></i> Edit</a>
    <a class="dropdown-item" href="" title="Generate Details PDF"><i class="fa fa-file"></i> Generate PDF</a>
    <a class="dropdown-item" href="{{ route('admin.customer.index') }}" title="Close"><i class="fa fa-times"></i> Exit</a>
  </div>
</div>
		</div>
	</div>
	<div class="card-body" id="print_div">
		<div class="bg-success text-white">
			<p>this is test block</p>
		</div>
		<div class="row">
			<div class="col-md-8">
				<table class="table table-striped table-bordered">
						<tr>
							<th>Code Number</th><td>{{ $customer->customer_code_number }}</td>
						</tr>
						<tr>
							<th>Email</th><td>{{ $customer->email }}</td>
						</tr>
						<tr>
							<th>Contact Number</th><td>{{ $customer->contact_number_primary }}</td>
							</tr>
							<tr>
							<th>Country</th><td>{{ $customer->country->name }}</td>
							</tr>
							<tr>
							<th>City</th><td>{{ $customer->city->name }}</td>
							</tr>
							<tr>
							<th>Address</th><td>{{ $customer->address }}</td>
						</tr>
				</table>
			</div>   
			<div class="col-md-4">
				<img class="img-thumbnail" src="{{asset('uploads/customer/'.$customer->image_url)}}" alt="{{ $customer->name }}">
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
					<td>{{ $customer->created_at->toDayDateTimeString() }}</td>
				</tr>		
			</table>	
		</div>
	</div>
</div>
	<a href="{{ route('admin.customer.index') }}" class="btn btn-danger btn-sm mt-5" title="Go Back">Back</a>
@endsection
	@section('script')

<script src="{{ asset('js/customer/customer.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@endsection
