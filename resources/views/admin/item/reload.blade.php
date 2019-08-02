@php
    $sr = $items->perPage() * ($items->currentPage() - 1) + 1
@endphp

@foreach($items as $item)
    <tr>
        <td>{{ $sr++ }}</td>
        <td>{{ $item->item_code_number }}</td>
        <td>{{ ucfirst($item->name) }}</td>
        <td>
        {{ ucfirst($item->item_category->name) }}
        </td>
        <td class="text-center">
        <button class="btn btn-info btn-sm btn_view" data-id="{{ $item->id }}">
        View <i class="fa fa-eye"></i></button>
        <button type="button" data-id="{{ $item->id }}" class="btn btn-sm btn-primary btn_edit">Edit
        <i class="fa fa-edit"></i></button>
        <button type="button" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn_delete">
        Delete <i class="fa fa-trash"></i></button>
        </td>
    </tr>
@endforeach