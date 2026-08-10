<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoRequest;
use App\Models\Page;
use App\Models\Product;
use App\Support\TranslatableInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SeoController extends Controller
{
    public function index(): View
    {
        return view('admin.seo.index', [
            'pages' => Page::orderByRaw("json_extract(title, '$.en') asc")->get(),
            'products' => Product::orderByRaw("json_extract(name, '$.en') asc")->get(),
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

        $data = TranslatableInput::pruneEmptyLocales(
            $request->validated(),
            ['title', 'meta_description', 'og_title', 'og_description'],
        );

        $model->seo()->updateOrCreate([], $data);

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
