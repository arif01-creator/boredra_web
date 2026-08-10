@props(['action', 'label' => 'Delete', 'confirmText' => 'Delete this item? This cannot be undone.'])

<form method="POST" action="{{ $action }}" x-data="{ open: false }" @submit="open ? true : $event.preventDefault()">
    @csrf
    @method('DELETE')

    <button type="button" @click="open = true" class="text-xs font-medium tracking-wide text-red-700 uppercase hover:text-red-900">
        {{ $label }}
    </button>

    <div x-show="open" x-cloak style="display: none" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.outside="open = false" class="w-full max-w-sm rounded bg-white p-6 shadow-xl">
            <p class="mb-5 text-sm text-charcoal">{{ $confirmText }}</p>
            <div class="flex justify-end gap-2">
                <button type="button" @click="open = false" class="rounded border border-stone px-3 py-1.5 text-xs tracking-wide text-charcoal uppercase hover:bg-ivory">Cancel</button>
                <button type="submit" @click="open = true" class="rounded bg-red-700 px-3 py-1.5 text-xs tracking-wide text-white uppercase hover:bg-red-800">Delete</button>
            </div>
        </div>
    </div>
</form>
