<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QualityProcess;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QualityProcessController extends Controller
{
    public function index(): View
    {
        return view('admin.quality.index');
    }

    public function create(): View
    {
        return view('admin.quality.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.quality.index');
    }

    public function edit(QualityProcess $quality): View
    {
        return view('admin.quality.edit', ['stage' => $quality]);
    }

    public function update(Request $request, QualityProcess $quality): RedirectResponse
    {
        return redirect()->route('admin.quality.index');
    }

    public function destroy(QualityProcess $quality): RedirectResponse
    {
        return redirect()->route('admin.quality.index');
    }
}
