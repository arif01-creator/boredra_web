@extends('layouts.admin')

@section('title', 'SEO')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'SEO']]" />

    <p class="mb-4 text-xs font-medium tracking-wide text-moss uppercase">Pages</p>
    <x-admin.data-table :headers="['Page', '']">
        @foreach ($pages as $page)
            <tr>
                <td class="px-4 py-3 font-medium text-charcoal">{{ $page->title }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.seo.edit', ['type' => 'page', 'id' => $page->id]) }}" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit SEO</a>
                </td>
            </tr>
        @endforeach
    </x-admin.data-table>

    <p class="mt-8 mb-4 text-xs font-medium tracking-wide text-moss uppercase">Products</p>
    <x-admin.data-table :headers="['Product', '']">
        @foreach ($products as $product)
            <tr>
                <td class="px-4 py-3 font-medium text-charcoal">{{ $product->name }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.seo.edit', ['type' => 'product', 'id' => $product->id]) }}" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit SEO</a>
                </td>
            </tr>
        @endforeach
    </x-admin.data-table>
@endsection
