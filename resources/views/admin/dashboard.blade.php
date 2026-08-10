@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded border border-stone bg-white p-6">
            <p class="text-xs tracking-wide text-moss uppercase">Total Products</p>
            <p class="mt-2 font-serif text-3xl text-charcoal">{{ $totalProducts }}</p>
        </div>
        <div class="rounded border border-stone bg-white p-6">
            <p class="text-xs tracking-wide text-moss uppercase">Published Content</p>
            <p class="mt-2 font-serif text-3xl text-charcoal">{{ $publishedProducts }}</p>
        </div>
        <div class="rounded border border-stone bg-white p-6">
            <p class="text-xs tracking-wide text-moss uppercase">New Inquiries</p>
            <p class="mt-2 font-serif text-3xl text-charcoal">{{ $newInquiries }}</p>
        </div>
        <div class="rounded border border-stone bg-white p-6">
            <p class="text-xs tracking-wide text-moss uppercase">Media Assets</p>
            <p class="mt-2 font-serif text-3xl text-charcoal">{{ $mediaAssets }}</p>
        </div>
    </div>

    <div class="rounded border border-stone bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <p class="font-serif text-lg text-charcoal">Recent Inquiries</p>
            <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">View all</a>
        </div>

        @if ($recentInquiries->isEmpty())
            <x-admin.empty-state title="No inquiries yet" />
        @else
            <x-admin.data-table :headers="['Name', 'Company', 'Status', 'Received']">
                @foreach ($recentInquiries as $inquiry)
                    <tr>
                        <td class="px-4 py-3"><a href="{{ route('admin.inquiries.show', $inquiry) }}" class="font-medium text-forest-deep hover:underline">{{ $inquiry->name }}</a></td>
                        <td class="px-4 py-3 text-moss">{{ $inquiry->company ?? '—' }}</td>
                        <td class="px-4 py-3"><x-admin.status-badge :status="$inquiry->status" /></td>
                        <td class="px-4 py-3 text-moss">{{ $inquiry->created_at?->format('M j, Y') }}</td>
                    </tr>
                @endforeach
            </x-admin.data-table>
        @endif
    </div>
@endsection
