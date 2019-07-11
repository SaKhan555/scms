@extends('pdf_template.master')
@section('content')


<div id="content">
			<div class="clearfix"></div>
		<h4 class="text-center text-capitalize alert alert-secondary">Vendor {{ ucfirst($vendor->name) }} Details</h4>
		<div class="clearfix"></div>
		<div class="row">
			<div class="table_div">
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

			<div class="img_div">
				<img style="width:200px;" src="{{asset('uploads/vendor/'.$vendor->image_url)}}" alt="{{ $vendor->name }}">
			</div>
		</div>
	</div>
@endsection
