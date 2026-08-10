@props(['name', 'label' => null, 'value' => []])

<div x-data="translatableRichText()">
    <div class="mb-1.5 flex items-center justify-between gap-3">
        @if ($label)
            <label class="text-xs font-medium tracking-wide text-moss uppercase">{{ $label }}</label>
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

    <div x-show="active === 'en'">
        <input x-ref="enHidden" id="{{ $name }}_en_input" type="hidden" name="{{ $name }}[en]" value="{{ old($name.'.en', $value['en'] ?? '') }}">
        <trix-editor x-ref="enEditor" input="{{ $name }}_en_input" class="trix-content"></trix-editor>
    </div>
    <div x-show="active === 'bn'">
        <input x-ref="bnHidden" id="{{ $name }}_bn_input" type="hidden" name="{{ $name }}[bn]" value="{{ old($name.'.bn', $value['bn'] ?? '') }}">
        <trix-editor x-ref="bnEditor" input="{{ $name }}_bn_input" class="trix-content"></trix-editor>
    </div>

    <p class="mt-1 text-xs text-red-600" x-show="error" x-text="error" x-cloak></p>

    @error($name.'.en')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    @error($name.'.bn')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
