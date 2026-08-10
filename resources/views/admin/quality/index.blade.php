@extends('layouts.admin')

@section('title', 'Quality Process')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Quality Process']]" />

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-moss">{{ $stages->count() }} stages</p>
        <x-admin.button :href="route('admin.quality.create')" variant="primary">+ Add Stage</x-admin.button>
    </div>

    @if ($stages->isEmpty())
        <x-admin.empty-state title="No stages yet" action-label="Add Stage" :action-href="route('admin.quality.create')" />
    @else
        <x-admin.data-table :headers="['Order', 'Title', 'Status', '']">
            @foreach ($stages as $stage)
                <tr>
                    <td class="px-4 py-3 text-moss">{{ $stage->sort_order }}</td>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $stage->title }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$stage->status" /></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.quality.edit', $stage) }}" class="mr-4 text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                        <x-admin.delete-button :action="route('admin.quality.destroy', $stage)" />
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>
    @endif
@endsection
