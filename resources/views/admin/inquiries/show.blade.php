@extends('layouts.admin')

@section('title', 'Inquiry from ' . $inquiry->name)

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Inquiries', 'href' => route('admin.inquiries.index')], ['label' => $inquiry->name]]" />

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="space-y-6 rounded border border-stone bg-white p-6 lg:col-span-2">
            <div>
                <p class="text-xs tracking-wide text-moss uppercase">Message</p>
                <p class="mt-1 text-sm whitespace-pre-line text-charcoal">{{ $inquiry->message }}</p>
            </div>

            <dl class="grid grid-cols-2 gap-4 border-t border-stone pt-5 text-sm">
                <div><dt class="text-xs text-moss uppercase">Name</dt><dd class="text-charcoal">{{ $inquiry->name }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Company</dt><dd class="text-charcoal">{{ $inquiry->company ?? '—' }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Email</dt><dd class="text-charcoal">{{ $inquiry->email }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Phone</dt><dd class="text-charcoal">{{ $inquiry->phone ?? '—' }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Country</dt><dd class="text-charcoal">{{ $inquiry->country ?? '—' }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Product Interest</dt><dd class="text-charcoal">{{ $inquiry->product_interest ?? '—' }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Quantity</dt><dd class="text-charcoal">{{ $inquiry->quantity ?? '—' }}</dd></div>
                <div><dt class="text-xs text-moss uppercase">Received</dt><dd class="text-charcoal">{{ $inquiry->created_at?->format('M j, Y g:ia') }}</dd></div>
            </dl>
        </div>

        <div class="space-y-6">
            <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}" class="space-y-5 rounded border border-stone bg-white p-6">
                @csrf
                @method('PUT')

                <x-admin.select name="status" label="Status" required
                    :options="['new' => 'New', 'contacted' => 'Contacted', 'in_progress' => 'In Progress', 'completed' => 'Completed', 'archived' => 'Archived']"
                    :selected="$inquiry->status" />

                <x-admin.textarea name="admin_notes" label="Internal Notes" :value="$inquiry->admin_notes ?? ''" rows="5" />

                <x-admin.button type="submit" variant="primary" class="w-full">Save</x-admin.button>
            </form>

            <div class="rounded border border-stone bg-white p-6">
                <x-admin.delete-button :action="route('admin.inquiries.destroy', $inquiry)" label="Delete Inquiry" />
            </div>
        </div>
    </div>
@endsection
