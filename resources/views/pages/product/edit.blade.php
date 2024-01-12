<x-app-layout>
    <div class="container-fluid pt-4 px-4">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></div>
            <div class="breadcrumb-item">Edit Product</div>
        </div>
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">New Product</h6>
            {{-- multipart --}}
            <form method="POST" action="{{ route('product.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col xl-8 sm-12">
                        <div class=" mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid
                            @enderror"
                                name="name" value="{{ $product->name }}" id="name" placeholder="john doe">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label for="floatingTextarea" class="form-label">Description</label>
                            <textarea class="form-control" placeholder="Product Description" id="floatingTextarea" style="height: 150px;"
                                name="description">{{ $product->description }}</textarea>
                        </div>
                        <div class=" mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number"
                                class="form-control @error('price') is-invalid
                            @enderror"
                                name="price" value="{{ $product->price }}" id="price" placeholder="0">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number"
                                class="form-control @error('stock') is-invalid
                            @enderror"
                                name="stock" value="{{ $product->stock }}" id="stock" placeholder="0">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col xl-4 sm-12">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Product Image</label>
                            <input
                                class="form-control bg-dark @error('image') is-invalid
                            @enderror"
                                type="file" id="formFile" name="image" value="{{ $product->image }}">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" name="category_id"
                                class="form-select form-select-sm mb-3 @error('category_id') is-invalid @enderror"
                                aria-label=".form-select-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($product->category->is($category)) selected @endif>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
