@extends('layouts.admin')

@section('title', 'Responsibility')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Responsibility']]" />

    <x-admin.alert type="info" class="mb-6">
        This section is hidden on the public site unless enabled in <a href="{{ route('admin.settings.edit') }}" class="underline">Settings</a>, and until each topic below has verified, specific detail.
    </x-admin.alert>

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-moss">{{ $items->count() }} topics</p>
        <x-admin.button :href="route('admin.responsibility.create')" variant="primary">+ Add Topic</x-admin.button>
    </div>

    @if ($items->isEmpty())
        <x-admin.empty-state title="No topics yet" action-label="Add Topic" :action-href="route('admin.responsibility.create')" />
    @else
        <x-admin.data-table :headers="['Title', 'Status', 'Order', '']">
            @foreach ($items as $item)
                <tr>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $item->title }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$item->status" /></td>
                    <td class="px-4 py-3 text-moss">{{ $item->sort_order }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.responsibility.edit', $item) }}" class="mr-4 text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                        <x-admin.delete-button :action="route('admin.responsibility.destroy', $item)" />
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>
    @endif
@endsection
