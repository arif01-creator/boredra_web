@extends('layouts.admin')

@section('title', 'Global Reach')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Global Reach']]" />

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-moss">{{ $markets->count() }} destinations</p>
        <x-admin.button :href="route('admin.global-reach.create')" variant="primary">+ Add Destination</x-admin.button>
    </div>

    @if ($markets->isEmpty())
        <x-admin.empty-state
            title="No export destinations yet"
            description="Only published, verified destinations appear on the public Global Reach map."
            action-label="Add Destination"
            :action-href="route('admin.global-reach.create')"
        />
    @else
        <x-admin.data-table :headers="['Country', 'Coordinates', 'Status', 'Order', '']">
            @foreach ($markets as $market)
                <tr>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $market->country }}</td>
                    <td class="px-4 py-3 text-moss">{{ $market->latitude }}, {{ $market->longitude }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$market->status" /></td>
                    <td class="px-4 py-3 text-moss">{{ $market->display_order }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.global-reach.edit', $market) }}" class="mr-4 text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                        <x-admin.delete-button :action="route('admin.global-reach.destroy', $market)" />
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>
    @endif
@endsection
