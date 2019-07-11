@extends('template.master')
@section('title', 'Item Categories')
@section('content')
<div class="card">
	<div class="card-header">Item Categories
		<button type="button" class="btn btn-primary float-right" id="init_modal" title="Add new Item Category">
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
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@php
						$sr = $item_categories->perPage() * ($item_categories->currentPage() - 1) + 1
						@endphp
						@foreach($item_categories as $item_category)

						<tr>
							<td>{{ $sr++ }}</td>
							<td>{{ ucfirst($item_category->name) }}</td>
							<td>{{ $item_category->user_id }}</td>
							<td>{{ $item_category->created_at->toDayDateTimeString() }}</td>
							<td>
								<a href="{{ route('admin.item_category.edit',[$item_category->id]) }}" class="btn btn-primary btn-sm">
									<i class="fa fa-edit"></i>
								</a>

								<form action="{{ route('admin.item_category.destroy',[$item_category->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
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
					{!! $item_categories->render() !!}
				</div>						
			</div>
		</div>
	</div>
	@endsection

	@section('script')

	<script>
		var formData = `<form action="{{ route('admin.item_category.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group">
		<label for="name">Name: </label>
		<input type="text" id="name" name="name" class="form-control" placeholder="Name" required="true"  autofocus="autofocus">
		</div>
		<button type="submit" class="btn btn-success btn-block">Submit</button>
		</form>`;
	</script>

	<script src="{{ asset('js/item_category/item_category.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@endsection