		<table class="table table-bordered">
					<form enctype="multipart/form-data">
					@method('PUT')
				<tr>
					<th>Item Category: </th>
					<td>
					<select name="item_category" id="e_item_category" class="form-control">
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
						<input type="text" class="form-control" id="e_name" name="name" value="{{ $item->name }}">
					</td>
				</tr>
				<tr>
					<th>Item Details: </th>
					<td colspan="3">
						<textarea name="details" id="e_details" class="form-control">{{ $item->details }}</textarea>
					</td>	
				</tr>
				<tr>
					<th>Image: </th>
					<td colspan="3">
					<input type="file" id="e_image" name="image" placeholder="Upload item image">
					@if(!is_null($item->image_url))
					<button type="button" data-toggle="modal" data-target = "#e_img_modal" title="View image" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-eye"></i>
					</button>
					@else
						<code>Image not found</code> <i class="fa fa-times" style="font-size:1rem;color:red"></i>
					@endif
					</td>
				</tr>
				<tr>
					<td colspan="4" class="text-right">
					<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button> 
					<button type="submit" class="btn btn-success btn-sm" id="btn_update" data-id="{{ $item->id }}">Update</button>
					</td>
				</tr>
			</form>
		</table>
<!-- Modal -->
<div class="modal fade" id="e_img_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				@if(!is_null($item->image_url))
					<img src="{{ asset('uploads/item/'.$item->image_url) }}" alt="{{ $item->name }}" class="img-fluid">
				@else
					<img src="{{ asset('images/img_not_found.png') }}" alt="" style="margin: 15px 100px;">
				@endif
			</div>
		</div>
	</div>
</div>
