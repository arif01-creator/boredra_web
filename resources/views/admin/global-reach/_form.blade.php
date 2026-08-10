<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <x-admin.input name="country" label="Country / Region" required :value="$market->country ?? ''" />
        <x-admin.textarea name="description" label="Description" :value="$market->description ?? ''" rows="3" />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <x-admin.input name="latitude" label="Latitude" type="number" required :value="$market->latitude ?? ''" step="any" />
            <x-admin.input name="longitude" label="Longitude" type="number" required :value="$market->longitude ?? ''" step="any" />
        </div>
    </div>

    <div class="space-y-6">
        <x-admin.select name="status" label="Status" required
            :options="['draft' => 'Draft', 'published' => 'Published']"
            :selected="$market->status ?? 'published'" />

        <x-admin.input name="display_order" label="Display Order" type="number" :value="$market->display_order ?? 0" />
    </div>
</div>

<div class="mt-8 flex items-center gap-3 border-t border-stone pt-6">
    <x-admin.button type="submit" variant="primary">{{ isset($market) ? 'Save Changes' : 'Add Market' }}</x-admin.button>
    <x-admin.button :href="route('admin.global-reach.index')" variant="secondary">Cancel</x-admin.button>
</div>
