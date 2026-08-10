@extends('layouts.admin')

@section('title', 'Edit Topic')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Responsibility', 'href' => route('admin.responsibility.index')], ['label' => $item->title]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.responsibility.update', $item) }}">
        @csrf
        @method('PUT')
        @include('admin.responsibility._form')
    </form>
@endsection
