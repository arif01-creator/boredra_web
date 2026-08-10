@extends('layouts.admin')

@section('title', 'Company Stats')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Company Stats']]" />

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-moss">Only display verified figures — no estimates.</p>
        <x-admin.button :href="route('admin.company-stats.create')" variant="primary">+ Add Stat</x-admin.button>
    </div>

    @if ($stats->isEmpty())
        <x-admin.empty-state title="No stats yet" action-label="Add Stat" :action-href="route('admin.company-stats.create')" />
    @else
        <x-admin.data-table :headers="['Label', 'Value', 'Status', 'Order', '']">
            @foreach ($stats as $stat)
                <tr>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $stat->label }}</td>
                    <td class="px-4 py-3 text-moss">{{ $stat->value }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$stat->status" /></td>
                    <td class="px-4 py-3 text-moss">{{ $stat->sort_order }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.company-stats.edit', $stat) }}" class="mr-4 text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                        <x-admin.delete-button :action="route('admin.company-stats.destroy', $stat)" />
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>
    @endif
@endsection
