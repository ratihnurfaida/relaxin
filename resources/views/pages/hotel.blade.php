<x-app-layout>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

{{-- ===== SECTION DAFTAR HASIL HOTEL ===== --}}
<section class="px-12 py-12 bg-slate-50" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-7xl mx-auto">

        {{-- Teks Info Pencarian --}}
        <p class="text-base text-gray-500 mb-6">
            Menampilkan <span class="text-gray-800 font-bold font-mono-plex">{{ $totalHotels ?? count($hotels ?? []) }}</span> hotel
            @if(request('search')) untuk "<span class="font-semibold" style="color: #0E7490;">{{ request('search') }}</span>" @endif
            @if(request('area')) di area <span class="font-semibold" style="color: #0E7490;">{{ request('area') }}</span> @endif
        </p>

        {{-- Grid Kartu Hotel (sama seperti kartu di halaman Beranda) --}}
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
                                {{ number_format($hotel->rating ?? $hotel->bintang ?? 4.5, 1) }}
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
                                    <p class="font-bold text-lg font-mono-plex" style="color: #0E7490;">Rp{{ number_format($hotel->hotel_rooms_min_price ?? $hotel->harga ?? 0,0,',','.') }}</p>
                                </div>
                                <a href="{{ route('hotel.show', ['id' => $hotel->id_hotel, 'checkin' => request('checkin'), 'checkout' => request('checkout')]) }}"
                                   class="bg-gradient-to-r from-cyan-600 to-cyan-500 text-white font-bold text-sm px-4 py-2 rounded-xl hover:from-cyan-700 hover:to-cyan-600 transition-colors shadow-md shadow-cyan-600/10">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-1 md:col-span-2 lg:col-span-4 text-center py-20 bg-white border border-slate-100 rounded-3xl shadow-sm">
                    <span class="text-5xl">🏨</span>
                    <p class="text-gray-400 text-base mt-3 font-medium">Tidak ada data hotel yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </div>
</section>

</x-app-layout>