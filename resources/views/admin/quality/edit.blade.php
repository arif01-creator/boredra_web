@extends('layouts.admin')

@section('title', 'Edit Stage')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Quality Process', 'href' => route('admin.quality.index')], ['label' => $stage->title]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.quality.update', $stage) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.quality._form')
    </form>
@endsection
