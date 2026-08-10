<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>@yield('title', 'Admin') — Borendra International</title>
        @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    </head>
    <body class="flex min-h-screen items-center justify-center bg-forest-deep px-6 py-12">
        <div class="w-full max-w-sm">
            <div class="mb-10 text-center">
                <p class="text-sm font-medium tracking-[0.3em] text-gold uppercase">Borendra International</p>
                <p class="mt-1 text-xs tracking-[0.2em] text-sage-soft uppercase">Admin</p>
            </div>

            <div class="rounded border border-pine bg-forest p-8 shadow-xl">
                @yield('content')
            </div>
        </div>
    </body>
</html>
