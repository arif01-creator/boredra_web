<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoRequest;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SeoController extends Controller
{
    public function index(): View
    {
        return view('admin.seo.index', [
            'pages' => Page::orderBy('title')->get(),
            'products' => Product::orderBy('name')->get(),
        ]);
    }

    public function edit(string $type, int $id): View
    {
        $model = $this->resolve($type, $id);

        return view('admin.seo.edit', [
            'type' => $type,
            'model' => $model,
            'seo' => $model->seo,
        ]);
    }

    public function update(SeoRequest $request, string $type, int $id): RedirectResponse
    {
        $model = $this->resolve($type, $id);

        $model->seo()->updateOrCreate([], $request->validated());

        return redirect()->route('admin.seo.index')->with('toast', ['type' => 'success', 'message' => 'SEO updated.']);
    }

    private function resolve(string $type, int $id): Page|Product
    {
        return match ($type) {
            'page' => Page::findOrFail($id),
            'product' => Product::findOrFail($id),
            default => abort(404),
        };
    }
}
