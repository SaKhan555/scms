@extends('template.master')
@section('title', 'Vendor')
@section('content')
	<div class="card">
		<div class="card-header">Vendors
			<a href="{{ route('admin.vendor.create') }}" class="btn btn-primary btn-sm float-right" title="Add new Vendor">
				<i class="fa fa-plus"></i></a>
			</div>
			<div class="card-body">
				<div class="col-md-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Sr#</th>
								<th>Name</th>
								<th>Code Number</th>
								<th>Email</th>
								<th>Contact Number</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@php
							 $sr = $vendors->perPage() * ($vendors->currentPage() - 1) + 1
							 @endphp
						@foreach($vendors as $vendor)
							<tr>
								<td>{{ $sr++ }}</td>
								<td>
									<a href="{{ route('admin.vendor.show',[$vendor->id]) }}" title="">
									{{ ucfirst($vendor->name) }}
								</a>
								</td>
								<td>{{ $vendor->vendor_code_number }}</td>
								<td>{{ $vendor->email }}</td>
								<td>{{ $vendor->contact_number_primary }}</td>
								<td class="text-center">
									<div class="btn-group" role="group">
									<a href="{{ route('admin.vendor.show',[$vendor->id]) }}" class="btn btn-sm btn-secondary ">
										<i class="fa fa-eye"></i>
									</a>								
										<a href="{{ route('admin.vendor.edit',[$vendor->id]) }}" class="btn btn-primary btn-sm">
										<i class="fa fa-edit"></i>
									</a>
																	</div>
									<form action="{{ route('admin.vendor.destroy',[$vendor->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
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
						{!! $vendors->render() !!}
					</div>								
				</div>
			</div>
		</div>
	@endsection

	@section('script')

<script src="{{ asset('js/vendor/vendor.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@endsection