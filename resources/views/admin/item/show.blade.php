@extends('template.master')
@section('title', 'Item')
<style type="text/css" media="screen">
.card-body span {
	border-bottom: 1px solid grey;
}	
</style>
@section('content')
<div class="card">
	<div class="card-header">
		<h6 class="float-left">Item {{ ucfirst($item->name) }} Details</h6>
		<div class="float-right">
			<div class="dropdown">
  <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    File
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{ route('admin.item.edit',[$item->id]) }}" title="Edit {{$item->name}}"><i class="fa fa-edit"></i> Edit</a>
    <a class="dropdown-item" href="" title="Generate Details PDF"><i class="fa fa-file"></i> Generate PDF</a>
    <a class="dropdown-item" href="{{ route('admin.item.index') }}" title="Close"><i class="fa fa-times"></i> Exit</a>
  </div>
</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-8">
				<table class="table table-striped table-bordered">
						<tr>
							<th>Code Number</th><td>{{ $item->item_code_number }}</td>
						</tr>
						<tr>
							<th>Name</th><td>{{ ucfirst($item->name) }}</td>
						</tr>	
						<tr>
							<th>Item Category</th><td>{{ ucfirst($item->item_category->name) }}</td>
						</tr>
							<tr>
							<th>Details</th><td>{{ ucfirst($item->details) }}</td>
						</tr>
				</table>
			</div>   
			<div class="col-md-4">
				<img class="img-thumbnail" src="{{asset('uploads/item/'.$item->image_url)}}" alt="{{ $item->name }}">
			</div>    	  	
		</div>
		<div class="float-right mt-5">
			<table>
				<tr>
					<th>Created By</th>
					<td>Admin</td>
				</tr>	    
				<tr>
					<th>Created On</th>
					<td>{{ $item->created_at->toDayDateTimeString() }}</td>
				</tr>		
			</table>	
		</div>
	</div>
</div>
	<a href="{{ route('admin.item.index') }}" class="btn btn-danger btn-sm mt-5" title="Go Back">Back</a>
@endsection