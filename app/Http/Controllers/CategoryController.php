<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->paginate(10);

        return view('pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $data['name']);

        if ($request->image) {
            $filename = \Illuminate\Support\Str::uuid() . '.' . $request->image->extension();
            $imagePath = 'uploads/' . $filename;

            Storage::disk('s3')->put($imagePath, file_get_contents($data['image']));

            $data['image'] = $filename;
        }

        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $data['name']);

        if ($request->image && $request->image->getClientOriginalName() != $category->image) {
            $filename = \Illuminate\Support\Str::uuid() . '.' . $request->image->extension();
            $imagePath = 'uploads/' . $filename;

            Storage::disk('s3')->put($imagePath, file_get_contents($data['image']));

            $data['image'] = $filename;
        }

        $category->update($data);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
