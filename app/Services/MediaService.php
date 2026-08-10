<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    /**
     * Store an uploaded file on the public disk and return its public URL.
     */
    public function storeAndUrl(UploadedFile $file, string $directory): string
    {
        $path = $file->store($directory, 'public');

        abort_if($path === false, 500, 'Failed to store the uploaded file.');

        return Storage::disk('public')->url($path);
    }

    public function upload(UploadedFile $file, ?string $altText = null, ?string $caption = null): Media
    {
        $path = $file->store('media', 'public');

        abort_if($path === false, 500, 'Failed to store the uploaded file.');

        return Media::create([
            'disk' => 'public',
            'path' => $path,
            'filename' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType() ?? $file->getClientMimeType(),
            'size' => $file->getSize(),
            'alt_text' => $altText,
            'caption' => $caption,
            'uploaded_by' => Auth::id(),
        ]);
    }

    public function delete(Media $media): void
    {
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();
    }
}
