<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaUpdateRequest;
use App\Http\Requests\Admin\MediaUploadRequest;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MediaController extends Controller
{
    public function index(): View
    {
        return view('admin.media.index', [
            'items' => Media::latest()->paginate(24),
        ]);
    }

    public function store(MediaUploadRequest $request, MediaService $mediaService): RedirectResponse
    {
        $mediaService->upload($request->file('file'), $request->input('alt_text'), $request->input('caption'));

        return redirect()->route('admin.media.index')->with('toast', ['type' => 'success', 'message' => 'File uploaded.']);
    }

    public function update(MediaUpdateRequest $request, Media $medium): RedirectResponse
    {
        $medium->update($request->validated());

        return redirect()->route('admin.media.index')->with('toast', ['type' => 'success', 'message' => 'Media updated.']);
    }

    public function destroy(Media $medium, MediaService $mediaService): RedirectResponse
    {
        $mediaService->delete($medium);

        return redirect()->route('admin.media.index')->with('toast', ['type' => 'success', 'message' => 'File deleted.']);
    }
}
