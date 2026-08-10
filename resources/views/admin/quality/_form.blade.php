<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <x-admin.translatable-input name="title" label="Title" required :value="isset($stage) ? $stage->getTranslations('title') : []" />
        <x-admin.translatable-textarea name="description" label="Description" :value="isset($stage) ? $stage->getTranslations('description') : []" rows="4" />
    </div>

    <div class="space-y-6">
        <x-admin.select name="status" label="Status" required
            :options="['draft' => 'Draft', 'published' => 'Published']"
            :selected="$stage->status ?? 'published'" />

        <x-admin.input name="sort_order" label="Sort Order" type="number" :value="$stage->sort_order ?? 0" hint="Lower numbers appear first." />

        <x-admin.image-input name="image" label="Image" :current="$stage->image ?? null" />
    </div>
</div>

<div class="mt-8 flex items-center gap-3 border-t border-stone pt-6">
    <x-admin.button type="submit" variant="primary">{{ isset($stage) ? 'Save Changes' : 'Create Stage' }}</x-admin.button>
    <x-admin.button :href="route('admin.quality.index')" variant="secondary">Cancel</x-admin.button>
</div>
