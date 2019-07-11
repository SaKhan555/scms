@extends('template.master')
@section('title','Add New Customer')

<style>
	form span {
		color:red;
	}
</style>

@section('content')
<div class="card">
	<div class="card-header">
		<h5>Add new Customer</h5>
	</div>
	<div class="card-body">
		<form action="{{ route('admin.customer.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			{{ csrf_field() }}
		<table class="table table-striped tabel-bor">
				<tr>
					<th>Name <span>*</span></th>
					<td><input type="text" class="form-control" name="name" placeholder="Name " required="true"></td>
					<th>Email <span>*</span></th>
					<td><input type="email" class="form-control" name="email" placeholder="Email " required="true"></td>
				</tr>
				<tr>
					<th>Contact Number <span>*</span></th>
					<td><input type="tel" class="form-control" name="contact_number_primary"  placeholder="Conatact Number" required="true">
					</td>
					<th>C/N Optional</th>
					<td><input type="tel" class="form-control" name="contact_number_optional"  placeholder="Conatact Number Optional">
					</td>
				</tr>
				<tr>
					<th>Country <span>*</span></th>
					<td>
						<select name="country" class="form-control" required id="country">
							<option disabled selected>Select your Country</option>
							@foreach($countries as $country)
								<option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>
							@endforeach
						</select>
					</td>
					<th>City <span>*</span></th>
					<td>
						<select class="form-control" name="city" required id="city">
							<option disabled selected>Select your City</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Address <span>*</span></th>
					<td colspan="3">
						<input type="text" class="form-control" name="address"  placeholder="Address" required>
					</td>
				</tr>
				<tr>
					<th>Image</th>
					<td>
						<input type="file" class="form-control" name="image"  placeholder="Upload image">
					</td>
					<th colspan="2" class="text-right">
						<a href="{{ route('admin.customer.index') }}" class="btn btn-danger btn-sm" title="Cancel">Cancel</a>
						<button type="submit" class="btn btn-primary btn-sm">Submit</button>
					</th>
				</tr>

		</table>
	</form>
	</div>
</div>

@endsection
@section('script')
<script src="{{ asset('js/customer/customer.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection