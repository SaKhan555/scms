@extends('template.master')
@section('title', 'Edit Item')
@section('content')
<div class="card">
	<div class="card-header">Edit Item
	</div>
	<div class="card-body">
		<form action="{{ route('admin.item.update',[$item->id]) }}" method="POST" enctype="multipart/form-data">
			@method('PUT')
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-6">
					<label>Item Category: </label>
					<select name="item_category" class="form-control">
						@foreach($item_categories as $item_category)
						@if($item_category->id == $item->item_category_id)
						<option value="{{ $item_category->id }}" selected="true"> {{ $item_category->name }}</option>
						@else
						<option value="{{ $item_category->id }}"> {{ $item_category->name }}</option>											
						@endif
						@endforeach		
					</select>
				</div>
				<div class="col-md-6">
					<label>Name: </label>
					<input type="text" class="form-control" name="name" value="{{ $item->name }}">
				</div>
				<div class="col-md-6" >
					<label>Item Details: </label>
					<textarea name="details" class="form-control">{{ $item->details }}</textarea>
				</div>
				<div class="col-md-6 mt-5" >
					<label>Item Image: </label>
					<input type="file" name="image" placeholder="Upload item image">
					<button type="button" data-toggle="modal" data-target = "#e_img_modal" title="View image" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-eye"></i>
					</button>
				</div>
				<div class="col-md-12 mt-4">
					<a href="{{ route('admin.item.index') }}" class="btn btn-danger btn-sm">Cancel</a>
					<button type="submit" class="btn btn-success btn-sm float-right">Update</button>
				</div>
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
			<img src="{{ asset('uploads/item/'.$item->image_url) }}" alt="img not found" class="img-fluid">
		</div>
	</div>
</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/item/item.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection