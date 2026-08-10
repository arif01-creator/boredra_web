@php
    $seo = $page['props']['seo'] ?? [];
    $rawTitle = $seo['title'] ?? null;
    $title = $rawTitle ? "{$rawTitle} | ".config('app.name') : config('app.name');
    $description = $seo['description'] ?? 'Borendra International is a Bangladesh-based registered exporting company supplying human hair, dressed hair, animal hair and synthetic materials for the global wig and hair industry.';
    $canonical = $seo['canonical'] ?? url()->current();
    $ogImage = $seo['ogImage'] ?? null;
    $jsonLd = $seo['jsonLd'] ?? [];
    $robots = $seo['robots'] ?? 'index, follow';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="{{ $robots }}">
        <meta name="theme-color" content="#0B2118">

        <meta name="description" content="{{ $description }}">
        <link rel="canonical" href="{{ $canonical }}">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="{{ $seo['ogTitle'] ?? $rawTitle ?? $title }}">
        <meta property="og:description" content="{{ $seo['ogDescription'] ?? $description }}">
        <meta property="og:url" content="{{ $canonical }}">
        @if ($ogImage)
            <meta property="og:image" content="{{ $ogImage }}">
        @endif

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seo['ogTitle'] ?? $rawTitle ?? $title }}">
        <meta name="twitter:description" content="{{ $seo['ogDescription'] ?? $description }}">
        @if ($ogImage)
            <meta name="twitter:image" content="{{ $ogImage }}">
        @endif

        @foreach ($jsonLd as $schema)
            <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        @endforeach

        <style>
            html {
                background-color: #0B2118;
            }
        </style>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts

        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.tsx', "resources/js/pages/{$page['component']}.tsx"])
        <x-inertia::head>
            <title>{{ $title }}</title>
        </x-inertia::head>
    </head>
    <body class="font-sans antialiased">
        <x-inertia::app />
    </body>
</html>
