@extends('template.master')
@section('title', 'Vendor')
@section('content')
<div class="card">
	<div class="card-header">
		<h6 class="float-left">Edit Vendor <span class="text-primary">{{ $vendor->name }}</span></h6>
		<h6 class="float-right">Code Number: <span class="text-primary">{{ $vendor->vendor_code_number }}</span></h6>
	</div>
	<div class="card-body">
		<div class="col-md-12">
			<form action="{{ route('admin.vendor.update',[$vendor->id]) }}" method="POST" enctype="multipart/form-data">
				@method('PUT')
				{{ csrf_field() }}
				<table class="table table-striped table-bordered">
					<tr>
						<th>Name</th>
						<td>
							<input type="text" class="form-control" name="name" required="true" value="{{ $vendor->name }}">
						</td>
						<th>Email</th>
						<td>
							<input type="email" name="email" class="form-control" id="inputEmail" value="{{ $vendor->email }}">	
						</td>
					</tr>
					<tr>
						<th>Contact Number</th>
						<td>
							<input type="tel" class="form-control" name="contact_number" value="{{ $vendor->contact_number_primary }}">
						</td>
						<th>C/N Optional</th>
						<td>
							<input type="tel" class="form-control" name="contact_number_optional" placeholder="Contact Number Optional" value="{{ $vendor->contact_number_optional }}">	
						</td>
					</tr>
					<tr>
						<th>Country</th>
						<td>
							<select name="country" class="form-control" required="true" id="country">
								@foreach($countries as $country)
								<option value="{{ $country->id }}" {{ ($vendor->country_id == $country->id) ? 'selected' : '' }}>{{ ucfirst($country->name) }}</option>
								@endforeach
							</select>
						</td>
						<th>City</th>
						<td>
							<select name="city" class="form-control" required="true" id="city">
								@foreach($cities->cities as $city)
								<option value="{{ $city->id }}" {{ ($vendor->city_id == $city->id) ? 'selected' : ''  }}>{{ $city->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Image</th>
						<td>
							<input type="file" name="image" class="form-control" placeholder="Upload your image">
						</td>
						<th>View Image</th>
						<td class="text-center">
							<button type="button" data-toggle="modal" data-target = "#e_img_modal" title="View image" class="btn btn-sm btn-outline-secondary">
								<i class="fa fa-eye"></i>
							</button>
						</td>
					</tr>
					<tr>
						<th>Address</th>
						<td colspan="3">						
							<textarea name="address" class="form-control" required="true">{{ $vendor->address }}</textarea>
						</td>
					</tr>
					<tr>
						<th colspan="4" class="text-right">
							<a href="{{ route('admin.vendor.index') }}" class="btn btn-danger btn-sm">Cancel</a>
							<button type="submit" class="btn btn-pill btn-primary btn-sm">Update</button>
						</th>
					</tr>
				</table>
			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="e_img_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">

				<button type="button" class="close rounded-circle btn-sm text-danger" data-dismiss="modal" aria-label="Close" style="margin: -21px 2px !important;
				padding: 0px !important;
				height: 0px;
				width: 0px;">
				&times;
			</button>

			<img src="{{ asset('uploads/vendor/'.$vendor->image_url) }}" alt="img not found" class="img-fluid">
			<h5 class="card-subtitle"><mark>{{ $vendor->name }}</mark></h5>
		</div>
	</div>
</div>
</div>

@endsection

@section('script')
<script src="{{ asset('js/vendor/vendor.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection