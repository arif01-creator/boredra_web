@extends('layouts.admin')

@section('title', 'Add Stat')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Company Stats', 'href' => route('admin.company-stats.index')], ['label' => 'Add Stat']]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.company-stats.store') }}">
        @csrf
        @include('admin.company-stats._form')
    </form>
@endsection
