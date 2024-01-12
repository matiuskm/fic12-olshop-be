<tr>
    <td><img src="{{ $product->getImage() }}" alt="{{ $product->name }}" style="width: 50px; height: 50px;"
            class="img rounded">
    </td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name }}</td>
    <td>@currency($product->price)</td>
    <td>{{ $product->stock }}</td>
    <td>{{ $product->is_in_stock ? 'IN STOCK' : 'OUT OF STOCK' }}</td>
    <td>
        <a class="btn btn-sm btn-sm-square btn-warning m-2" href="{{ route('product.edit', $product->id) }}"><i
                class="fa fa-edit"></i>
        </a>
        <a class="btn btn-sm btn-sm-square btn-danger m-2" href=""
            onclick="event.preventDefault(); if (confirm('Are you sure?')) document.getElementById('delete-form-{{ $product->id }}').submit();"><i
                class="fa fa-times"></i>
        </a>
    </td>
</tr>
<form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-none"
    id="delete-form-{{ $product->id }}">
    @csrf
    @method('DELETE')
</form>
