@extends('template.master')
@section('title', 'Vendors')
@section('content')
<style type="text/css" media="screen">
form span {
	color: red;
}
</style>
<div class="card">
	<div class="card-header">
		<h5>Add Vendors</h5>
	</div>

	<div class="card-body">
		<form action="{{ route('admin.vendor.store') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<table class="table table-striped table-bordered">
				<tr>
					<th>Name <span>*</span></th>
					<td>
						<input type="text" class="form-control form-control-sm" name="name" placeholder="Name" required="true">	
					</td>
					<th>
						Email <span>*</span>
					</th>
					<td>
						<input type="email" name="email" class="form-control form-control-sm" id="inputEmail" placeholder="Enter email">
					</td>
				</tr>
				<tr>
					<th style="width: 11rem;">Contact Number <span>*</span></th>
					<td>
						<input type="tel" class="form-control form-control-sm" name="contact_number" placeholder="Contact Number" required="true">	

					</td>
					<th style="width: 10rem;">C/N Optional</th>
					<td>
						<input type="tel" class="form-control form-control-sm" name="contact_number_optional" placeholder="Contact Number Optional">

					</td>
				</tr>
				<tr>
					<th>
						Country <span>*</span>
					</th>
					<td>
						<select name="country" class="form-control form-control-sm" required="true" id="country">
							<option selected disabled>Select your Country</option>
							@foreach($countries as $country)
							<option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>}
							@endforeach
						</select>
					</td>
					<th>
						City <span>*</span>
					</th>
					<td>
						<select name="city" class="form-control form-control-sm" required="true" id="city">
							<option selected disabled>Select your City</option>}
						</select>
					</td>
				</tr>
				<tr>
					<th>
						Address <span>*</span>
					</th>
					<td colspan="5">
						<input name="address" class="form-control form-control-sm" required="true" placeholder="Address">
					</td>
				</tr>
				<tr>
					<th>Image</th>
					<td>
						<input type="file" class="form-control" name="image" placeholder="Uploade image">
					</td>
					<th colspan="2" class="text-right">	
						<a href="{{ route('admin.vendor.index') }}" class="btn btn-sm btn-danger">Cancel</a>
						<button type="submit" class="btn btn-sm btn-primary">Submit</button>
					</th>
				</tr>
			</table>
		</form>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('js/vendor/vendor.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection