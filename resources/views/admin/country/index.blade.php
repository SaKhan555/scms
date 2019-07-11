@extends('template.master')
@section('title', 'Countries')
@section('content')
	<div class="card">
		<div class="card-header">Countries
			<button type="button" class="btn btn-primary float-right" id="init_modal" title="Add new Country">
				<i class="fa fa-plus"></i></button>
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
							 $sr = $countries->perPage() * ($countries->currentPage() - 1) + 1
							 @endphp
							@foreach($countries as $country)
							
							<tr>
								<td>{{ $sr++ }}</td>
								<td>{{ ucfirst($country->name) }}</td>
								<td>{{ $country->user_id }}</td>
								<td>{{ $country->created_at->toDayDateTimeString() }}</td>
								<td class="text-center">
									<button type="button" class="btn btn-primary btn-sm btn_edit" data-id="{{$country->id}}">
									<i class="fa fa-edit"></i> Edit
								</button>
										<button type="button" class="btn btn-danger btn-sm btn_delete" data-id="{{$country->id}}">
											Delete <i class="fa fa-trash"></i>
										</button>
								</td>
							</tr>

							@endforeach
						</tbody>
					</table>
					<div class="text-center">
						{!! $countries->render() !!}
					</div>						
				</div>
			</div>
		</div>
	@endsection

	@section('script')

<script>
var formData = `<form>
<div class="form-group">
<label for="name">Name: </label>
<input type="text" id="name" name="name" class="form-control" placeholder="Name" autocomplete="off"  autofocus="true">
</div>
<div class="text-right">
<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancer</button>
<button type="button" class="btn btn-success btn-sm" onclick="add_data()">Submit</button>
</div>
</form>`;
</script>
<script src="{{ asset('js/country/country.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@endsection
