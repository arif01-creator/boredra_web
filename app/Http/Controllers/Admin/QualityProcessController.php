<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QualityProcessRequest;
use App\Models\QualityProcess;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class QualityProcessController extends Controller
{
    public function index(): View
    {
        return view('admin.quality.index', [
            'stages' => QualityProcess::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.quality.create');
    }

    public function store(QualityProcessRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->url($request->file('image')->store('quality', 'public'));
        }

        QualityProcess::create($data);

        return redirect()->route('admin.quality.index')->with('toast', ['type' => 'success', 'message' => 'Stage created.']);
    }

    public function edit(QualityProcess $quality): View
    {
        return view('admin.quality.edit', ['stage' => $quality]);
    }

    public function update(QualityProcessRequest $request, QualityProcess $quality): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->url($request->file('image')->store('quality', 'public'));
        }

        $quality->update($data);

        return redirect()->route('admin.quality.index')->with('toast', ['type' => 'success', 'message' => 'Stage updated.']);
    }

    public function destroy(QualityProcess $quality): RedirectResponse
    {
        $quality->delete();

        return redirect()->route('admin.quality.index')->with('toast', ['type' => 'success', 'message' => 'Stage deleted.']);
    }
}
