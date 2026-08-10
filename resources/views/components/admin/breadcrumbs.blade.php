@props(['items' => []])

<nav class="mb-6 flex items-center gap-1.5 text-xs tracking-wide text-moss uppercase">
    @foreach ($items as $index => $item)
        @if (!$loop->last && ($item['href'] ?? null))
            <a href="{{ $item['href'] }}" class="hover:text-forest-deep">{{ $item['label'] }}</a>
            <span>/</span>
        @else
            <span class="text-charcoal">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
