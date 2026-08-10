<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        <title>{{ $title ?? 'Error' }} — Borendra International</title>
        @vite(['resources/css/app.css'])
    </head>
    <body class="flex min-h-screen flex-col items-center justify-center bg-forest-deep px-6 text-center font-sans">
        <p class="label-micro text-gold">{{ $code ?? '' }}</p>
        <h1 class="mt-6 max-w-xl text-[clamp(2.25rem,5vw,4rem)] leading-[1.05] font-serif text-ivory whitespace-pre-line">{{ $heading }}</h1>
        <p class="mt-5 max-w-md text-sm leading-relaxed text-sage-soft">{{ $message }}</p>
        <a href="/" class="mt-10 inline-flex items-center gap-2 rounded-full bg-ivory px-7 py-3.5 text-xs font-medium tracking-[0.15em] text-forest-deep uppercase transition hover:bg-white">
            Return Home →
        </a>
    </body>
</html>
