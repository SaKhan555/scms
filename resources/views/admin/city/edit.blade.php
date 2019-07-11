@extends('template.master') @section('title', 'Countries')
@section('content')
	<div class="card">
		<div class="card-header">
			Countries
		</div>
		<div class="card-body">
				<form action="{{ route('admin.city.update',[$city->id]) }}"
					method="POST">
					@method('PUT')
						{{ csrf_field() }}
						<div class="row">
						<div class="col-md-6">
						<label>Country: </label>
							<select name="country" class="form-control" placeholder="Select any option">
								@foreach($countries as $country)
								<option value="{{ $country->id }}" {{ ($city->country_id == $country->id) ? 'selected' : '' }}>{{ ucfirst($country->name) }}</option>
								@endforeach
							</select> 
						</div>
						<div class="col-md-6">
						<label for="name">Name: </label> 
							<input type="text" id="name" name="name" class="form-control"
								required="true" value="{{ $city->name }}">
						</div>
					</div>
					<div class="text-right mt-5">

					<button type="submit" class="btn btn-success btn-sm">Update</button>
					</div>
				</form>
		</div>
	</div>
	<a href="{{ route('admin.city.index') }}" class="btn btn-danger btn-sm mt-5" title='Cancel'>Cancel</a>
@endsection @section('script')
<script src="{{ asset('js/city/city.js') }}"
	type="text/javascript" charset="utf-8" async defer></script>
@endsection
