<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(): View
    {
        return view('admin.media.index');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.media.index');
    }

    public function update(Request $request, Media $medium): RedirectResponse
    {
        return redirect()->route('admin.media.index');
    }

    public function destroy(Media $medium): RedirectResponse
    {
        return redirect()->route('admin.media.index');
    }
}
