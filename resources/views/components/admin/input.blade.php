@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">
            {{ $label }} @if($required)<span class="text-red-600">*</span>@endif
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none']) }}
    >

    @if ($hint)
        <p class="mt-1 text-xs text-moss">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
