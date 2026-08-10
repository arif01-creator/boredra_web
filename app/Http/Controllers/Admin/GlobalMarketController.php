<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalMarket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GlobalMarketController extends Controller
{
    public function index(): View
    {
        return view('admin.global-reach.index');
    }

    public function create(): View
    {
        return view('admin.global-reach.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.global-reach.index');
    }

    public function edit(GlobalMarket $globalReach): View
    {
        return view('admin.global-reach.edit', ['market' => $globalReach]);
    }

    public function update(Request $request, GlobalMarket $globalReach): RedirectResponse
    {
        return redirect()->route('admin.global-reach.index');
    }

    public function destroy(GlobalMarket $globalReach): RedirectResponse
    {
        return redirect()->route('admin.global-reach.index');
    }
}
