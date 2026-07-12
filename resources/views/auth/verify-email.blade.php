<x-guest-layout>
    <div style="font-family: 'Inter', sans-serif;">
        <div class="w-full bg-white border border-cyan-100 rounded-2xl p-8 shadow-xl shadow-cyan-600/10">

            {{-- Judul Form --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl mb-0.5" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Verifikasi Email</h1>
                <p class="text-gray-500 text-base leading-relaxed">
                    Terima kasih sudah mendaftar! Sebelum mulai, mohon verifikasi email kamu dengan mengklik link yang baru saja kami kirim. Tidak menerima email?
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="rounded-xl px-4 py-3 mb-4 text-base font-medium" style="background-color: #ECFDF5; color: #047857; border: 1px solid #A7F3D0;">
                    Link verifikasi baru telah dikirim ke alamat email yang kamu daftarkan.
                </div>
            @endif

            <div class="flex flex-col gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-base py-3 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-base font-semibold text-gray-500 hover:text-cyan-700 hover:underline py-2">
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>