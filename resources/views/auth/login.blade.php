<x-guest-layout>
    {{-- Wrapper Full Screen untuk Override Background Dark ke Soft Cyan --}}
    <div class="fixed inset-0 bg-[#ecfbfc] flex items-center justify-center p-4 z-50 overflow-y-auto">
        <div class="w-full max-w-md bg-white border border-cyan-100 rounded-2xl p-8 shadow-xl shadow-cyan-600/5">
            
            {{-- Logo Aplikasi --}}
            <div class="text-center mb-6">
                <a href="{{ route('welcome') }}" class="text-3xl font-black text-gray-800 tracking-tighter">
                    Rela<span class="text-cyan-600">Xin</span>
                </a>
                <h1 class="font-jakarta text-xl font-extrabold text-gray-800 mt-4 mb-0.5">Selamat Datang</h1>
                <p class="text-gray-500 text-sm">Masuk ke akun Relaxin kamu</p>
            </div>

            {{-- Alert Status Sesi --}}
            @if (session('status'))
                <div class="bg-cyan-50 text-cyan-800 text-sm rounded-xl px-4 py-3 mb-4 border border-cyan-100">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Alert Error Validasi --}}
            @if ($errors->any())
                <div class="bg-rose-50 text-rose-800 text-sm p-4 rounded-xl mb-4 border border-rose-100">
                    <ul class="space-y-0.5 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1.5">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus
                        autocomplete="username"
                        placeholder="kamu@email.com"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150
                               @error('email') border-rose-400 focus:ring-rose-400 @enderror"
                    >
                    @error('email')
                        <p class="text-rose-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-cyan-600 font-bold hover:text-cyan-700 hover:underline">Lupa password?</a>
                        @endif
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150
                               @error('password') border-rose-400 focus:ring-rose-400 @enderror"
                    >
                    @error('password')
                        <p class="text-rose-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Checkbox Remember Me --}}
                <div class="flex items-center gap-2 pt-1">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500 bg-slate-50"
                    >
                    <label for="remember_me" class="text-sm text-gray-500 font-medium cursor-pointer select-none">Ingat saya</label>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150 mt-2">
                    Masuk
                </button>
            </form>

            {{-- Navigasi ke Register --}}
            @if (Route::has('register'))
                <p class="text-center text-sm text-gray-500 mt-6 font-medium">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-cyan-600 font-bold hover:text-cyan-700 hover:underline">Daftar sekarang</a>
                </p>
            @endif

        </div>
    </div>
</x-guest-layout>