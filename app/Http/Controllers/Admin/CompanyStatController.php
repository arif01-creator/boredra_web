<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyStatRequest;
use App\Models\CompanyStat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyStatController extends Controller
{
    public function index(): View
    {
        return view('admin.company-stats.index', [
            'stats' => CompanyStat::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.company-stats.create');
    }

    public function store(CompanyStatRequest $request): RedirectResponse
    {
        CompanyStat::create($request->validated());

        return redirect()->route('admin.company-stats.index')->with('toast', ['type' => 'success', 'message' => 'Stat added.']);
    }

    public function edit(CompanyStat $companyStat): View
    {
        return view('admin.company-stats.edit', ['stat' => $companyStat]);
    }

    public function update(CompanyStatRequest $request, CompanyStat $companyStat): RedirectResponse
    {
        $companyStat->update($request->validated());

        return redirect()->route('admin.company-stats.index')->with('toast', ['type' => 'success', 'message' => 'Stat updated.']);
    }

    public function destroy(CompanyStat $companyStat): RedirectResponse
    {
        $companyStat->delete();

        return redirect()->route('admin.company-stats.index')->with('toast', ['type' => 'success', 'message' => 'Stat removed.']);
    }
}
