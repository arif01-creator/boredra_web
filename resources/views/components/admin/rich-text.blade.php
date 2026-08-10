@props(['name', 'label' => null, 'value' => null])

<div>
    @if ($label)
        <label class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">{{ $label }}</label>
    @endif

    <input id="{{ $name }}_input" type="hidden" name="{{ $name }}" value="{{ old($name, $value) }}">
    <trix-editor input="{{ $name }}_input" class="trix-content"></trix-editor>

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
