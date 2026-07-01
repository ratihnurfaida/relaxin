<x-app-layout>

{{-- ===== HERO ABOUT US (Inspirasi: image_16e5e5.jpg) ===== --}}
<section class="relative px-12 pt-32 pb-28 text-left bg-cover bg-center bg-no-repeat rounded-b-[40px] overflow-hidden" 
         style="background-image: url('{{ asset('storage/foto/bg.jpeg') }}');">
    <!-- Overlay gradasi gelap lembut -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30 z-0"></div>

    <div class="max-w-7xl mx-auto relative z-10 text-white">
        <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest bg-cyan-400/10 px-4 py-1.5 rounded-full backdrop-blur-sm border border-cyan-400/20">
            Tentang RelaXin
        </span>
        <h1 class="text-3xl md:text-5xl font-black mt-6 mb-4 max-w-2xl leading-tight">
            Platform Pemesanan Hotel<br>Terdepan di Kota Bandung
        </h1>
        <p class="text-cyan-100/90 text-base md:text-lg max-w-xl leading-relaxed">
            Kami membantu para pencinta perjalanan menemukan akomodasi terbaik di Bandung secara cepat, mudah, dan transparan.
        </p>
    </div>
</section>

{{-- ===== PENGENALAN PRODUK (Inspirasi: image_16e5de.jpg) ===== --}}
<section class="px-12 py-20 bg-white">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Kolom Foto Kiri -->
        <div class="relative">
            <div class="absolute -inset-2 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl blur opacity-20"></div>
            <div class="relative bg-slate-100 rounded-2xl overflow-hidden shadow-xl aspect-[4/3]">
                <!-- Ganti source gambar dengan foto suasana Bandung/Hotel Aston -->
                <img src="{{ asset('storage/hotel/hotelaston.jpg') }}" alt="Suasana Bandung" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Kolom Deskripsi Kanan -->
        <div class="space-y-6">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 leading-tight">
                Menyediakan Kemudahan Eksklusif untuk Jelajahi Keindahan Kota Kembang
            </h2>
            <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                <span class="font-bold text-cyan-600">RelaXin</span> adalah platform digital khusus pemesanan akomodasi yang berfokus penuh pada wilayah Bandung dan sekitarnya. Kami memahami bahwa setiap perjalanan membutuhkan tempat istirahat yang tepat mulai dari hotel budget, apartemen strategis, resort sejuk di Lembang, hingga hotel berbintang premium di pusat kota.
            </p>
            <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                Melalui simplifikasi sistem pencarian dan komitmen harga yang jujur tanpa biaya tersembunyi, RelaXin terus melangkah maju untuk memastikan liburan maupun urusan bisnis Anda di Bandung berjalan dengan kenyamanan maksimal.
            </p>
        </div>
    </div>
</section>

{{-- ===== STATISTIK / PRODUK KAMI (Inspirasi: image_16e5bd.jpg) ===== --}}
<section class="px-12 py-20 bg-slate-50 border-t border-b border-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-2">Layanan & Ekosistem</p>
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800">Pertumbuhan RelaXin dalam Angka</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Card 1: Mitra Akomodasi -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-blue-50 border border-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 16.5h1.5m3 0H15" />
                    </svg>
                </div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Mitra Akomodasi</h4>
                <div class="text-2xl md:text-3xl font-black text-gray-800 mb-2">500+</div>
                <p class="text-gray-500 text-xs leading-relaxed">Hotel pilihan, resort, villa, dan apartemen di seluruh penjuru Bandung.</p>
            </div>

            <!-- Card 2: Pengguna Aktif -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-teal-50 border border-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pengguna Aktif</h4>
                <div class="text-2xl md:text-3xl font-black text-gray-800 mb-2">15K+</div>
                <p class="text-gray-500 text-xs leading-relaxed">Wisatawan lokal maupun interlokal yang memercayakan staycation mereka.</p>
            </div>

            <!-- Card 3: Wilayah Area -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-amber-50 border border-amber-100 rounded-xl flex items-center justify-center text-amber-600 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8m-6-3h.008v.008H9V12Zm6 3h.008v.008H15V15Zm0-6h.008v.008H15V9Zm-6 0h.008v.008H9V9ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Cakupan Destinasi</h4>
                <div class="text-2xl md:text-3xl font-black text-gray-800 mb-2">15+ Area</div>
                <p class="text-gray-500 text-xs leading-relaxed">Mulai dari pusat Braga, heritages Dago, hingga pegunungan sejuk Lembang.</p>
            </div>

            <!-- Card 4: Transaksi Berhasil -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-rose-50 border border-rose-100 rounded-xl flex items-center justify-center text-rose-600 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Keamanan Transparan</h4>
                <div class="text-2xl md:text-3xl font-black text-gray-800 mb-2">100% Aman</div>
                <p class="text-gray-500 text-xs leading-relaxed">Seluruh proses pembayaran diverifikasi secara otomatis dan instan.</p>
            </div>
        </div>
    </div>
</section>

</x-app-layout>