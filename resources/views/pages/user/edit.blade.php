<x-app-layout title="Users">
    <div class="container-fluid pt-4 px-4">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></div>
            <div class="breadcrumb-item">Edit User</div>
        </div>
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Edit User</h6>
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid
                    @enderror"
                        name="name" value="{{ $user->name }}" id="name" placeholder="john doe">
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="name@example.com" name="email" value="{{ $user->email }}">
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Phone" name="phone" value="{{ $user->phone }}">
                    <label for="phone">Phone</label>
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <label for="role">Role</label>
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
