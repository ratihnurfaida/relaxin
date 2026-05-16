@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ===== HERO ===== --}}
<section class="bg-[#1a3a2a] px-12 py-16 text-center">

    {{-- Badge --}}
    <div class="inline-flex items-center gap-2 bg-green-400/10 border border-green-400/30
                text-green-400 text-xs font-bold px-4 py-1.5 rounded-full mb-6">
        🏨 Khusus Hotel Bandung
    </div>

    {{-- Judul --}}
    <h1 class="text-5xl font-extrabold text-white leading-tight mb-3">
        Temukan Hotel Terbaik<br>
        di <span class="text-green-400">Bandung</span>, Mudah & Cepat
    </h1>
    <p class="text-green-100/70 text-base mb-10">
        Dari budget hingga bintang lima — semua hotel Bandung ada di sini
    </p>

    {{-- SEARCH BOX --}}
    <form action="{{ route('hotel.search') }}" method="GET">
        <div class="bg-white rounded-2xl px-7 py-5 max-w-2xl mx-auto shadow-2xl
                    flex items-center gap-4 flex-wrap md:flex-nowrap">

            <div class="flex flex-col flex-1 min-w-[120px]">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Tujuan</label>
                <input type="text" name="destination" value="Bandung, Jawa Barat"
                       class="text-sm font-bold text-gray-800 outline-none border-none bg-transparent w-full" readonly>
            </div>

            <div class="w-px h-10 bg-gray-200 hidden md:block"></div>

            <div class="flex flex-col flex-1 min-w-[120px]">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Check-in</label>
                <input type="date" name="checkin" value="{{ now()->format('Y-m-d') }}"
                       class="text-sm font-bold text-gray-800 outline-none border-none bg-transparent w-full">
            </div>

            <div class="w-px h-10 bg-gray-200 hidden md:block"></div>

            <div class="flex flex-col flex-1 min-w-[120px]">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Check-out</label>
                <input type="date" name="checkout" value="{{ now()->addDays(2)->format('Y-m-d') }}"
                       class="text-sm font-bold text-gray-800 outline-none border-none bg-transparent w-full">
            </div>

            <button type="submit"
                    class="bg-gray-900 text-white font-bold text-sm px-7 py-3.5 rounded-xl
                           hover:bg-[#2d5a3d] transition-colors whitespace-nowrap">
                Cari Hotel
            </button>
        </div>
    </form>
</section>

{{-- ===== PROMO BANNER ===== --}}
<div class="px-12 mt-10">
    <div class="bg-gradient-to-r from-emerald-100 to-green-200 rounded-2xl px-8 py-7
                flex items-center justify-between gap-6 flex-wrap">
        <div>
            <div class="inline-flex items-center gap-1.5 bg-emerald-500 text-white
                        text-xs font-bold px-3 py-1 rounded-full mb-3">
                🔥 Promo Akhir Pekan
            </div>
            <h3 class="text-lg font-extrabold text-emerald-900 mb-1">Weekend Getaway di Bandung</h3>
            <p class="text-sm text-emerald-800">
                Pesan hotel bintang 3 mulai <strong class="text-emerald-700">Rp 299.000/malam</strong>
                — berlaku Jumat s/d Minggu
            </p>
        </div>
        <a href="#"
           class="bg-gray-900 text-white font-bold text-sm px-6 py-3 rounded-xl
                  hover:bg-[#2d5a3d] transition-colors whitespace-nowrap">
            Lihat Promo
        </a>
    </div>
</div>

{{-- ===== HOTEL POPULER ===== --}}
<section class="px-12 mt-12">
    <div class="flex items-end justify-between mb-6">
        <div>
            <p class="text-xs font-bold text-green-400 uppercase tracking-widest mb-1">Rekomendasi</p>
            <h2 class="text-2xl font-extrabold text-white">Hotel Populer Minggu Ini</h2>
        </div>
        <a href="{{ route('hotel.index') }}" class="text-green-400 text-sm font-semibold hover:opacity-70 transition-opacity">
            Lihat semua →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @php
            $bgColors = ['bg-green-100', 'bg-blue-100', 'bg-orange-100'];
        @endphp

        @forelse($popularHotels ?? [] as $i => $hotel)
            <x-hotel-card :hotel="$hotel" :bgColor="$bgColors[$i % 3]" />
        @empty
            {{-- Placeholder data dummy --}}
            @foreach([
                ['name'=>'Aston Pasteur Bandung','area'=>'Pasteur','rating'=>4.5,'reviews'=>128,'facilities'=>'WiFi,Parkir,Gym,AC,Kolam','price'=>699000,'bg'=>'bg-green-100'],
                ['name'=>'Clove Garden Hotel','area'=>'Dago','rating'=>4.2,'reviews'=>96,'facilities'=>'WiFi,Parkir,Gym,AC,Bar','price'=>400000,'bg'=>'bg-blue-100'],
                ['name'=>'Grand Lembang Resort','area'=>'Lembang','rating'=>4.7,'reviews'=>214,'facilities'=>'WiFi,Kolam,Spa,Restoran','price'=>850000,'bg'=>'bg-orange-100'],
            ] as $dummy)
                <div class="bg-gray-800 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">
                    <div class="{{ $dummy['bg'] }} h-40 flex items-center justify-center text-5xl">🏨</div>
                    <div class="p-4">
                        <div class="text-green-400 text-xs font-semibold mb-1">📍 {{ $dummy['area'] }}</div>
                        <h3 class="text-white font-bold text-base mb-2">{{ $dummy['name'] }}</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-yellow-400 text-sm">★★★★☆</span>
                            <span class="text-white text-sm font-bold">{{ $dummy['rating'] }}</span>
                            <span class="text-gray-500 text-xs">({{ $dummy['reviews'] }} ulasan)</span>
                        </div>
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(explode(',', $dummy['facilities']) as $f)
                                <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-md">{{ $f }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-green-400 font-extrabold text-base">Rp {{ number_format($dummy['price'],0,',','.') }}</p>
                                <p class="text-xs text-gray-500">/malam</p>
                            </div>
                            <a href="#" class="bg-white text-gray-900 font-bold text-sm px-5 py-2 rounded-lg hover:bg-green-400 transition-colors">Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforelse
    </div>
</section>

{{-- ===== CARI BERDASARKAN AREA ===== --}}
<section class="px-12 mt-12">
    <div class="mb-6">
        <p class="text-xs font-bold text-green-400 uppercase tracking-widest mb-1">Jelajahi</p>
        <h2 class="text-2xl font-extrabold text-white">Cari berdasarkan area</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        @foreach([
            ['name'=>'Dago',      'count'=>32,'icon'=>'🌿'],
            ['name'=>'Pasteur',   'count'=>18,'icon'=>'🏙️'],
            ['name'=>'Lembang',   'count'=>24,'icon'=>'⛰️'],
            ['name'=>'Buah Batu', 'count'=>15,'icon'=>'🏡'],
            ['name'=>'Braga',     'count'=>11,'icon'=>'🎨'],
        ] as $area)
            <a href="{{ route('hotel.search', ['area' => $area['name']]) }}"
               class="bg-gray-800 rounded-xl p-4 flex items-center gap-3
                      hover:bg-gray-700 hover:-translate-y-0.5 transition-all duration-150 cursor-pointer">
                <div class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                    {{ $area['icon'] }}
                </div>
                <div>
                    <div class="text-white text-sm font-bold">{{ $area['name'] }}</div>
                    <div class="text-gray-500 text-xs">{{ $area['count'] }} hotel</div>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- ===== KENAPA RELAXIN ===== --}}
<section class="px-12 mt-12 pb-16">
    <div class="mb-6">
        <p class="text-xs font-bold text-green-400 uppercase tracking-widest mb-1">Kenapa RelaXin?</p>
        <h2 class="text-2xl font-extrabold text-white">Lebih fokus, lebih mudah</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach([
            ['icon'=>'📍','title'=>'Khusus Bandung',    'desc'=>'Semua hotel yang tampil memang ada di Bandung — tidak perlu filter ulang.'],
            ['icon'=>'⚡','title'=>'Pesan cepat',        'desc'=>'Pilih hotel, tentukan tanggal, konfirmasi — selesai dalam hitungan menit.'],
            ['icon'=>'⭐','title'=>'Ulasan terpercaya',  'desc'=>'Rating dan ulasan dari tamu yang benar-benar sudah menginap.'],
            ['icon'=>'💰','title'=>'Harga transparan',   'desc'=>'Harga yang tampil sudah termasuk pajak, tanpa biaya tersembunyi.'],
        ] as $why)
            <div class="bg-gray-800 rounded-2xl p-6">
                <div class="w-11 h-11 bg-gray-700 rounded-xl flex items-center justify-center text-2xl mb-4">
                    {{ $why['icon'] }}
                </div>
                <h4 class="text-white font-bold text-base mb-2">{{ $why['title'] }}</h4>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $why['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

@endsection