<x-app-layout>
    @slot('title', 'Booking Berhasil')

    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-xl shadow-cyan-100/50 border border-slate-100 text-center max-w-lg w-full">
            
            {{-- Icon Success (Soft Cyan) --}}
            <div class="w-20 h-20 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-extrabold text-slate-900 mb-3 tracking-tight">Booking Berhasil!</h1>
            <p class="text-slate-500 text-sm mb-10 leading-relaxed">
                Terima kasih, pesanan hotel kamu di <span class="text-cyan-600 font-semibold">RelaXin</span> sudah kami terima dan sedang diproses oleh tim kami.
            </p>
    
            <a href="/" class="block w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-6 rounded-lg transition-all active:scale-[0.98] shadow-lg shadow-cyan-600/20">
                Kembali ke Beranda
            </a>
            
        </div>
    </div>
</x-app-layout>