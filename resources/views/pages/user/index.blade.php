<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePaginator */
?>
<x-app-layout>
    <div class="container-fluid pt-4 px-4">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">User List</div>
        </div>
        <div class="bg-secondary text-center rounded p-4">
            @if (session('success'))
                <x-alert :message="session('success')" />
            @endif
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">User List</h6>
                <button onclick="window.location='{{ route('user.create') }}'"
                    class="btn btn-outline-primary m-2 float-right">
                    <i class="fas fa-plus me-2"></i>Add New User
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle  table-hover mb-0">
                    <thead>
                        <tr class="text-white">

                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <x-user-item :user="$user" />
                        @endforeach
                    </tbody>
                </table>
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
