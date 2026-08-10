@props(['title'])

<header class="flex items-center justify-between border-b border-stone bg-white px-6 py-4 lg:px-10">
    <div>
        <h1 class="font-serif text-xl text-charcoal">{{ $title }}</h1>
    </div>
    <div class="flex items-center gap-3 text-sm text-moss">
        <a href="{{ route('home', ['locale' => 'en']) }}" target="_blank" class="hidden text-xs tracking-wide uppercase hover:text-forest-deep sm:inline">View site ↗</a>
        <span class="hidden sm:inline">{{ auth()->user()?->name }}</span>
    </div>
</header>
