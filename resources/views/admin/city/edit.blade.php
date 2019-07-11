<form>
	<div class="form-group">
		<label>Country: </label>
		<select name="country" id="country" class="form-control" placeholder="Select any option">
			@foreach($countries as $country)
			<option value="{{ $country->id }}" {{ ($city->country_id == $country->id) ? 'selected' : '' }}>{{ ucfirst($country->name) }}</option>
			@endforeach
		</select> 
	</div>
	<div class="form-group">
		<label for="name">Name: </label> 
		<input type="text" id="name" name="name" class="form-control"
		required="true" value="{{ ucfirst($city->name) }}" data-id="{{$city->id}}">
	</div>
	<div class="form-group text-right">
		<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button>
		<button type="button" class="btn btn-success btn-sm" id="btn_update">Update <i class="fa fa-check"></i></button>
	</div>
</form>

