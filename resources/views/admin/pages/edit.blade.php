@extends('layouts.admin')

@section('title', 'Edit ' . $page->title)

@php
    $sEn = $page->getTranslation('sections', 'en', false);
    $sBn = $page->getTranslation('sections', 'bn', false);
    $sEn = is_array($sEn) ? $sEn : [];
    $sBn = is_array($sBn) ? $sBn : [];

    $fields = match ($page->slug) {
        'home-intro' => [
            'label' => ['type' => 'input', 'label' => 'Micro Label'],
            'heading' => ['type' => 'textarea', 'rows' => 3, 'label' => 'Heading (use line breaks as shown on site)'],
            'body' => ['type' => 'textarea', 'rows' => 5, 'label' => 'Body'],
        ],
        'about' => [
            'heading' => ['type' => 'textarea', 'rows' => 3, 'label' => 'Heading (use line breaks as shown on site)'],
            'body' => ['type' => 'textarea', 'rows' => 6, 'label' => 'Body'],
        ],
        'company-profile' => [
            'legal_name' => ['type' => 'input', 'label' => 'Legal Name'],
            'business_type' => ['type' => 'input', 'label' => 'Business Type'],
            'address' => ['type' => 'input', 'label' => 'Address'],
        ],
        'responsibility' => [
            'heading' => ['type' => 'textarea', 'rows' => 2, 'label' => 'Heading'],
        ],
        default => [
            'body' => ['type' => 'textarea', 'rows' => 12, 'label' => 'Body'],
        ],
    };
@endphp

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

        <div
            x-data="pageLocalizedForm({
                en: @js(collect($fields)->mapWithKeys(fn ($field, $key) => [$key => old('sections.en.'.$key, $sEn[$key] ?? '')])),
                bn: @js(collect($fields)->mapWithKeys(fn ($field, $key) => [$key => old('sections.bn.'.$key, $sBn[$key] ?? '')])),
            })"
        >
            <div class="mb-5 flex items-center justify-between gap-3">
                <div class="flex w-fit overflow-hidden rounded border border-stone text-[10px] font-medium uppercase">
                    <button type="button" @click="active = 'en'" :class="active === 'en' ? 'bg-forest-deep text-ivory' : 'bg-white text-moss'" class="px-2 py-1">EN</button>
                    <button type="button" @click="active = 'bn'" :class="active === 'bn' ? 'bg-forest-deep text-ivory' : 'bg-white text-moss'" class="px-2 py-1">BN</button>
                </div>
                <button type="button" @click="translateAll()" :disabled="translating" class="text-[10px] font-medium tracking-wide text-forest-deep uppercase hover:underline disabled:opacity-40">
                    <span x-show="!translating">Translate to Bengali</span>
                    <span x-show="translating" x-cloak>Translating…</span>
                </button>
            </div>

            <p class="mb-3 text-xs text-red-600" x-show="error" x-text="error" x-cloak></p>

            @foreach ($fields as $key => $field)
                <div class="mb-5">
                    <label class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">{{ $field['label'] }}</label>

                    @if ($field['type'] === 'textarea')
                        <textarea x-show="active === 'en'" x-model="values.en['{{ $key }}']" name="sections[en][{{ $key }}]" rows="{{ $field['rows'] }}"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none"></textarea>
                        <textarea x-show="active === 'bn'" x-model="values.bn['{{ $key }}']" name="sections[bn][{{ $key }}]" rows="{{ $field['rows'] }}"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none"></textarea>
                    @else
                        <input type="text" x-show="active === 'en'" x-model="values.en['{{ $key }}']" name="sections[en][{{ $key }}]"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none">
                        <input type="text" x-show="active === 'bn'" x-model="values.bn['{{ $key }}']" name="sections[bn][{{ $key }}]"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none">
                    @endif
                </div>
            @endforeach

            @if ($page->slug === 'responsibility')
                <p class="text-xs text-moss">Enable or disable this section on the public site via <a href="{{ route('admin.settings.edit') }}" class="underline">Settings</a>.</p>
            @endif
        </div>

        <div class="flex items-center gap-3 border-t border-stone pt-6">
            <x-admin.button type="submit" variant="primary">Save Changes</x-admin.button>
            <x-admin.button :href="route('admin.pages.index')" variant="secondary">Cancel</x-admin.button>
        </div>
    </form>
@endsection
