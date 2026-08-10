<div class="max-w-lg space-y-6">
    <x-admin.input name="title" label="Title" required :value="$item->title ?? ''" />
    <x-admin.textarea name="description" label="Description (verified detail only)" :value="$item->description ?? ''" rows="4" />
    <x-admin.input name="icon" label="Icon key (optional)" :value="$item->icon ?? ''" />

    <x-admin.select name="status" label="Status" required
        :options="['draft' => 'Draft', 'published' => 'Published']"
        :selected="$item->status ?? 'published'" />

    <x-admin.input name="sort_order" label="Sort Order" type="number" :value="$item->sort_order ?? 0" />
</div>

<div class="mt-8 flex items-center gap-3 border-t border-stone pt-6">
    <x-admin.button type="submit" variant="primary">{{ isset($item) ? 'Save Changes' : 'Add Topic' }}</x-admin.button>
    <x-admin.button :href="route('admin.responsibility.index')" variant="secondary">Cancel</x-admin.button>
</div>
