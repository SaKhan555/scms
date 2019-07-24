@extends('template.master')
@section('title', 'Items')
<style>
	form span {
		color: red;
	}
</style>
@section('content')
<div class="card">
	<div class="card-header">Item
		<button type="button" class="btn btn-primary float-right" id="init_modal" title="Add new Item">
			<i class="fa fa-plus"></i></button>
	</div>
	<div class="card-body">
		<div class="col-md-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Sr#</th>
						<th>Code Number</th>
						<th>Name</th>
						<th>Item Category</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="reload_div">
					@php
					$sr = $items->perPage() * ($items->currentPage() - 1) + 1
					@endphp
					@foreach($items as $item)

					<tr>
						<td>{{ $sr++ }}</td>
						<td>{{ $item->item_code_number }}</td>
						<td>{{ ucfirst($item->name) }}</td>
						<td>
							{{ ucfirst($item->item_category->name) }}
						</td>
						<td class="text-center">
							<a href="{{ route('admin.item.show',[$item->id]) }}" class="btn btn-info btn-sm">
								View <i class="fa fa-eye"></i>
							</a>
							<button type="button" data-id="{{ $item->id }}" class="btn btn-sm btn-primary btn_edit">Edit
								<i class="fa fa-edit"></i></button>

							<form action="{{ route('admin.item.destroy',[$item->id]) }}" method="POST"
								accept-charset="utf-8" style="display: inline-block !important;">
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
			<div class="text-center">
				{!! $items->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')

<script>
	var formDataString = `<form enctype="multipart/form-data">
		<div class="form-group">
		<label>Item Category <span>*</span> </label>
		<select name="item_category" id="item_category" class="form-control" required="true" autofocus="autofocus">
		<option selected disabled value="">Select Item Category</option>
		@foreach($item_categories as $item_category)
		<option value="{{ $item_category->id }}">{{ $item_category->name }}</option>
		@endforeach
		</select>
		</div>
		<div class="form-group" >
		<label for="name">Name <span>*</span></label>
		<input type="text" id="name" name="name" class="form-control" placeholder="Name" required="true">
		</div>	
		<div class="form-group" >
		<label>Item Details: </label>
		<textarea name="details" id="details" class="form-control"></textarea>
		</div>
		<div class="form-group" >
		<label>Item Image: </label>
		<input type="file" id="image" name="image" class="form-control" placeholder="Upload item image">
		</div>
		<div class="form-group text-right">
		<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel <i class="fa fa-times"></i></button>
		<button type="button" class="btn btn-success btn-sm" id="btn_add">Submit <i class="fa fa-check"></i></button>
		</div>
		<hr />
		<code>Note: Item code will generate automatically by adding item.</code>
		<hr />
		</form>`;
</script>

<script src="{{ asset('js/item/item.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection