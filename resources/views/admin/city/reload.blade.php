@php
$sr = $cities->perPage() * ($cities->currentPage() - 1) + 1
@endphp
@foreach($cities as $city)
<tr>
    <td>{{ $sr++ }}</td>
    <td>{{ ucfirst($city->name).' - '.ucfirst($city->country->name) }}</td>
    <td>{{ $city->user_id }}</td>
    <td>{{ $city->created_at->toDayDateTimeString() }}</td>
                            <td class="text-center">
                            <a href="{{ route('admin.city.edit',[$city->id]) }}" class="btn btn-primary btn-sm" title="Edit City">Edit <i class="fa fa-edit"></i></a>
                            
                            <form action="{{ route('admin.city.destroy',[$city->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
                                @method('Delete')
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            </td>
</tr>
@endforeach
