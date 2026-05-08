@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <h1 class="font-display text-2xl font-black text-slate-900 mb-1">Buat Akun Baru</h1>
    <p class="text-slate-400 text-sm mb-6">Daftar dan mulai booking hotel impianmu</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="John Doe"
                class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                       placeholder:text-slate-300 @error('name') border-rose @enderror"
            >
            @error('name')
                <p class="text-rose text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
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
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                       placeholder:text-slate-300 @error('password') border-rose @enderror"
            >
            @error('password')
                <p class="text-rose text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password"
                class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                       placeholder:text-slate-300"
            >
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-rose w-full justify-center text-center py-3 rounded-xl">
            Daftar Sekarang
        </button>
    </form>

    <p class="text-center text-sm text-slate-400 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Masuk</a>
    </p>
@endsection
