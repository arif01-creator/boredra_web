@extends('layouts.admin')

@section('title', 'Edit Destination')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Global Reach', 'href' => route('admin.global-reach.index')], ['label' => $market->country]]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.global-reach.update', $market) }}">
        @csrf
        @method('PUT')
        @include('admin.global-reach._form')
    </form>
@endsection
