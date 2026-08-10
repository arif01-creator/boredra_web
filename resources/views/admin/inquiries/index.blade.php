@extends('layouts.admin')

@section('title', 'Inquiries')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Inquiries']]" />

    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, company, email"
                class="w-64 rounded border border-stone px-3 py-2 text-sm">
            <select name="status" class="rounded border border-stone px-3 py-2 text-sm">
                <option value="">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                @endforeach
            </select>
            <x-admin.button type="submit" variant="secondary">Filter</x-admin.button>
        </form>

        <x-admin.button :href="route('admin.inquiries.export')" variant="secondary">Export CSV</x-admin.button>
    </div>

    @if ($inquiries->isEmpty())
        <x-admin.empty-state title="No inquiries yet" description="New inquiries submitted from the public contact form will appear here." />
    @else
        <x-admin.data-table :headers="['Name', 'Company', 'Country', 'Status', 'Received', '']">
            @foreach ($inquiries as $inquiry)
                <tr>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $inquiry->name }}</td>
                    <td class="px-4 py-3 text-moss">{{ $inquiry->company ?? '—' }}</td>
                    <td class="px-4 py-3 text-moss">{{ $inquiry->country ?? '—' }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$inquiry->status" /></td>
                    <td class="px-4 py-3 text-moss">{{ $inquiry->created_at?->format('M j, Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">View</a>
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>

        <div class="mt-6">{{ $inquiries->links() }}</div>
    @endif
@endsection
