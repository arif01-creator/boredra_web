<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\MediaService;
use App\Support\TranslatableInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductCategoryController extends Controller
{
    private const TRANSLATABLE = ['name', 'description'];

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

    public function store(ProductCategoryRequest $request, MediaService $mediaService): RedirectResponse
    {
        $data = TranslatableInput::pruneEmptyLocales($request->safe()->except('image'), self::TRANSLATABLE);

        if ($request->hasFile('image')) {
            $data['image'] = $mediaService->storeAndUrl($request->file('image'), 'categories');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.categories.index')->with('toast', ['type' => 'success', 'message' => 'Category created.']);
    }

    public function edit(ProductCategory $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $category, MediaService $mediaService): RedirectResponse
    {
        $data = TranslatableInput::pruneEmptyLocales($request->safe()->except('image'), self::TRANSLATABLE);

        if ($request->hasFile('image')) {
            $data['image'] = $mediaService->storeAndUrl($request->file('image'), 'categories');
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
