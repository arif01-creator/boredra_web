@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Media Library']]" />

    <div class="mb-8 rounded border border-stone bg-white p-6">
        <p class="mb-4 text-sm font-medium text-charcoal">Upload a file</p>
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
            @csrf
            <input type="file" name="file" required accept=".jpg,.jpeg,.png,.webp,.avif,.pdf"
                class="col-span-2 block w-full text-sm text-charcoal file:mr-3 file:rounded file:border-0 file:bg-forest-deep file:px-3 file:py-1.5 file:text-xs file:tracking-wide file:text-ivory file:uppercase">
            <input type="text" name="alt_text" placeholder="Alt text" class="rounded border border-stone px-3 py-2 text-sm">
            <input type="text" name="caption" placeholder="Caption" class="rounded border border-stone px-3 py-2 text-sm">
            <x-admin.button type="submit" variant="primary" class="sm:col-span-4 sm:w-fit">Upload</x-admin.button>
        </form>
        @error('file')
            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    @if ($items->isEmpty())
        <x-admin.empty-state title="No media uploaded yet" description="Uploaded files can be used as featured images and galleries throughout the site." />
    @else
        <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($items as $item)
                <div class="overflow-hidden rounded border border-stone bg-white" x-data="{ copied: false }">
                    <div class="flex aspect-square items-center justify-center bg-gradient-to-br from-forest-deep to-pine">
                        @if (str_starts_with($item->mime, 'image/'))
                            <img src="{{ $item->url() }}" alt="{{ $item->alt_text }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-xs tracking-wide text-sage-soft uppercase">{{ $item->mime }}</span>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.media.update', $item) }}" class="space-y-2 p-3">
                        @csrf
                        @method('PUT')
                        <input type="text" name="alt_text" value="{{ $item->alt_text }}" placeholder="Alt text"
                            class="w-full rounded border border-stone px-2 py-1 text-xs">
                        <div class="flex items-center justify-between gap-2">
                            <button type="submit" class="text-[10px] font-medium tracking-wide text-forest-deep uppercase hover:underline">Save</button>
                            <button type="button" @click="navigator.clipboard.writeText('{{ $item->url() }}'); copied = true; setTimeout(() => copied = false, 1500)"
                                class="text-[10px] font-medium tracking-wide text-moss uppercase hover:underline">
                                <span x-show="!copied">Copy URL</span>
                                <span x-show="copied" x-cloak>Copied</span>
                            </button>
                        </div>
                    </form>
                    <div class="border-t border-stone px-3 py-2">
                        <x-admin.delete-button :action="route('admin.media.destroy', $item)" confirm-text="Delete this file? This cannot be undone." />
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $items->links() }}</div>
    @endif
@endsection
