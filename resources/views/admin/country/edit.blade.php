					<form>
						<div class="form-group">
							    <label>Name: </label>
							  <input type="text" class="form-control" name="name" id="edit_name" value="{{ ucfirst($country->name) }}" data-id= "{{ $country->id }}">
						</div>
						<div class="text-right">
							  <button type="button" class="btn btn-sm btn-danger mt-3" data-dismiss="modal">Cancer</button>
								<button type="button" class="btn btn-sm btn-primary mt-3" id="btn_update">Update</button>
						</div>
					</form>
				</div>
