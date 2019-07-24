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
    <td>
        <a href="{{ route('admin.item.show',[$item->id]) }}" class="btn btn-info btn-sm">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{ route('admin.item.edit',[$item->id]) }}" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>

        <form action="{{ route('admin.item.destroy',[$item->id]) }}" method="POST" accept-charset="utf-8" style="display: inline-block !important;">
            @method('Delete')
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>

@endforeach
