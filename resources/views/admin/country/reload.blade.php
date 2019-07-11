@php
$sr = $countries->perPage() * ($countries->currentPage() - 1) + 1
@endphp
@foreach($countries as $country)
<tr>
    <td>{{ $sr++ }}</td>
    <td>{{ ucfirst($country->name) }}</td>
    <td>{{ $country->user_id }}</td>
    <td>{{ $country->created_at->toDayDateTimeString() }}</td>
    <td class="text-center">
        <button type="button" class="btn btn-primary btn-sm btn_edit" data-id="{{$country->id}}">
            <i class="fa fa-edit"></i> Edit
        </button>
        <button type="button" class="btn btn-danger btn-sm btn_delete" data-id="{{$country->id}}">
            Delete <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>
@endforeach
