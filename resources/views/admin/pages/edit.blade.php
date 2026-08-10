@extends('layouts.admin')

@section('title', 'Edit ' . $page->title)

@php $s = $page->sections ?? []; @endphp

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Pages', 'href' => route('admin.pages.index')], ['label' => $page->title]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        @if ($page->slug === 'home-intro')
            <x-admin.input name="label" label="Micro Label" :value="$s['label'] ?? ''" />
            <x-admin.textarea name="heading" label="Heading (use line breaks as shown on site)" :value="$s['heading'] ?? ''" rows="3" />
            <x-admin.textarea name="body" label="Body" :value="$s['body'] ?? ''" rows="5" />
        @elseif ($page->slug === 'about')
            <x-admin.textarea name="heading" label="Heading (use line breaks as shown on site)" :value="$s['heading'] ?? ''" rows="3" />
            <x-admin.textarea name="body" label="Body" :value="$s['body'] ?? ''" rows="6" />
        @elseif ($page->slug === 'company-profile')
            <x-admin.input name="legal_name" label="Legal Name" :value="$s['legal_name'] ?? ''" />
            <x-admin.input name="business_type" label="Business Type" :value="$s['business_type'] ?? ''" />
            <x-admin.input name="address" label="Address" :value="$s['address'] ?? ''" />
        @elseif ($page->slug === 'responsibility')
            <x-admin.textarea name="heading" label="Heading" :value="$s['heading'] ?? ''" rows="2" />
            <p class="text-xs text-moss">Enable or disable this section on the public site via <a href="{{ route('admin.settings.edit') }}" class="underline">Settings</a>.</p>
        @else
            <x-admin.textarea name="body" label="Body" :value="$s['body'] ?? ''" rows="12" />
        @endif

        <div class="flex items-center gap-3 border-t border-stone pt-6">
            <x-admin.button type="submit" variant="primary">Save Changes</x-admin.button>
            <x-admin.button :href="route('admin.pages.index')" variant="secondary">Cancel</x-admin.button>
        </div>
    </form>
@endsection
