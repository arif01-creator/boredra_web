@props(['name', 'label' => null, 'options' => [], 'selected' => null, 'required' => false])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">
            {{ $label }} @if($required)<span class="text-red-600">*</span>@endif
        </label>
    @endif

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none']) }}
    >
        @foreach ($options as $value => $label_)
            <option value="{{ $value }}" @selected(old($name, $selected) == $value)>{{ $label_ }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
