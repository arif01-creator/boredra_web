<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(): View
    {
        return view('admin.seo.index');
    }

    public function edit(string $type, int $id): View
    {
        return view('admin.seo.edit', ['type' => $type, 'id' => $id]);
    }

    public function update(Request $request, string $type, int $id): RedirectResponse
    {
        return redirect()->route('admin.seo.index');
    }
}
