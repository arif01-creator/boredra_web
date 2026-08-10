@extends('layouts.admin')

@section('title', 'Add Stage')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Quality Process', 'href' => route('admin.quality.index')], ['label' => 'Add Stage']]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.quality.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.quality._form')
    </form>
@endsection
