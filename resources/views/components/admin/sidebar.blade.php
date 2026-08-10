@php
    $nav = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard'],
        ['label' => 'Products', 'route' => 'admin.products.index', 'active' => 'admin.products.*'],
        ['label' => 'Categories', 'route' => 'admin.categories.index', 'active' => 'admin.categories.*'],
        ['label' => 'Quality Process', 'route' => 'admin.quality.index', 'active' => 'admin.quality.*'],
        ['label' => 'Global Reach', 'route' => 'admin.global-reach.index', 'active' => 'admin.global-reach.*'],
        ['label' => 'Company Stats', 'route' => 'admin.company-stats.index', 'active' => 'admin.company-stats.*'],
        ['label' => 'Responsibility', 'route' => 'admin.responsibility.index', 'active' => 'admin.responsibility.*'],
        ['label' => 'Pages', 'route' => 'admin.pages.index', 'active' => 'admin.pages.*'],
        ['label' => 'Inquiries', 'route' => 'admin.inquiries.index', 'active' => 'admin.inquiries.*'],
        ['label' => 'Media Library', 'route' => 'admin.media.index', 'active' => 'admin.media.*'],
        ['label' => 'SEO', 'route' => 'admin.seo.index', 'active' => 'admin.seo.*'],
        ['label' => 'Settings', 'route' => 'admin.settings.edit', 'active' => 'admin.settings.*'],
    ];
@endphp

<aside class="hidden w-64 shrink-0 bg-forest-deep lg:flex lg:flex-col">
    <div class="px-6 py-7">
        <p class="text-sm font-medium tracking-[0.25em] text-gold uppercase">Borendra</p>
        <p class="text-[10px] tracking-[0.2em] text-sage-soft uppercase">International — Admin</p>
    </div>

    <nav class="flex-1 space-y-0.5 px-3">
        @foreach ($nav as $item)
            <a href="{{ route($item['route']) }}"
               class="block rounded px-3 py-2 text-sm transition {{ request()->routeIs($item['active']) ? 'bg-forest text-ivory' : 'text-sage-soft hover:bg-forest hover:text-ivory' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-pine px-3 py-4">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="block w-full rounded px-3 py-2 text-left text-sm text-sage-soft transition hover:bg-forest hover:text-ivory">
                Sign out
            </button>
        </form>
    </div>
</aside>
