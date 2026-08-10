@extends('layouts.admin-guest')

@section('title', 'Forgot Password')

@section('content')
    <h1 class="mb-2 font-serif text-xl text-ivory">Reset your password</h1>
    <p class="mb-6 text-sm text-sage-soft">We'll email you a link to reset it.</p>

    @if (session('status'))
        <div class="mb-5 rounded border border-gold/40 bg-gold/10 px-4 py-3 text-sm text-ivory">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 rounded border border-red-800/50 bg-red-950/40 px-4 py-3 text-sm text-red-200">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-xs tracking-wide text-sage-soft uppercase">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded border border-pine bg-forest-deep px-3 py-2.5 text-sm text-ivory focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none">
        </div>

        <button type="submit"
            class="w-full rounded bg-gold px-4 py-2.5 text-sm font-medium tracking-wide text-forest-deep uppercase transition hover:bg-gold/90">
            Send Reset Link
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.login') }}" class="text-xs text-sage-soft underline hover:text-ivory">Back to sign in</a>
    </div>
@endsection
