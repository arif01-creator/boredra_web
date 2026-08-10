@props(['variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
    $base = 'inline-flex items-center justify-center gap-1.5 rounded px-4 py-2 text-sm font-medium tracking-wide transition disabled:cursor-not-allowed disabled:opacity-50';
    $variants = [
        'primary' => 'bg-forest-deep text-ivory hover:bg-forest',
        'gold' => 'bg-gold text-forest-deep hover:bg-gold/90',
        'secondary' => 'border border-stone bg-white text-charcoal hover:bg-ivory',
        'danger' => 'bg-red-700 text-white hover:bg-red-800',
        'ghost' => 'text-moss hover:text-forest-deep',
    ];
    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
