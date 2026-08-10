@props(['type' => 'error'])

@php
    $styles = [
        'error' => 'border-red-200 bg-red-50 text-red-800',
        'success' => 'border-forest/20 bg-forest/5 text-forest',
        'info' => 'border-stone bg-ivory text-charcoal',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'mb-5 rounded border px-4 py-3 text-sm ' . ($styles[$type] ?? $styles['info'])]) }}>
    {{ $slot }}
</div>
