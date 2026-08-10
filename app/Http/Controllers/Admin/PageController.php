<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::orderByRaw("json_extract(title, '$.en') asc")->get(),
        ]);
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $sections = $request->input('sections', []);

        foreach ($sections as $locale => $fields) {
            $sections[$locale] = array_filter(
                (array) $fields,
                fn (mixed $value): bool => is_string($value) ? trim($value) !== '' : $value !== null,
            );
        }

        $sections = array_filter($sections);

        $page->setTranslations('sections', $sections);
        $page->save();

        return redirect()->route('admin.pages.index')->with('toast', ['type' => 'success', 'message' => 'Page updated.']);
    }
}
