@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Products', 'href' => route('admin.products.index')], ['label' => 'Add Product']]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.products._form')
    </form>
@endsection
