@props(['name', 'label' => null, 'current' => null])

<div>
    @if ($label)
        <label class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">{{ $label }}</label>
    @endif

    <div class="flex items-center gap-4">
        <div class="flex h-20 w-32 shrink-0 items-center justify-center overflow-hidden rounded border border-stone bg-gradient-to-br from-forest-deep to-pine">
            @if ($current)
                <img src="{{ $current }}" alt="" class="h-full w-full object-cover">
            @else
                <span class="px-2 text-center text-[10px] tracking-wide text-sage-soft uppercase">No image</span>
            @endif
        </div>

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="file"
            accept="image/png,image/jpeg,image/webp,image/avif"
            class="block w-full text-sm text-charcoal file:mr-3 file:rounded file:border-0 file:bg-forest-deep file:px-3 file:py-1.5 file:text-xs file:tracking-wide file:text-ivory file:uppercase"
        >
    </div>

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
