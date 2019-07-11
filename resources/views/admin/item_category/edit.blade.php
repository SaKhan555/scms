@extends('template.master')
@section('title', 'Item Category')
@section('content')
<div class="card">
	<div class="card-header">Edit Item Category
	</div>
	<div class="card-body">
		<div class="col-md-12">
			<form action="{{ route('admin.item_category.update',[$item_category->id]) }}" method="POST">
				@method('PUT')
				{{ csrf_field() }}
				<div class="row">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Name: </span>
						</div>
						<input type="text" class="form-control" name="name" value="{{ $item_category->name }}">
						<div class="input-group-append">
							<button type="submit" class="btn btn-outline-success">Update</button>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
<div class="mt-5 mb-5">
	<a href="{{ route('admin.item_category.index') }}" class="btn btn-danger btn-sm">Cancel</a>
</div>

@endsection

@section('script')
<script src="{{ asset('js/item_category/item_category.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection