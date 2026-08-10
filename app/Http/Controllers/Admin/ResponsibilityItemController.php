<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResponsibilityItemRequest;
use App\Models\ResponsibilityItem;
use App\Support\TranslatableInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ResponsibilityItemController extends Controller
{
    private const TRANSLATABLE = ['title', 'description'];

    public function index(): View
    {
        return view('admin.responsibility.index', [
            'items' => ResponsibilityItem::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.responsibility.create');
    }

    public function store(ResponsibilityItemRequest $request): RedirectResponse
    {
        ResponsibilityItem::create(TranslatableInput::pruneEmptyLocales($request->validated(), self::TRANSLATABLE));

        return redirect()->route('admin.responsibility.index')->with('toast', ['type' => 'success', 'message' => 'Topic added.']);
    }

    public function edit(ResponsibilityItem $responsibility): View
    {
        return view('admin.responsibility.edit', ['item' => $responsibility]);
    }

    public function update(ResponsibilityItemRequest $request, ResponsibilityItem $responsibility): RedirectResponse
    {
        $responsibility->update(TranslatableInput::pruneEmptyLocales($request->validated(), self::TRANSLATABLE));

        return redirect()->route('admin.responsibility.index')->with('toast', ['type' => 'success', 'message' => 'Topic updated.']);
    }

    public function destroy(ResponsibilityItem $responsibility): RedirectResponse
    {
        $responsibility->delete();

        return redirect()->route('admin.responsibility.index')->with('toast', ['type' => 'success', 'message' => 'Topic removed.']);
    }
}
