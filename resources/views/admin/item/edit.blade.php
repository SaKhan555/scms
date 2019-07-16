		<table class="table table-bordered">
					<form enctype="multipart/form-data">
				<tr>
					<th>Item Category: </th>
					<td>
											<select name="item_category" class="form-control">
						@foreach($item_categories as $item_category)
						@if($item_category->id == $item->item_category_id)
						<option value="{{ $item_category->id }}" selected="true"> {{ $item_category->name }}</option>
						@else
						<option value="{{ $item_category->id }}"> {{ $item_category->name }}</option>											
						@endif
						@endforeach		
					</select>
					</td>	
					<th>Item: </th>
					<td>
						<input type="text" class="form-control" name="name" value="{{ $item->name }}">
					</td>
				</tr>
				<tr>
					<th>Item Details: </th>
					<td colspan="3">
						<textarea name="details" class="form-control">{{ $item->details }}</textarea>
					</td>	
				</tr>
				<tr>
					<th>Image: </th>
					<td colspan="3">
											<input type="file" name="image" placeholder="Upload item image">
					<button type="button" data-toggle="modal" data-target = "#e_img_modal" title="View image" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-eye"></i>
					</button>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="text-right">
					<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button> 
					<button type="submit" class="btn btn-success btn-sm">Update</button>
					</td>
				</tr>
			</form>
		</table>
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
