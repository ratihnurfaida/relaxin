<x-app-layout>
    @slot('title', 'Kebijakan Privasi')

    <div class="min-h-screen bg-slate-50 py-12 px-6">
        {{-- Container Utama yang lebih lebar --}}
        <div class="max-w-5xl mx-auto">
            
            {{-- Header Bagian --}}
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 11c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm0 4c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm0 4c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Kebijakan Privasi</h1>
                <p class="text-slate-500 max-w-xl mx-auto">
                    Halaman ini menjelaskan bagaimana <span class="text-cyan-600 font-semibold">RelaXin</span> mengumpulkan, menggunakan, dan melindungi informasi pribadi pengguna demi kenyamanan Anda.
                </p>
            </div>

            {{-- Grid Kartu --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Card 1 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800 mb-3">1. Pengumpulan Informasi</h3>
                    <p class="text-slate-600 leading-relaxed">Kami mengumpulkan informasi pribadi yang Anda berikan langsung saat reservasi, seperti nama lengkap, alamat email, nomor telepon, dan data identitas diri.</p>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800 mb-3">2. Penggunaan Data</h3>
                    <p class="text-slate-600 leading-relaxed">Informasi digunakan untuk memproses pemesanan hotel, pengelolaan akun pengguna, peningkatan layanan, serta mengirimkan notifikasi status reservasi Anda.</p>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800 mb-3">3. Keamanan Data</h3>
                    <p class="text-slate-600 leading-relaxed">Kami berkomitmen melindungi informasi pribadi Anda dengan standar keamanan terkini untuk mencegah akses tidak sah, perubahan, atau kebocoran data.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>