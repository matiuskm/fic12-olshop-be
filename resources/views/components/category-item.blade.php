<tr>
    <td><img src="{{ $category->getImage() }}" alt="{{ $category->name }}" style="width: 80px; height: 80px;"
            class="img rounded">
    </td>
    <td>{{ $category->name }}</td>
    <td><a class="btn btn-sm btn-sm-square btn-success m-2"
            href="{{ route('product.index', ['cat' => $category->id]) }}"><i class="fa fa-list"></i></a>
        <a class="btn btn-sm btn-sm-square btn-warning m-2" href="{{ route('category.edit', $category->id) }}"><i
                class="fa fa-edit"></i></a>
        <a class="btn btn-sm btn-sm-square btn-danger m-2" href=""
            onclick="event.preventDefault(); if (confirm('Are you sure?')) document.getElementById('delete-form-{{ $category->id }}').submit();"><i
                class="fa fa-times"></i></a>
    </td>
</tr>
<form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-none"
    id="delete-form-{{ $category->id }}">
    @csrf
    @method('DELETE')
</form>
