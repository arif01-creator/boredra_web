@php
    $specKeys = ['Material Type', 'Source', 'Processing', 'Texture', 'Available Forms', 'Packaging'];
    $specs = old('specifications', $product->specifications ?? []);
@endphp

<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <x-admin.input name="name" label="Name" required :value="$product->name ?? ''" />
            <x-admin.input name="slug" label="Slug" required :value="$product->slug ?? ''" />
        </div>

        <x-admin.input name="short_description" label="Short Description" :value="$product->short_description ?? ''" />
        <x-admin.rich-text name="long_description" label="Long Description" :value="$product->long_description ?? ''" />

        <div>
            <label class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">Specifications</label>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach ($specKeys as $key)
                    <input
                        type="text"
                        name="specifications[{{ $key }}]"
                        value="{{ $specs[$key] ?? '' }}"
                        placeholder="{{ $key }}"
                        class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none"
                    >
                @endforeach
            </div>
            <p class="mt-1 text-xs text-moss">Leave a field blank to hide it on the public product page.</p>
        </div>

        <div x-data="{ items: @json(old('applications', $product->applications ?? [])) }">
            <label class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">Applications</label>
            <template x-for="(item, index) in items" :key="index">
                <div class="mb-2 flex gap-2">
                    <input type="text" :name="`applications[${index}]`" x-model="items[index]"
                        class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none">
                    <button type="button" @click="items.splice(index, 1)" class="rounded border border-stone px-2 text-xs text-moss uppercase hover:bg-ivory">Remove</button>
                </div>
            </template>
            <button type="button" @click="items.push('')" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">+ Add application</button>
        </div>
    </div>

    <div class="space-y-6">
        <x-admin.select name="product_category_id" label="Category" required
            :options="$categories->pluck('name', 'id')->all()"
            :selected="$product->product_category_id ?? old('product_category_id')" />

        <x-admin.select name="status" label="Status" required
            :options="['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived']"
            :selected="$product->status ?? 'draft'" />

        <x-admin.input name="sort_order" label="Sort Order" type="number" :value="$product->sort_order ?? 0" />

        <x-admin.image-input name="featured_image" label="Featured Image" :current="$product->featured_image ?? null" />
    </div>
</div>

<div class="mt-8 flex items-center gap-3 border-t border-stone pt-6">
    <x-admin.button type="submit" variant="primary">{{ isset($product) ? 'Save Changes' : 'Create Product' }}</x-admin.button>
    <x-admin.button :href="route('admin.products.index')" variant="secondary">Cancel</x-admin.button>
</div>
