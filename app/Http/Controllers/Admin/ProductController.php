<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\MediaService;
use App\Support\TranslatableInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private const TRANSLATABLE = ['name', 'short_description', 'long_description', 'specifications', 'applications'];

    public function index(): View
    {
        $products = Product::with('category')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.products.index', ['products' => $products]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => ProductCategory::orderByRaw("json_extract(name, '$.en') asc")->get(),
        ]);
    }

    public function store(ProductRequest $request, MediaService $mediaService): RedirectResponse
    {
        $data = TranslatableInput::pruneEmptyLocales($request->safe()->except('featured_image'), self::TRANSLATABLE);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $mediaService->storeAndUrl($request->file('featured_image'), 'products');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('toast', [
            'type' => 'success',
            'message' => 'Product created.',
        ]);
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => ProductCategory::orderByRaw("json_extract(name, '$.en') asc")->get(),
        ]);
    }

    public function update(ProductRequest $request, Product $product, MediaService $mediaService): RedirectResponse
    {
        $data = TranslatableInput::pruneEmptyLocales($request->safe()->except('featured_image'), self::TRANSLATABLE);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $mediaService->storeAndUrl($request->file('featured_image'), 'products');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('toast', [
            'type' => 'success',
            'message' => 'Product updated.',
        ]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('toast', [
            'type' => 'success',
            'message' => 'Product deleted.',
        ]);
    }
}
