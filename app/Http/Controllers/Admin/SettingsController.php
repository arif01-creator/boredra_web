<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        return redirect()->route('admin.settings.edit');
    }
}
