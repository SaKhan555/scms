@extends('template.master')
@section('title', 'Warehouse')
<style type="text/css" media="screen">
.card-body span {
	border-bottom: 1px solid grey;
}	
</style>
@section('content')
<div class="card">
	<div class="card-header">
		<h6 class="float-left">Warehouse {{ ucfirst($warehouse->name) }} Details</h6>
		<div class="float-right">
			<div class="dropdown">
  <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    File
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{ route('admin.warehouse.edit',[$warehouse->id]) }}" title="Edit {{$warehouse->name}}"><i class="fa fa-edit"></i> Edit</a>
    <a class="dropdown-item" href="" title="Generate Details PDF"><i class="fa fa-file"></i> Generate PDF</a>
    <a class="dropdown-item" href="{{ route('admin.warehouse.index') }}" title="Close"><i class="fa fa-times"></i> Exit</a>
  </div>
</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
				<table class="table table-striped table-bordered">
						<tr>
							<th>Code Number</th><td>{{ $warehouse->warehouse_code_number }}</td>
						</tr>
						<tr>
							<th>Name</th><td>{{ $warehouse->name }}</td>
						</tr>	
						<tr>
							<th>Warehouse Address</th><td>{{ $warehouse->address." ".$warehouse->city->name." ".$warehouse->country->name }}</td>
						</tr>
							<tr>
							<th>Details</th><td>{{ $warehouse->details }}</td>
						</tr>
				</table> 	  	
		</div>
		<div class="float-right mt-5">
			<table>
				<tr>
					<th>Created By</th>
					<td>Admin</td>
				</tr>	    
				<tr>
					<th>Created On</th>
					<td>{{ $warehouse->created_at->toDayDateTimeString() }}</td>
				</tr>		
			</table>	
		</div>
	</div>
</div>
	<a href="{{ route('admin.warehouse.index') }}" class="btn btn-danger btn-sm mt-5" title="Go Back">Back</a>
@endsection