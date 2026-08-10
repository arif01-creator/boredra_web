<div class="max-w-lg space-y-6">
    <x-admin.translatable-input name="label" label="Label" required :value="isset($stat) ? $stat->getTranslations('label') : []" />
    <x-admin.translatable-input name="value" label="Value" required :value="isset($stat) ? $stat->getTranslations('value') : []" />

    <x-admin.select name="status" label="Status" required
        :options="['draft' => 'Draft', 'published' => 'Published']"
        :selected="$stat->status ?? 'published'" />

    <x-admin.input name="sort_order" label="Sort Order" type="number" :value="$stat->sort_order ?? 0" />
</div>

<div class="mt-8 flex items-center gap-3 border-t border-stone pt-6">
    <x-admin.button type="submit" variant="primary">{{ isset($stat) ? 'Save Changes' : 'Add Stat' }}</x-admin.button>
    <x-admin.button :href="route('admin.company-stats.index')" variant="secondary">Cancel</x-admin.button>
</div>
