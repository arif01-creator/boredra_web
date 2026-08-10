@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Products', 'href' => route('admin.products.index')], ['label' => $product->name]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products._form')
    </form>
@endsection
