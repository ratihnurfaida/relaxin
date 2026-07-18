<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight">
            Detail Hotel: {{ $hotel->nama }}
        </h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    {{-- Background Utama Soft Cyan --}}
    <div class="py-14 min-h-screen" style="background-color: #F0F9FA; font-family: 'Inter', sans-serif;">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ===== KOP SURAT HOTEL ===== --}}
            <div class="rounded-sm p-8 md:p-10 mb-10" style="background-color: #FAFFFF; border: 1px solid #CCE7E9;">
                <h1 class="text-4xl md:text-5xl leading-none mb-4" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">
                    {{ $hotel->nama }}
                </h1>

                <p class="text-sm font-medium flex items-start gap-2 mb-5" style="color: #4B6F77;">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#0E7490" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $hotel->alamat }}, {{ $hotel->kota }}</span>
                </p>

                <div class="pt-5" style="border-top: 1px dashed #CCE7E9;">
                    <p class="leading-relaxed text-[15px]" style="color: #4B6F77;">{{ $hotel->deskripsi }}</p>
                </div>
            </div>

            {{-- ===== DAFTAR KAMAR ===== --}}
            <div class="flex items-baseline justify-between mb-6 px-1">
                <h3 class="text-2xl" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">
                    Kamar Tersedia
                </h3>
                <span class="text-xs font-medium" style="color: #4B6F77;">{{ $hotel->kamar->count() }} tipe kamar</span>
            </div>

            <div class="space-y-5">
                @foreach($hotel->kamar as $item)
                    @php
                        $sisaKamar = $item->total_kamar - ($item->pesanan_terisi ?? 0);
                        $tersedia = $sisaKamar > 0;
                    @endphp

                    <div class="relative flex flex-col md:flex-row rounded-sm overflow-hidden transition-colors duration-200"
                         style="background-color: #FAFFFF; border: 1px solid #CCE7E9;"
                         onmouseover="this.style.borderColor='#0E7490'" onmouseout="this.style.borderColor='#CCE7E9'">

                        <div class="w-full md:w-56 h-48 md:h-auto flex-shrink-0" style="background-color: #E0F2F1;">
                            <img src="{{ asset('hotel/' . $item->gambar) }}" alt="{{ $item->tipe_kamar }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 p-6">
                            <h4 class="text-lg mb-3" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">
                                {{ $item->tipe_kamar }}
                            </h4>

                            <div class="flex flex-wrap gap-x-5 gap-y-1.5 mb-4 text-xs font-medium" style="color: #4B6F77;">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="#0E7490" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"></path>
                                    </svg>
                                    Kapasitas {{ $item->kapasitas }} orang
                                </span>
                                @if($item->tipe_bed ?? false)
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="#0E7490" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 18v-6a2 2 0 012-2h14a2 2 0 012 2v6M3 18h18M3 18v2M21 18v2M5 10V6a2 2 0 012-2h10a2 2 0 012 2v4"></path>
                                    </svg>
                                    {{ $item->tipe_bed }}
                                </span>
                                @endif
                            </div>

                            <p class="text-xs font-semibold flex items-center gap-1.5" style="color: {{ $tersedia ? '#0F766E' : '#9F1239' }};">
                                <span class="w-1.5 h-1.5 rounded-full inline-block" style="background-color: {{ $tersedia ? '#0F766E' : '#9F1239' }};"></span>
                                @if($tersedia)
                                    Tersisa <span style="font-family: 'IBM Plex Mono', monospace;">{{ $sisaKamar }}</span> kamar untuk tanggal ini
                                @else
                                    Kamar penuh untuk tanggal ini
                                @endif
                            </p>
                        </div>

                        <div class="hidden md:block relative w-0" style="border-left: 1.5px dashed #CCE7E9;">
                            <span class="absolute -top-2.5 -left-2.5 w-5 h-5 rounded-full" style="background-color: #F0F9FA;"></span>
                            <span class="absolute -bottom-2.5 -left-2.5 w-5 h-5 rounded-full" style="background-color: #F0F9FA;"></span>
                        </div>

                        <div class="w-full md:w-52 flex-shrink-0 p-6 flex flex-row md:flex-col items-center md:items-stretch justify-between gap-4"
                             style="background-color: #EBF7F8;">
                            <div class="text-left md:text-center">
                                <p class="text-[10px] font-semibold uppercase tracking-wider mb-1" style="color: #4B6F77;">Per malam</p>
                                <p class="text-xl font-bold leading-none" style="font-family: 'IBM Plex Mono', monospace; color: #155E75;">
                                    Rp{{ number_format($item->harga_per_kamar, 0, ',', '.') }}
                                </p>
                            </div>

                            @if($tersedia)
                                <a href="{{ route('booking.create', ['hotel_id' => $hotel->id_hotel, 'id_kamar' => $item->id_kamar]) }}"
                                   class="text-center text-white text-xs font-semibold px-5 py-3 rounded-sm transition-colors duration-150 whitespace-nowrap"
                                   style="background-color: #0E7490;"
                                   onmouseover="this.style.backgroundColor='#08576d'" onmouseout="this.style.backgroundColor='#0E7490'">
                                    Pesan Kamar
                                </a>
                            @else
                                <button class="text-center text-xs font-semibold px-5 py-3 rounded-sm cursor-not-allowed whitespace-nowrap" style="background-color: #D1E5E7; color: #6B7280;" disabled>
                                    Habis Terjual
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>