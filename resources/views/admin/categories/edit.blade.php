@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Categories', 'href' => route('admin.categories.index')], ['label' => $category->name]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.categories._form')
    </form>
@endsection
