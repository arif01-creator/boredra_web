<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>@yield('title', 'Admin') — Borendra International</title>
        @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    </head>
    <body class="bg-stone">
        <div class="flex min-h-screen">
            <x-admin.sidebar />

            <div class="flex min-w-0 flex-1 flex-col">
                <x-admin.topbar :title="trim($__env->yieldContent('title', 'Admin'))" />

                <main class="flex-1 px-6 py-8 lg:px-10">
                    @yield('content')
                </main>
            </div>
        </div>

        <x-admin.toast />
    </body>
</html>
