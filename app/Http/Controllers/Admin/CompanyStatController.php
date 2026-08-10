<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyStat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyStatController extends Controller
{
    public function index(): View
    {
        return view('admin.company-stats.index');
    }

    public function create(): View
    {
        return view('admin.company-stats.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.company-stats.index');
    }

    public function edit(CompanyStat $companyStat): View
    {
        return view('admin.company-stats.edit', ['stat' => $companyStat]);
    }

    public function update(Request $request, CompanyStat $companyStat): RedirectResponse
    {
        return redirect()->route('admin.company-stats.index');
    }

    public function destroy(CompanyStat $companyStat): RedirectResponse
    {
        return redirect()->route('admin.company-stats.index');
    }
}
