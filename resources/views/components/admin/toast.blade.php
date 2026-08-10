@if (session('toast'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition
        class="fixed right-6 bottom-6 z-50 max-w-sm rounded border px-4 py-3 text-sm shadow-lg {{ (session('toast')['type'] ?? 'success') === 'error' ? 'border-red-200 bg-red-50 text-red-800' : 'border-forest/20 bg-forest-deep text-ivory' }}"
    >
        {{ session('toast')['message'] ?? '' }}
    </div>
@endif
