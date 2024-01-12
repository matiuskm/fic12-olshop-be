<x-app-layout title="Categories">
    <div class="container-fluid pt-4 px-4">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></div>
            <div class="breadcrumb-item">Edit Category</div>
        </div>
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">New Category</h6>
            {{-- multipart --}}
            <form method="POST" action="{{ route('category.update', $category) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid
                    @enderror"
                        name="name" value="{{ $category->name }}" id="name" placeholder="john doe">
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"
                        name="description">{{ $category->description }}</textarea>
                    <label for="floatingTextarea">Description</label>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Category Image</label>
                    <input class="form-control bg-dark @error('image') is-invalid
                    @enderror"
                        type="file" id="formFile" name="image" value="{{ $category->image }}">
                    @error('image')
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
