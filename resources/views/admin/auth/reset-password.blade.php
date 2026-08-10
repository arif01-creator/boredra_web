@extends('layouts.admin-guest')

@section('title', 'Reset Password')

@section('content')
    <h1 class="mb-6 font-serif text-xl text-ivory">Set a new password</h1>

    @if ($errors->any())
        <div class="mb-5 rounded border border-red-800/50 bg-red-950/40 px-4 py-3 text-sm text-red-200">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="mb-1.5 block text-xs tracking-wide text-sage-soft uppercase">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus
                class="w-full rounded border border-pine bg-forest-deep px-3 py-2.5 text-sm text-ivory focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none">
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-xs tracking-wide text-sage-soft uppercase">New Password</label>
            <input id="password" type="password" name="password" required
                class="w-full rounded border border-pine bg-forest-deep px-3 py-2.5 text-sm text-ivory focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none">
        </div>

        <div>
            <label for="password_confirmation" class="mb-1.5 block text-xs tracking-wide text-sage-soft uppercase">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full rounded border border-pine bg-forest-deep px-3 py-2.5 text-sm text-ivory focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none">
        </div>

        <button type="submit"
            class="w-full rounded bg-gold px-4 py-2.5 text-sm font-medium tracking-wide text-forest-deep uppercase transition hover:bg-gold/90">
            Reset Password
        </button>
    </form>
@endsection
