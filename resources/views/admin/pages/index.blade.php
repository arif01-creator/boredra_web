@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Pages']]" />

    <x-admin.data-table :headers="['Page', 'Slug', '']">
        @foreach ($pages as $page)
            <tr>
                <td class="px-4 py-3 font-medium text-charcoal">{{ $page->title }}</td>
                <td class="px-4 py-3 font-mono text-xs text-moss">{{ $page->slug }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="text-xs font-medium tracking-wide text-forest-deep uppercase hover:underline">Edit</a>
                </td>
            </tr>
        @endforeach
    </x-admin.data-table>
@endsection
