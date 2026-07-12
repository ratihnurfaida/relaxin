<x-guest-layout>
    <div style="font-family: 'Inter', sans-serif;">
        <div class="w-full bg-white border border-cyan-100 rounded-2xl p-8 shadow-xl shadow-cyan-600/10">

            {{-- Judul Form --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl mb-0.5" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Buat Akun Baru</h1>
                <p class="text-gray-500 text-base">Daftar dan mulai booking hotel impianmu</p>
            </div>

            {{-- Alert Error Validasi --}}
            @if ($errors->any())
                <div class="bg-rose-50 text-rose-800 text-base p-4 rounded-xl mb-4 border border-rose-100">
                    <ul class="space-y-0.5 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-base font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150
                               @error('nama') border-rose-400 focus:ring-rose-400 @enderror"
                    >
                    @error('nama')
                        <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-base font-bold text-gray-700 mb-1.5">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="kamu@email.com"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150
                               @error('email') border-rose-400 focus:ring-rose-400 @enderror"
                    >
                    @error('email')
                        <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label for="no_telepon" class="block text-base font-bold text-gray-700 mb-1.5">Nomor Telepon</label>
                    <input
                        id="no_telepon"
                        type="text"
                        name="no_telepon"
                        value="{{ old('no_telepon') }}"
                        placeholder="Contoh: 0812345678"
                        required
                        autocomplete="tel"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150
                               @error('no_telepon') border-rose-400 focus:ring-rose-400 @enderror"
                        style="font-family: 'IBM Plex Mono', monospace;"
                    >
                    @error('no_telepon')
                        <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-base font-bold text-gray-700 mb-1.5">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150
                               @error('password') border-rose-400 focus:ring-rose-400 @enderror"
                    >
                    @error('password')
                        <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-base font-bold text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150"
                    >
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-base py-3 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150 mt-2">
                    Daftar Sekarang
                </button>
            </form>

            {{-- Navigasi ke Login --}}
            <p class="text-center text-base text-gray-500 mt-6 font-medium">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold hover:text-cyan-700 hover:underline" style="color: #0E7490;">Masuk</a>
            </p>

        </div>
    </div>
</x-guest-layout>