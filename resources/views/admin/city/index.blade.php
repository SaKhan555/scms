
@extends('template.master') @section('title', 'Countries')
@section('content')
	<div class="card">
		<div class="card-header">
			Cities
			<button type="button" class="btn btn-primary btn-sm float-right"
				id="init_modal" title="Add new City">
				<i class="fa fa-plus"></i>
			</button>
		</div>
		<div class="card-body">
			<div class="col-md-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Sr#</th>
							<th>Name</th>
							<th>Created By</th>
							<th>Created On</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody id="reload_div">
						@php
							$sr = $cities->perPage() * ($cities->currentPage() - 1) + 1
						@endphp
					@foreach($cities as $city)
						<tr>
							<td>{{ $sr++ }}</td>
							<td>{{ ucfirst($city->name).' - '.ucfirst($city->country->name) }}</td>
							<td>{{ $city->user_id }}</td>
							<td>{{ $city->created_at->toDayDateTimeString() }}</td>
							<td class="text-center">
							<a href="{{ route('admin.city.edit',[$city->id]) }}" class="btn btn-primary btn-sm" title="Edit City">Edit <i class="fa fa-edit"></i></a>
							
							<form action="{{ route('admin.city.destroy',[$city->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
								@method('Delete')
								{{ csrf_field() }}
								<button type="submit" class="btn btn-danger btn-sm">
									Delete <i class="fa fa-trash"></i>
								</button>
							</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{!! $cities->render() !!}
			</div>
		</div>
	</div>
@endsection 
@section('script')

<script>
var formData = `<form>
{{ csrf_field() }}
<div class="form-group">
<label>Select Country <span class="text-danger">*</span> </label>
<select name="country" class="form-control" placeholder="Select any option" id="country">
<option selected disabled>Select any option</option>
@foreach($countries as $country)
	<option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>
@endforeach
</select>
</div>
<div class="form-group mt-1">
<label for="name">City Name <span class="text-danger">*</span> </label>
<input type="text" id="name" name="name" class="form-control" placeholder="City Name" required="true"  autofocus="autofocus">
</div>
<div class="text-right">
<button type="reset" class="btn btn-danger btn-sm ">Reset</button>
<button type="button" class="btn btn-success btn-sm" id="btn_add">Submit</button>
</div>
</form>`;
</script>

<script src="{{ asset('js/city/city.js') }}" type="text/javascript"
	charset="utf-8" async defer></script>
@endsection
