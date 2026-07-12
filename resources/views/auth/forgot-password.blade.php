<x-guest-layout>
    <div style="font-family: 'Inter', sans-serif;">
        <div class="w-full bg-white border border-cyan-100 rounded-2xl p-8 shadow-xl shadow-cyan-600/10">

            {{-- Judul Form --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl mb-0.5" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Lupa Password?</h1>
                <p class="text-gray-500 text-base">Tidak masalah. Masukkan email kamu, kami kirim link reset password.</p>
            </div>

            <x-auth-session-status class="mb-4 text-base font-medium" style="color: #0E7490;" :status="session('status')" />

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

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-base font-bold text-gray-700 mb-1.5">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus
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

                {{-- Tombol Submit --}}
                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-base py-3 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150 mt-2">
                    Kirim Link Reset Password
                </button>
            </form>

            <p class="text-center text-base text-gray-500 mt-6 font-medium">
                Sudah ingat password?
                <a href="{{ route('login') }}" class="font-bold hover:text-cyan-700 hover:underline" style="color: #0E7490;">Kembali ke Masuk</a>
            </p>

        </div>
    </div>
</x-guest-layout>