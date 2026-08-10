@props(['title', 'description' => null, 'actionLabel' => null, 'actionHref' => null])

<div class="flex flex-col items-center justify-center rounded border border-dashed border-stone bg-white px-6 py-16 text-center">
    <p class="font-serif text-lg text-charcoal">{{ $title }}</p>
    @if ($description)
        <p class="mt-1 max-w-sm text-sm text-moss">{{ $description }}</p>
    @endif
    @if ($actionLabel && $actionHref)
        <x-admin.button :href="$actionHref" variant="primary" class="mt-5">{{ $actionLabel }}</x-admin.button>
    @endif
</div>
