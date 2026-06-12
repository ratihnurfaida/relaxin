<x-app-layout>

{{-- HEADER --}}
<section class="px-12 py-10 bg-gray-800 border-b border-gray-700">
    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-1">Semua Hotel</p>
    <h1 class="text-3xl font-extrabold text-white mb-6">Daftar Hotel di Bandung</h1>

    {{-- FILTER & SEARCH --}}
    <form action="{{ route('hotel.index') }}" method="GET">
        <div class="flex flex-wrap gap-3 items-center">

            <div class="flex items-center bg-gray-700 border border-gray-600 rounded-xl px-4 py-2.5 gap-2 flex-1 min-w-[200px]">
                <span class="text-gray-400">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama hotel..."
                       class="bg-transparent text-sm text-white placeholder-gray-500 outline-none w-full">
            </div>

            <select name="area"
                    class="bg-gray-700 border border-gray-600 text-sm text-white rounded-xl px-4 py-2.5 outline-none">
                <option value="">Semua Area</option>
                @foreach(['Dago','Pasteur','Lembang','Buah Batu','Braga'] as $area)
                    <option value="{{ $area }}" {{ request('area') == $area ? 'selected' : '' }}>{{ $area }}</option>
                @endforeach
            </select>

            <select name="bintang"
                    class="bg-gray-700 border border-gray-600 text-sm text-white rounded-xl px-4 py-2.5 outline-none">
                <option value="">Semua Bintang</option>
                @foreach([1,2,3,4,5] as $b)
                    <option value="{{ $b }}" {{ request('bintang') == $b ? 'selected' : '' }}>Bintang {{ $b }}</option>
                @endforeach
            </select>

            <input type="date" name="checkin" value="{{ request('checkin') }}"
                   class="bg-gray-700 border border-gray-600 text-sm text-white rounded-xl px-4 py-2.5 outline-none">
            <input type="date" name="checkout" value="{{ request('checkout') }}"
                   class="bg-gray-700 border border-gray-600 text-sm text-white rounded-xl px-4 py-2.5 outline-none">

            <button type="submit"
                    class="bg-[#0891b2] hover:bg-[#0e7490] text-white font-bold text-sm px-6 py-2.5 rounded-xl transition-colors">
                Cari
            </button>

            @if(request()->anyFilled(['search','area','bintang','checkin','checkout']))
                <a href="{{ route('hotel.index') }}"
                   class="text-sm text-gray-400 hover:text-white transition-colors">Reset</a>
            @endif
        </div>
    </form>
</section>

{{-- HASIL --}}
<section class="px-12 py-10">
    <p class="text-sm text-gray-400 mb-6">
        Menampilkan <span class="text-white font-bold">{{ $totalHotels ?? count($hotels ?? []) }}</span> hotel
        @if(request('search')) untuk "<span class="text-cyan-400">{{ request('search') }}</span>" @endif
        @if(request('area')) di area <span class="text-cyan-400">{{ request('area') }}</span> @endif
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @if(isset($hotels) && $hotels->count() > 0)
            {{-- LOOPING DATA ASLI DARI DATABASE --}}
            @foreach($hotels as $i => $hotel)
                <div class="bg-gray-800 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition-all duration-200 flex flex-col justify-between">
                    <div class="{{ ['bg-cyan-100','bg-blue-100','bg-sky-100'][$i % 3] }} h-40 overflow-hidden">
                        {{-- Mengambil foto dari db, atau pakai placeholder jika kosong --}}
                        <img src="{{ $hotel->foto ? asset('assets/hotel/' . $hotel->foto) : asset('assets/hotel/hotelaston.jpg') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                {{-- Mengambil nama area dari relasi $hotel->area --}}
                                <div class="text-cyan-400 text-xs font-semibold">📍 {{ $hotel->area->nama ?? 'Bandung' }}</div>
                                <div class="text-xs">
                                    @for($s = 1; $s <= 5; $s++)
                                        <span class="{{ $s <= ($hotel->bintang ?? 4) ? 'text-yellow-400' : 'text-gray-600' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                            <h3 class="text-white font-bold text-base mb-2">{{ $hotel->nama }}</h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-white text-sm font-bold">{{ $hotel->rating ?? '4.5' }}</span>
                                <span class="text-gray-500 text-xs">({{ $hotel->reviews ?? '100' }} ulasan)</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-4">
                                @if($hotel->facilities)
                                    @foreach(explode(',', $hotel->facilities) as $f)
                                        <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-md">{{ $f }}</span>
                                    @endforeach
                                @else
                                    <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-md">WiFi</span>
                                    <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-md">AC</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-700 mt-4">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-cyan-400 font-extrabold text-base">Rp {{ number_format($hotel->harga,0,',','.') }}</p>
                                <p class="text-xs text-gray-500">/malam</p>
                            </div>
                            <a href="{{ route('hotel.show', ['id' => $hotel->id_hotel, 'checkin' => request('checkin'), 'checkout' => request('checkout')]) }}"
                               class="bg-white text-gray-900 font-bold text-sm px-5 py-2 rounded-lg hover:bg-cyan-400 transition-colors">
                               Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            {{-- TAMPILAN JIKA TIDAK ADA DATA SAMA SEKALI --}}
            <div class="col-span-1 md:col-span-3 text-center py-12">
                <p class="text-gray-400 text-lg">Tidak ada data hotel yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

</x-app-layout>

