<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QualityProcessRequest;
use App\Models\QualityProcess;
use App\Services\MediaService;
use App\Support\TranslatableInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class QualityProcessController extends Controller
{
    private const TRANSLATABLE = ['title', 'description'];

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

    public function store(QualityProcessRequest $request, MediaService $mediaService): RedirectResponse
    {
        $data = TranslatableInput::pruneEmptyLocales($request->safe()->except('image'), self::TRANSLATABLE);

        if ($request->hasFile('image')) {
            $data['image'] = $mediaService->storeAndUrl($request->file('image'), 'quality');
        }

        QualityProcess::create($data);

        return redirect()->route('admin.quality.index')->with('toast', ['type' => 'success', 'message' => 'Stage created.']);
    }

    public function edit(QualityProcess $quality): View
    {
        return view('admin.quality.edit', ['stage' => $quality]);
    }

    public function update(QualityProcessRequest $request, QualityProcess $quality, MediaService $mediaService): RedirectResponse
    {
        $data = TranslatableInput::pruneEmptyLocales($request->safe()->except('image'), self::TRANSLATABLE);

        if ($request->hasFile('image')) {
            $data['image'] = $mediaService->storeAndUrl($request->file('image'), 'quality');
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
