<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <x-admin.input name="name" label="Name" required :value="$category->name ?? ''" />
        <x-admin.input name="slug" label="Slug" required :value="$category->slug ?? ''" />
        <x-admin.textarea name="description" label="Description" :value="$category->description ?? ''" rows="4" />
    </div>

    <div class="space-y-6">
        <x-admin.select name="status" label="Status" required
            :options="['draft' => 'Draft', 'published' => 'Published']"
            :selected="$category->status ?? 'published'" />

        <x-admin.input name="sort_order" label="Sort Order" type="number" :value="$category->sort_order ?? 0" />

        <x-admin.image-input name="image" label="Image" :current="$category->image ?? null" />
    </div>
</div>

<div class="mt-8 flex items-center gap-3 border-t border-stone pt-6">
    <x-admin.button type="submit" variant="primary">{{ isset($category) ? 'Save Changes' : 'Create Category' }}</x-admin.button>
    <x-admin.button :href="route('admin.categories.index')" variant="secondary">Cancel</x-admin.button>
</div>
