<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => ProductCategory::withCount('products')->orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(ProductCategoryRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->url($request->file('image')->store('categories', 'public'));
        }

        ProductCategory::create($data);

        return redirect()->route('admin.categories.index')->with('toast', ['type' => 'success', 'message' => 'Category created.']);
    }

    public function edit(ProductCategory $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $category): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->url($request->file('image')->store('categories', 'public'));
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('toast', ['type' => 'success', 'message' => 'Category updated.']);
    }

    public function destroy(ProductCategory $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('toast', ['type' => 'success', 'message' => 'Category deleted.']);
    }
}
