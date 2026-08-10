@extends('layouts.admin-guest')

@section('title', 'Sign In')

@section('content')
    <h1 class="mb-6 font-serif text-xl text-ivory">Sign in</h1>

    @if ($errors->any())
        <div class="mb-5 rounded border border-red-800/50 bg-red-950/40 px-4 py-3 text-sm text-red-200">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-xs tracking-wide text-sage-soft uppercase">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded border border-pine bg-forest-deep px-3 py-2.5 text-sm text-ivory placeholder-sage focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none">
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-xs tracking-wide text-sage-soft uppercase">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full rounded border border-pine bg-forest-deep px-3 py-2.5 text-sm text-ivory focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none">
        </div>

        <label class="flex items-center gap-2 text-xs text-sage-soft">
            <input type="checkbox" name="remember" class="rounded border-pine bg-forest-deep">
            Remember me
        </label>

        <button type="submit"
            class="w-full rounded bg-gold px-4 py-2.5 text-sm font-medium tracking-wide text-forest-deep uppercase transition hover:bg-gold/90">
            Sign In
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.password.request') }}" class="text-xs text-sage-soft underline hover:text-ivory">Forgot your password?</a>
    </div>
@endsection
