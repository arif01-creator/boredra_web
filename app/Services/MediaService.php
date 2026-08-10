<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function upload(UploadedFile $file, ?string $altText = null, ?string $caption = null): Media
    {
        $path = $file->store('media', 'public');

        return Media::create([
            'disk' => 'public',
            'path' => $path,
            'filename' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType() ?? $file->getClientMimeType(),
            'size' => $file->getSize() ?? 0,
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
