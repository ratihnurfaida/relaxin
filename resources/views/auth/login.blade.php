<x-guest-layout>
    <h1 class="font-jakarta text-xl font-black text-white mb-0.5">Selamat Datang</h1>
    <p class="text-gray-400 text-sm mb-5">Masuk ke akun Relaxin kamu</p>

    @if (session('status'))
        <div class="bg-cyan-900 text-cyan-300 text-sm rounded-xl px-4 py-3 mb-4 border border-cyan-700">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-900 text-red-300 text-sm p-3 rounded-lg mb-4 border border-red-700">
            <ul class="space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-300 mb-1.5">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required autofocus
                autocomplete="username"
                placeholder="kamu@email.com"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-3.5 py-2.5 text-sm text-white
                       focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       placeholder-gray-600 transition
                       @error('email') border-red-500 @enderror"
            >
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-gray-300">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-cyan-400 hover:underline">Lupa password?</a>
                @endif
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-3.5 py-2.5 text-sm text-white
                       focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       placeholder-gray-600 transition
                       @error('password') border-red-500 @enderror"
            >
            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="rounded border-gray-600 text-cyan-500 focus:ring-cyan-500"
            >
            <label for="remember_me" class="text-sm text-gray-400">Ingat saya</label>
        </div>

        <button type="submit"
            class="w-full bg-[#0e7490] hover:bg-cyan-700 text-white font-bold py-2.5 rounded-lg transition-colors">
            Masuk
        </button>
    </form>

    @if (Route::has('register'))
        <p class="text-center text-sm text-gray-500 mt-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-cyan-400 font-semibold hover:underline">Daftar sekarang</a>
        </p>
    @endif
</x-guest-layout>