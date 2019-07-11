@extends('template.master')
@section('title', 'Warehouse')
<style>
form span {
	color: red;
}
</style>
@section('content')
<div class="card">
	<div class="card-header">
        <h6 class="float-left">Warehouse</h6>
		<button type="button" class="btn btn-primary btn-sm float-right" id="init_modal" title="Add new Warehouse">
			<i class="fa fa-plus"></i></button>
		</div>
		<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Sr#</th>
							<th>Code Number</th>
							<th>Warehouse Name</th>
							<th>Created By</th>
							<th>Created On</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@php
						$sr = $warehouses->perPage() * ($warehouses->currentPage() - 1) + 1
						@endphp
						@foreach($warehouses as $warehouse)
						<tr>
							<td>{{ $sr++ }}</td>
							<td>{{ $warehouse->warehouse_code_number }}</td>
							<td>{{ ucfirst($warehouse->name) }}</td>
							<td>{{ $warehouse->user_id }}</td>
							<td>{{ $warehouse->created_at->toDayDateTimeString() }}</td>
							<td>
								<a href="{{ route('admin.warehouse.show',[$warehouse->id]) }}" class="btn btn-info btn-sm">
									<i class="fa fa-eye"></i>
								</a>
								<a href="{{ route('admin.warehouse.edit',[$warehouse->id]) }}" class="btn btn-primary btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<form action="{{ route('admin.warehouse.destroy',[$warehouse->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
									@method('Delete')
									{{ csrf_field() }}
									<button type="submit" class="btn btn-danger btn-sm">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{!! $warehouses->render() !!}
				</div>						
		</div>
	</div>

	@endsection

	@section('script')

	<script>

		var formData = `<form action="{{ route('admin.warehouse.store') }}" method="POST">
		{{ csrf_field() }}

		<div class="form-group" >
		<label for="name">Warehouse Name <span>*</span></label>
		<input type="text" id="name" name="name" class="form-control" placeholder="Name" required="true">
        </div>	
        <div class="form-group">
        <label>Country <span>*</span></label>
        <select name="country" class="form-control" id="country" required="true" onchange="getCities();">
        <option selected disabled value="">Select Warehouse Country</option>
        @foreach($countries as $country)
            <option value="{{$country->id}}">{{ ucfirst($country->name) }}</option>
        @endforeach
        </select>
        </div>
        <div class="form-group">
            <label>City <span>*</span></label>
            <select name="city" class="form-control" id="city" required="true">
                <option selected disabled value="">Select City</option>
            </select>
        </div>
        <div class="form-group" >
		<label>Address <span>*</span></label>
		<textarea name="address" class="form-control" required="true"></textarea>
		</div>
		<div class="form-group" >
		<label>Details </label>
		<textarea name="details" class="form-control"></textarea>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</form>`;

	</script>

	<script src="{{ asset('js/warehouse/warehouse.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@endsection