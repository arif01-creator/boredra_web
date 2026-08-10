<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GlobalMarketRequest;
use App\Models\GlobalMarket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GlobalMarketController extends Controller
{
    public function index(): View
    {
        return view('admin.global-reach.index', [
            'markets' => GlobalMarket::orderBy('display_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.global-reach.create');
    }

    public function store(GlobalMarketRequest $request): RedirectResponse
    {
        GlobalMarket::create($request->validated());

        return redirect()->route('admin.global-reach.index')->with('toast', ['type' => 'success', 'message' => 'Market added.']);
    }

    public function edit(GlobalMarket $globalReach): View
    {
        return view('admin.global-reach.edit', ['market' => $globalReach]);
    }

    public function update(GlobalMarketRequest $request, GlobalMarket $globalReach): RedirectResponse
    {
        $globalReach->update($request->validated());

        return redirect()->route('admin.global-reach.index')->with('toast', ['type' => 'success', 'message' => 'Market updated.']);
    }

    public function destroy(GlobalMarket $globalReach): RedirectResponse
    {
        $globalReach->delete();

        return redirect()->route('admin.global-reach.index')->with('toast', ['type' => 'success', 'message' => 'Market removed.']);
    }
}
