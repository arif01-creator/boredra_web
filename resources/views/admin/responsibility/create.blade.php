@extends('layouts.admin')

@section('title', 'Add Topic')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Responsibility', 'href' => route('admin.responsibility.index')], ['label' => 'Add Topic']]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.responsibility.store') }}">
        @csrf
        @include('admin.responsibility._form')
    </form>
@endsection
