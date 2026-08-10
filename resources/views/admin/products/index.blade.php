@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Products']]" />

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-moss">{{ $products->total() }} total</p>
        <x-admin.button :href="route('admin.products.create')" variant="primary">+ Add Product</x-admin.button>
    </div>

    @if ($products->isEmpty())
        <x-admin.empty-state
            title="No products yet"
            description="Add your first product to start building the catalogue."
            action-label="Add Product"
            :action-href="route('admin.products.create')"
        />
    @else
        <x-admin.data-table :headers="['Name', 'Category', 'Status', 'Order', '']">
            @foreach ($products as $product)
                <tr>
                    <td class="px-4 py-3 font-medium text-charcoal">{{ $product->name }}</td>
                    <td class="px-4 py-3 text-moss">{{ $product->category?->name }}</td>
                    <td class="px-4 py-3"><x-admin.status-badge :status="$product->status" /></td>
                    <td class="px-4 py-3 text-moss">{{ $product->sort_order }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.products.edit', $product) }}" class="mr-4 text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                        <x-admin.delete-button :action="route('admin.products.destroy', $product)" class="inline" />
                    </td>
                </tr>
            @endforeach
        </x-admin.data-table>

        <div class="mt-6">{{ $products->links() }}</div>
    @endif
@endsection
