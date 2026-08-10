@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Categories']]" />

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-moss">{{ $categories->count() }} total</p>
        <x-admin.button :href="route('admin.categories.create')" variant="primary">+ Add Category</x-admin.button>
    </div>

    @if ($categories->isEmpty())
        <x-admin.empty-state title="No categories yet" action-label="Add Category" :action-href="route('admin.categories.create')" />
    @else
        <x-admin.data-table :headers="['Name', 'Products', 'Status', 'Order', '']">
            @foreach ($categories as $category)
                <tr>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-moss">{{ $category->products_count }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$category->status" /></td>
                    <td class="px-4 py-3 text-moss">{{ $category->sort_order }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="mr-4 text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                        <x-admin.delete-button :action="route('admin.categories.destroy', $category)" />
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>
    @endif
@endsection
