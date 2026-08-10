@props(['status'])

@php
    $colors = [
        'published' => 'bg-forest/10 text-forest',
        'draft' => 'bg-gold/15 text-gold',
        'archived' => 'bg-stone text-moss',
        'new' => 'bg-forest/10 text-forest',
        'contacted' => 'bg-gold/15 text-gold',
        'in_progress' => 'bg-blue-100 text-blue-800',
        'completed' => 'bg-forest/10 text-forest',
    ];
    $classes = $colors[$status] ?? 'bg-stone text-moss';
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium tracking-wide uppercase {{ $classes }}">
    {{ str_replace('_', ' ', $status) }}
</span>
