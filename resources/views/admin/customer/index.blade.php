@extends('template.master')
@section('title', 'Customer')
@section('content')
	<div class="card">
		<div class="card-header">
			<h5 class="float-left">Customers</h5>
			<a href="{{ route('admin.customer.create') }}" class="btn btn-primary btn-sm float-right" title="Add new 
			Customer">
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
							 $sr = $customers->perPage() * ($customers->currentPage() - 1) + 1
							 @endphp
						@foreach($customers as $customer)
							<tr>
								<td> {{ $sr++ }}</td>
								<td><a href="{{ route('admin.customer.show',[$customer->id]) }}" title="View Details">{{ ucfirst($customer->name) }} </a></td>
								<td>{{ $customer->customer_code_number }}</td>
								<td>{{ $customer->email }}</td>
								<td>{{ $customer->contact_number_primary }}</td>
								<td class="text-center">
									<div class="btn-group" role="group">
									<a href="{{ route('admin.customer.show',[$customer->id]) }}" class="btn btn-sm btn-secondary ">
										<i class="fa fa-eye"></i>
									</a>								
										<a href="{{ route('admin.customer.edit',[$customer->id]) }}" class="btn btn-primary btn-sm">
										<i class="fa fa-edit"></i>
									</a>
																	</div>
									<form action="{{ route('admin.customer.destroy',[$customer->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
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
						{!! $customers->render() !!}
					</div>								
				</div>
			</div>
		</div>
	@endsection

	@section('script')

<script src="{{ asset('js/customer/customer.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@endsection
