@extends('layouts.admin')

@section('title', 'Edit SEO')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'SEO', 'href' => route('admin.seo.index')], ['label' => $model->title ?? $model->name]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.seo.update', ['type' => $type, 'id' => $model->id]) }}" class="max-w-2xl space-y-5">
        @csrf
        @method('PUT')

        <x-admin.translatable-input name="title" label="SEO Title" :value="$seo?->getTranslations('title') ?? []" />
        <x-admin.translatable-textarea name="meta_description" label="Meta Description" :value="$seo?->getTranslations('meta_description') ?? []" rows="3" />
        <x-admin.input name="canonical_url" label="Canonical URL" :value="$seo->canonical_url ?? ''" />
        <x-admin.translatable-input name="og_title" label="OG Title" :value="$seo?->getTranslations('og_title') ?? []" />
        <x-admin.translatable-textarea name="og_description" label="OG Description" :value="$seo?->getTranslations('og_description') ?? []" rows="2" />
        <x-admin.input name="og_image" label="OG Image URL" :value="$seo->og_image ?? ''" />
        <x-admin.input name="robots" label="Robots" :value="$seo->robots ?? 'index, follow'" />

        <div class="flex items-center gap-3 border-t border-stone pt-6">
            <x-admin.button type="submit" variant="primary">Save Changes</x-admin.button>
            <x-admin.button :href="route('admin.seo.index')" variant="secondary">Cancel</x-admin.button>
        </div>
    </form>
@endsection
