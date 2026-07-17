<x-app-layout>

{{-- ===== HERO SECTION ===== --}}
<div class="min-h-screen" style="background-color: #F0F9FA; font-family: 'Inter', sans-serif;">
    <section class="relative px-6 md:px-12 pt-16 pb-20 text-right bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('storage/foto/gdsate.png') }}');">
        {{-- Overlay gelap di sisi kanan (tempat teks) supaya foto tetap terlihat jelas di sisi kiri --}}
        <div class="absolute inset-0 bg-gradient-to-l from-black/75 via-black/45 to-black/10 z-0"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10 z-0"></div>

        <div class="relative z-10 max-w-xl ml-auto text-right">

            <h1 class="text-4xl md:text-6xl leading-tight mb-4 font-fraunces" style="font-weight: 600; color: #F0F9FA;">
                Temukan Hotel Terbaik di <span class="text-cyan-300">Bandung</span>
            </h1>
            <p class="text-lg md:text-xl text-white/90 mb-10 font-medium">
                Booking hotel favoritmu dengan harga terbaik, mudah, cepat, dan aman hanya di RelaXin.
            </p>

            {{-- FITUR SINGKAT --}}
            <div class="flex flex-nowrap items-center justify-end gap-x-8 gap-y-4 mb-10">
                @foreach([
                    ['title' => 'Harga Terbaik', 'desc' => 'Jaminan harga termurah', 'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                    ['title' => 'Booking Instan', 'desc' => 'Konfirmasi dalam hitungan detik', 'icon' => 'm3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z'],
                    ['title' => 'Aman & Terpercaya', 'desc' => 'Transaksi aman dan terpercaya', 'icon' => 'M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Zm-9-9v9l6 3'],
                ] as $feat)
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-white/15 border border-white/25 flex items-center justify-center flex-shrink-0 backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#A5F3FC" stroke-width="2" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feat['icon'] }}" />
                            </svg>
                        </span>
                        <div class="text-right">
                            <div class="text-white font-bold text-sm">{{ $feat['title'] }}</div>
                            <div class="text-white/70 text-xs font-medium">{{ $feat['desc'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- FILTER & SEARCH FORM (tetap di tengah) --}}
        <form action="{{ route('hotel.index') }}" method="GET"
      class="relative z-10 bg-white p-2 rounded-full border border-slate-100 shadow-2xl shadow-slate-300/40 w-full max-w-5xl mx-auto">
    <div class="flex flex-wrap md:flex-nowrap items-center w-full">

        {{-- Area --}}
        <div class="flex flex-col items-start flex-1 min-w-[140px] px-5 py-2 text-left">
            <label class="block w-full text-[11px] font-semibold text-slate-400 uppercase tracking-wide mb-0.5 text-left">
                Area
            </label>
            <select name="area"
                    class="w-full bg-transparent text-sm font-semibold text-slate-800 outline-none cursor-pointer text-left -ml-0.5">
                <option value="">Semua Area</option>
                @foreach(['Dago','Pasteur','Lembang','Buah Batu','Braga'] as $area)
                    <option value="{{ $area }}" {{ request('area') == $area ? 'selected' : '' }}>{{ $area }}</option>
                @endforeach
            </select>
        </div>

        <span class="hidden md:block h-9 w-px bg-slate-200"></span>

        {{-- Bintang --}}
        <div class="flex flex-col items-start flex-1 min-w-[140px] px-5 py-2 text-left">
            <label class="block w-full text-[11px] font-semibold text-slate-400 uppercase tracking-wide mb-0.5 text-left">
                Bintang
            </label>
            <select name="bintang"
                    class="w-full bg-transparent text-sm font-semibold text-slate-800 outline-none cursor-pointer text-left -ml-0.5">
                <option value="">Semua Bintang</option>
                @foreach([1,2,3,4,5] as $b)
                    <option value="{{ $b }}" {{ request('bintang') == $b ? 'selected' : '' }}>Bintang {{ $b }}</option>
                @endforeach
            </select>
        </div>

        <span class="hidden md:block h-9 w-px bg-slate-200"></span>

        {{-- Check-In --}}
        <div class="flex flex-col items-start flex-1 min-w-[150px] px-5 py-2 text-left">
            <label class="block w-full text-[11px] font-semibold text-slate-400 uppercase tracking-wide mb-0.5 text-left">
                Check-In
            </label>
            <input type="date" name="checkin" value="{{ request('checkin') }}"
                   class="w-full bg-transparent text-sm font-semibold text-slate-800 outline-none cursor-pointer text-left">
        </div>

        <span class="hidden md:block h-9 w-px bg-slate-200"></span>

        {{-- Check-Out --}}
        <div class="flex flex-col items-start flex-1 min-w-[150px] px-5 py-2 text-left">
            <label class="block w-full text-[11px] font-semibold text-slate-400 uppercase tracking-wide mb-0.5 text-left">
                Check-Out
            </label>
            <input type="date" name="checkout" value="{{ request('checkout') }}"
                   class="w-full bg-transparent text-sm font-semibold text-slate-800 outline-none cursor-pointer text-left">
        </div>

        {{-- Tombol Cari --}}
        <div class="w-full md:w-auto px-2 py-1.5 md:pl-3">
            <button type="submit"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-bold px-7 py-3.5 rounded-full transition-all shadow-lg shadow-cyan-600/30 active:scale-95 duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                Cari
            </button>
        </div>
    </div>

    {{-- Reset --}}
    @if(request()->anyFilled(['area','bintang','checkin','checkout']))
        <div class="text-center md:text-right md:absolute md:-bottom-7 md:right-2 mt-2 md:mt-0">
            <a href="{{ route('hotel.index') }}"
               class="text-xs text-slate-400 hover:text-cyan-600 transition-colors font-semibold">
                Reset filter
            </a>
        </div>
    @endif
</form>
    </section>

    {{-- ===== DESTINASI POPULER ===== --}}
    <section id="destinasi" class="px-6 md:px-12 pt-16 pb-16">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest mb-1 font-mono-plex" style="color: #0E7490;">Destinasi Populer</p>
                    <h2 class="text-3xl leading-tight font-fraunces" style="font-weight: 600; color: #155E75;">Jelajahi Area Terbaik di Bandung</h2>
                </div>
                <a href="{{ route('hotel.index') }}" class="text-base font-bold hover:text-cyan-700 transition-colors" style="color: #0E7490;">
                    Lihat semua →
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @php
                    $areaMeta = [
                        'Asia Afrika' => ['foto' => 'asia-afrika.jpeg'],
                        'Braga'       => ['foto' => 'braga1.jpeg'],
                        'Dago'        => ['foto' => 'dago.jpeg'],
                        'Lembang'     => ['foto' => 'lembang.jpeg'],
                        'Pasteur'     => ['foto' => 'pasteur.jpeg'],
                        'Buah Batu'   => ['foto' => 'bg.jpeg'],
                    ];
                    @endphp

                    @foreach($areas as $area)

                    @php
                        $meta = $areaMeta[$area->nama] ?? ['foto' => 'default-area.jpeg'];
                    @endphp
                    <a href="{{ route('hotel.index', ['area' => $area->nama]) }}"
                       class="group relative rounded-2xl overflow-hidden h-56 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-200 bg-cyan-800">
                        <img
                            src="{{ asset('storage/foto/' . $meta['foto']) }}"
                            alt="{{ $area->nama }}"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="font-bold text-lg font-fraunces">{{ $area->nama }}</div>
                            <div class="text-sm text-cyan-200 font-semibold">{{ $area->hotels_count }} Hotel</div>
                        </div>
                        <div class="absolute bottom-4 right-4 w-8 h-8 rounded-full bg-white/90 flex items-center justify-center text-cyan-700 group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== HOTEL REKOMENDASI ===== --}}
    <section id="hotel" class="px-6 md:px-12 py-16 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest mb-1 font-mono-plex" style="color: #0E7490;">Rekomendasi</p>
                    <h2 class="text-3xl leading-tight font-fraunces" style="font-weight: 600; color: #155E75;">Hotel Pilihan untuk Anda</h2>
                </div>
                <a href="{{ route('hotel.index') }}" class="text-base font-bold hover:text-cyan-700 transition-colors" style="color: #0E7490;">
                    Lihat semua hotel →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($hotels) && $hotels->count() > 0)
                    @foreach($hotels as $hotel)
                        <div style="background-color: #ecfbfc;" class="rounded-2xl overflow-hidden border border-cyan-200 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                            <div class="bg-slate-100 h-44 overflow-hidden relative">
                                <img src="{{ $hotel->gambar ? asset('storage/hotel/' . $hotel->gambar) : asset('storage/hotel/hotelaston.jpg') }}" class="w-full h-full object-cover">

                                <button type="button" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 flex items-center justify-center text-gray-400 hover:text-rose-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>

                                <div class="absolute bottom-3 left-3 flex items-center gap-1 bg-black/60 backdrop-blur-sm text-white text-xs font-bold px-2.5 py-1 rounded-full">
                                    <span class="text-yellow-400">★</span>
                                    {{ number_format($hotel->star_rating ?? 4.5, 1) }}
                                </div>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg mb-1.5 hover:text-cyan-600 transition-colors font-fraunces" style="font-weight: 600; color: #155E75;">{{ $hotel->nama }}</h3>
                                    <div class="flex items-center gap-1 text-sm text-gray-500 font-medium mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        {{ $hotel->area->nama ?? 'Bandung' }}, Bandung
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-3 border-t border-cyan-200/60">
                                    <div>
                                        <p class="text-[11px] uppercase font-bold tracking-wider text-gray-400">Mulai dari</p>
                                        <p class="font-bold text-lg font-mono-plex" style="color: #0E7490;">Rp{{ number_format($hotel->harga,0,',','.') }}</p>
                                    </div>
                                    <a href="{{ route('hotel.show', ['id' => $hotel->id_hotel]) }}"
                                       class="bg-gradient-to-r from-cyan-600 to-cyan-500 text-white font-bold text-sm px-4 py-2 rounded-xl hover:from-cyan-700 hover:to-cyan-600 transition-colors shadow-md shadow-cyan-600/10">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="col-span-4 text-center text-gray-500 py-10">Belum ada data hotel populer saat ini.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- ===== KENAPA RELAXIN ===== --}}
    <section id="tentang" class="px-6 md:px-12 py-16 bg-slate-50 border-t border-b border-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <p class="text-sm font-bold uppercase tracking-widest mb-1 font-mono-plex" style="color: #0E7490;">Kenapa Memilih RelaXin?</p>
                <h2 class="text-3xl leading-tight font-fraunces" style="font-weight: 600; color: #155E75;">Lebih Mudah, Lebih Nyaman</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['title' => 'Harga Terbaik', 'desc' => 'Kami jamin harga termurah dibandingkan platform lain.', 'icon' => 'M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z'],
                    ['title' => 'Booking Cepat', 'desc' => 'Proses booking cepat dan konfirmasi instan.', 'icon' => 'm3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z'],
                    ['title' => 'Aman & Terpercaya', 'desc' => 'Transaksi aman, data terjaga, dan terpercaya.', 'icon' => 'M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Zm-9-9v9l6 3'],
                    ['title' => 'Customer Support 24/7', 'desc' => 'Tim kami siap membantu kapan pun Anda butuhkan.', 'icon' => 'M8.25 15.75c1.5.5 2.25 1.5 3.75 1.5s2.25-1 3.75-1.5m-9-3.75h.008v.008H6.75v-.008Zm10.5 0h.008v.008h-.008v-.008Zm-8.25 0a8.25 8.25 0 1 1 8.25 8.25 8.25 8.25 0 0 1-8.25-8.25Z'],
                ] as $why)
                    <div class="bg-white border border-cyan-200 rounded-2xl p-6 hover:shadow-xl hover:border-cyan-400 hover:-translate-y-1 transition-all duration-200">
                        <div class="w-12 h-12 bg-cyan-600 rounded-xl flex items-center justify-center mb-4 shadow-sm shadow-cyan-600/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $why['icon'] }}" />
                            </svg>
                        </div>
                        <h4 class="mb-2 text-lg font-fraunces" style="font-weight: 600; color: #155E75;">{{ $why['title'] }}</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $why['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CARA BOOKING ===== --}}
    <section id="cara-booking" class="px-6 md:px-12 py-16 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12">
                <p class="text-sm font-bold uppercase tracking-widest mb-1 font-mono-plex" style="color: #0E7490;">Cara Booking</p>
                <h2 class="text-3xl leading-tight font-fraunces" style="font-weight: 600; color: #155E75;">Booking dalam 3 Langkah</h2>
            </div>

            <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-10 md:gap-4">
                @foreach([
                    ['step' => 1, 'title' => 'Cari Hotel', 'desc' => 'Cari hotel sesuai lokasi, tanggal, dan kebutuhanmu.', 'icon' => 'm21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z'],
                    ['step' => 2, 'title' => 'Pilih Kamar', 'desc' => 'Pilih kamar favorit dan lakukan pemesanan.', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5'],
                    ['step' => 3, 'title' => 'Konfirmasi Booking', 'desc' => 'Dapatkan konfirmasi instan dan siap untuk menginap.', 'icon' => 'm4.5 12.75 6 6 9-13.5'],
                ] as $step)
                    <div class="flex flex-col items-center text-center px-2 flex-1 max-w-[220px]">
                        <div class="relative mb-4">
                            <div class="w-20 h-20 rounded-full bg-white border-2 border-dashed border-cyan-300 flex items-center justify-center shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="2" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                                </svg>
                            </div>
                            <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-7 h-7 rounded-full bg-cyan-600 text-white text-sm font-bold flex items-center justify-center font-mono-plex shadow">
                                {{ $step['step'] }}
                            </span>
                        </div>
                        <h4 class="text-base font-bold mb-1 mt-2" style="color: #155E75;">{{ $step['title'] }}</h4>
                        <p class="text-gray-500 text-sm">{{ $step['desc'] }}</p>
                    </div>

                    @if(!$loop->last)
                        <div class="hidden md:flex items-center justify-center flex-shrink-0 mt-8">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#A5D8E0" stroke-width="2" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0-4 4m4-4H3" />
                            </svg>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== ULASAN ===== --}}
    <section id="ulasan" class="px-6 md:px-12 py-16 bg-slate-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest mb-1 font-mono-plex" style="color: #0E7490;">Apa Kata Mereka?</p>
                    <h2 class="text-3xl leading-tight font-fraunces" style="font-weight: 600; color: #155E75;">Ulasan dari Tamu Kami</h2>
                </div>
                <a href="#" class="text-base font-bold hover:text-cyan-700 transition-colors" style="color: #0E7490;">
                    Lihat semua ulasan →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['name' => 'Rina Kartika', 'city' => 'Bandung', 'text' => 'Booking di RelaXin sangat mudah dan cepat. Harganya juga lebih murah dibanding aplikasi lain. Pasti akan booking lagi!'],
                    ['name' => 'Dimas Pratama', 'city' => 'Jakarta', 'text' => 'Hotel yang saya pesan sesuai ekspektasi, pelayanannya bagus dan lokasinya strategis.'],
                    ['name' => 'Siti Nurhaliza', 'city' => 'Jakarta', 'text' => 'Promo di RelaXin paling sering dan paling worth it! Recommended banget.'],
                ] as $review)
                    <div class="bg-white border border-cyan-100 rounded-2xl p-6 shadow-sm">
                        <div class="text-yellow-400 text-lg mb-3 tracking-wide">★★★★★</div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">"{{ $review['text'] }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-700 font-bold flex items-center justify-center flex-shrink-0 font-mono-plex">
                                {{ collect(explode(' ', $review['name']))->map(fn($n) => $n[0])->join('') }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-gray-800">{{ $review['name'] }}</div>
                                <div class="text-xs text-gray-400 font-medium">{{ $review['city'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
</x-app-layout>