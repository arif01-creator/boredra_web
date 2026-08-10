@props(['name', 'label' => null, 'value' => [], 'rows' => 4, 'required' => false])

<div
    x-data="translatableField(@js(['en' => old($name.'.en', $value['en'] ?? ''), 'bn' => old($name.'.bn', $value['bn'] ?? '')]))"
>
    <div class="mb-1.5 flex items-center justify-between gap-3">
        @if ($label)
            <label class="text-xs font-medium tracking-wide text-moss uppercase">
                {{ $label }} @if($required)<span class="text-red-600">*</span>@endif
            </label>
        @endif

        <div class="flex items-center gap-3">
            <div class="flex overflow-hidden rounded border border-stone text-[10px] font-medium uppercase">
                <button type="button" @click="active = 'en'" :class="active === 'en' ? 'bg-forest-deep text-ivory' : 'bg-white text-moss'" class="px-2 py-1">EN</button>
                <button type="button" @click="active = 'bn'" :class="active === 'bn' ? 'bg-forest-deep text-ivory' : 'bg-white text-moss'" class="px-2 py-1">BN</button>
            </div>
            <button type="button" @click="translate()" :disabled="translating" class="text-[10px] font-medium tracking-wide text-forest-deep uppercase hover:underline disabled:opacity-40">
                <span x-show="!translating">Translate to Bengali</span>
                <span x-show="translating" x-cloak>Translating…</span>
            </button>
        </div>
    </div>

    <textarea
        name="{{ $name }}[en]"
        rows="{{ $rows }}"
        x-show="active === 'en'"
        x-model="values.en"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none']) }}
    ></textarea>
    <textarea
        name="{{ $name }}[bn]"
        rows="{{ $rows }}"
        x-show="active === 'bn'"
        x-model="values.bn"
        {{ $attributes->merge(['class' => 'w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none']) }}
    ></textarea>

    <p class="mt-1 text-xs text-red-600" x-show="error" x-text="error" x-cloak></p>

    @error($name.'.en')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    @error($name.'.bn')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
