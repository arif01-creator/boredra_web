<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index');
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.categories.index');
    }

    public function edit(ProductCategory $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, ProductCategory $category): RedirectResponse
    {
        return redirect()->route('admin.categories.index');
    }

    public function destroy(ProductCategory $category): RedirectResponse
    {
        return redirect()->route('admin.categories.index');
    }
}
