@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <h1 class="font-display text-2xl font-black text-slate-900 mb-1">Selamat Datang</h1>
    <p class="text-slate-400 text-sm mb-6">Masuk ke akun Relaxin kamu</p>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="bg-cyan-50 text-primary text-sm rounded-xl px-4 py-3 mb-5 border border-primary/20">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="kamu@email.com"
                class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                       placeholder:text-slate-300 @error('email') border-rose @enderror"
            >
            @error('email')
                <p class="text-rose text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-primary hover:underline">Lupa password?</a>
                @endif
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                       placeholder:text-slate-300 @error('password') border-rose @enderror"
            >
            @error('password')
                <p class="text-rose text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center gap-2">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="rounded border-slate-300 text-primary focus:ring-primary/40"
            >
            <label for="remember_me" class="text-sm text-slate-500">Ingat saya</label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-primary w-full justify-center text-center py-3 rounded-xl">
            Masuk
        </button>
    </form>

    @if (Route::has('register'))
        <p class="text-center text-sm text-slate-400 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Daftar sekarang</a>
        </p>
    @endif
@endsection
