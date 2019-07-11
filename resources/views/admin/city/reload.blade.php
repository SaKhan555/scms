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
        <button type="button" class="btn btn-primary btn-sm btn_edit" data-id="{{$city->id}}">Edit <i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm btn_delete" data-id="{{$city->id}}">
         Delete <i class="fa fa-trash"></i>
         </button>
    </td>
</tr>
@endforeach
