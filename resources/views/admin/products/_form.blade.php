@php
    $specKeys = ['Material Type', 'Source', 'Processing', 'Texture', 'Available Forms', 'Packaging'];

    $specsEn = isset($product) ? $product->getTranslation('specifications', 'en', false) : [];
    $specsBn = isset($product) ? $product->getTranslation('specifications', 'bn', false) : [];
    $specsEn = old('specifications.en', is_array($specsEn) ? $specsEn : []);
    $specsBn = old('specifications.bn', is_array($specsBn) ? $specsBn : []);

    $appsEn = isset($product) ? $product->getTranslation('applications', 'en', false) : [];
    $appsBn = isset($product) ? $product->getTranslation('applications', 'bn', false) : [];
    $appsEn = array_values(old('applications.en', is_array($appsEn) ? $appsEn : []));
    $appsBn = array_values(old('applications.bn', is_array($appsBn) ? $appsBn : []));

    $rows = [];
    for ($i = 0; $i < max(count($appsEn), count($appsBn)); $i++) {
        $rows[] = ['en' => $appsEn[$i] ?? '', 'bn' => $appsBn[$i] ?? ''];
    }
@endphp

<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <x-admin.translatable-input name="name" label="Name" required :value="isset($product) ? $product->getTranslations('name') : []" />
            <x-admin.input name="slug" label="Slug" required :value="$product->slug ?? ''" />
        </div>

        <x-admin.translatable-input name="short_description" label="Short Description" :value="isset($product) ? $product->getTranslations('short_description') : []" />
        <x-admin.translatable-rich-text name="long_description" label="Long Description" :value="isset($product) ? $product->getTranslations('long_description') : []" />

        <div
            x-data="productLocalizedFields({
                specs: {
                    en: @js(collect($specKeys)->mapWithKeys(fn ($key) => [$key => $specsEn[$key] ?? ''])),
                    bn: @js(collect($specKeys)->mapWithKeys(fn ($key) => [$key => $specsBn[$key] ?? ''])),
                },
                rows: @js($rows),
            })"
        >
            <div class="mb-3 flex items-center justify-between gap-3">
                <label class="text-xs font-medium tracking-wide text-moss uppercase">Specifications &amp; Applications</label>
                <div class="flex items-center gap-3">
                    <div class="flex overflow-hidden rounded border border-stone text-[10px] font-medium uppercase">
                        <button type="button" @click="active = 'en'" :class="active === 'en' ? 'bg-forest-deep text-ivory' : 'bg-white text-moss'" class="px-2 py-1">EN</button>
                        <button type="button" @click="active = 'bn'" :class="active === 'bn' ? 'bg-forest-deep text-ivory' : 'bg-white text-moss'" class="px-2 py-1">BN</button>
                    </div>
                    <button type="button" @click="translateAll()" :disabled="translating" class="text-[10px] font-medium tracking-wide text-forest-deep uppercase hover:underline disabled:opacity-40">
                        <span x-show="!translating">Translate to Bengali</span>
                        <span x-show="translating" x-cloak>Translating…</span>
                    </button>
                </div>
            </div>

            <p class="mb-3 text-xs text-red-600" x-show="error" x-text="error" x-cloak></p>

            <div>
                <p class="mb-1.5 text-xs text-moss">Specifications — leave a field blank to hide it on the public product page.</p>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ($specKeys as $key)
                        <input
                            type="text"
                            x-show="active === 'en'"
                            x-model="specs.en['{{ $key }}']"
                            name="specifications[en][{{ $key }}]"
                            placeholder="{{ $key }}"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none"
                        >
                        <input
                            type="text"
                            x-show="active === 'bn'"
                            x-model="specs.bn['{{ $key }}']"
                            name="specifications[bn][{{ $key }}]"
                            placeholder="{{ $key }}"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none"
                        >
                    @endforeach
                </div>
            </div>

            <div class="mt-5">
                <p class="mb-1.5 text-xs text-moss">Applications</p>
                <template x-for="(row, index) in rows" :key="index">
                    <div class="mb-2 flex gap-2">
                        <input type="text" x-show="active === 'en'" x-model="row.en" :name="`applications[en][${index}]`"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none">
                        <input type="text" x-show="active === 'bn'" x-model="row.bn" :name="`applications[bn][${index}]`"
                            class="w-full rounded border border-stone bg-white px-3 py-2 text-sm text-charcoal focus:border-forest focus:ring-1 focus:ring-forest focus:outline-none">
                        <button type="button" @click="removeRow(index)" class="rounded border border-stone px-2 text-xs text-moss uppercase hover:bg-ivory">Remove</button>
                    </div>
                </template>
                <button type="button" @click="addRow()" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">+ Add application</button>
            </div>
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
