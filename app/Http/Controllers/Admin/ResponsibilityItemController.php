<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResponsibilityItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResponsibilityItemController extends Controller
{
    public function index(): View
    {
        return view('admin.responsibility.index');
    }

    public function create(): View
    {
        return view('admin.responsibility.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.responsibility.index');
    }

    public function edit(ResponsibilityItem $responsibility): View
    {
        return view('admin.responsibility.edit', ['item' => $responsibility]);
    }

    public function update(Request $request, ResponsibilityItem $responsibility): RedirectResponse
    {
        return redirect()->route('admin.responsibility.index');
    }

    public function destroy(ResponsibilityItem $responsibility): RedirectResponse
    {
        return redirect()->route('admin.responsibility.index');
    }
}
