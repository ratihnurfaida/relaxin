<x-guest-layout>
    <div style="font-family: 'Inter', sans-serif;">
        <div class="w-full bg-white border border-cyan-100 rounded-2xl p-8 shadow-xl shadow-cyan-600/10">

            {{-- Judul Form --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl mb-0.5" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Konfirmasi Password</h1>
                <p class="text-gray-500 text-base">Ini adalah area rahasia. Masukkan password kamu untuk melanjutkan.</p>
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

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-base font-bold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autofocus
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 pr-11 text-base text-gray-800
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                                   placeholder-gray-400 transition duration-150
                                   @error('password') border-rose-400 focus:ring-rose-400 @enderror"
                        >
                        <button type="button"
                                onclick="const i=document.getElementById('password'); const showing=i.type==='text'; i.type= showing ? 'password' : 'text'; this.querySelector('.icon-eye').classList.toggle('hidden', !showing); this.querySelector('.icon-eye-off').classList.toggle('hidden', showing);"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-cyan-600 transition-colors"
                                aria-label="Tampilkan atau sembunyikan password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-eye w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-eye-off w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5a10.45 10.45 0 004.293-.909m3.664-2.043A10.523 10.523 0 0022.066 12c-1.292-4.338-5.31-7.5-10.066-7.5a10.5 10.5 0 00-1.875.175M2.25 2.25l19.5 19.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 104.24 4.24" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-base py-3 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150 mt-2">
                    Konfirmasi
                </button>
            </form>

        </div>
    </div>
</x-guest-layout>