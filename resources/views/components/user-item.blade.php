<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone ?? '-' }}</td>
    <td>{{ strtoupper($user->role) }}</td>
    <td>
        <a class="btn btn-sm btn-sm-square btn-warning m-2" href="{{ route('user.edit', $user->id) }}">
            <i class="fa fa-user-edit"></i>
        </a>
        <a class="btn btn-sm btn-sm-square btn-danger m-2" href=""
            onclick="event.preventDefault(); if (confirm('Are you sure?')) document.getElementById('delete-form-{{ $user->id }}').submit();">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>
<form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-none" id="delete-form-{{ $user->id }}">
    @csrf
    @method('DELETE')
</form>
