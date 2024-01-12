<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::when($request->cat, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })->paginate(10);

        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->orderBy('name', 'asc')->get();

        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = SlugService::createSlug(Product::class, 'slug', $data['name']);
        $data['is_in_stock'] = $request->stock > 0 ? true : false;

        if ($request->image) {
            $filename = \Illuminate\Support\Str::uuid() . '.' . $request->image->extension();
            $imagePath = 'uploads/products/' . $filename;

            Storage::disk('s3')->put($imagePath, file_get_contents($data['image']));

            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->orderBy('name', 'asc')->get();

        return view('pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = SlugService::createSlug(Product::class, 'slug', $data['name']);
        $data['is_in_stock'] = $request->stock > 0 ? true : false;

        if ($request->image && $request->image->getClientOriginalName() != $product->image) {
            $filename = \Illuminate\Support\Str::uuid() . '.' . $request->image->extension();
            $imagePath = 'uploads/products/' . $filename;

            Storage::disk('s3')->put($imagePath, file_get_contents($data['image']));

            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
