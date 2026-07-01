<x-app-layout>

{{-- ===== HEADER & FILTER PENCARIAN (Warna Soft Cyan Padat Tanpa Opacity) ===== --}}
<section class="px-12 pt-16 pb-12 bg-[#ecfbfc] border-b border-cyan-100/50">
    <div class="max-w-7xl mx-auto">
        <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Semua Hotel</p>
        <h1 class="text-3xl font-black text-gray-800 tracking-tight mb-8">Daftar Hotel di Bandung</h1>

        {{-- FILTER & SEARCH FORM --}}
        <form action="{{ route('hotel.index') }}" method="GET" class="bg-white p-5 rounded-3xl border border-slate-100 shadow-xl">
            <div class="flex flex-wrap gap-3 items-center">

                {{-- Input: Cari Nama --}}
                <div class="flex items-center bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 gap-2 flex-1 min-w-[200px] focus-within:border-cyan-500 focus-within:bg-white transition-all">
                    <span class="text-gray-400">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama hotel..."
                           class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-full">
                </div>

                {{-- Dropdown: Area --}}
                <select name="area"
                        class="bg-slate-50 border border-slate-200 text-sm text-gray-700 rounded-xl px-4 py-2.5 outline-none focus:border-cyan-500 focus:bg-white transition-all cursor-pointer">
                    <option value="">Semua Area</option>
                    @foreach(['Dago','Pasteur','Lembang','Buah Batu','Braga'] as $area)
                        <option value="{{ $area }}" {{ request('area') == $area ? 'selected' : '' }}>{{ $area }}</option>
                    @endforeach
                </select>

                {{-- Dropdown: Bintang --}}
                <select name="bintang"
                        class="bg-slate-50 border border-slate-200 text-sm text-gray-700 rounded-xl px-4 py-2.5 outline-none focus:border-cyan-500 focus:bg-white transition-all cursor-pointer">
                    <option value="">Semua Bintang</option>
                    @foreach([1,2,3,4,5] as $b)
                        <option value="{{ $b }}" {{ request('bintang') == $b ? 'selected' : '' }}>Bintang {{ $b }}</option>
                    @endforeach
                </select>

                {{-- Input Date: Check-In --}}
                <input type="date" name="checkin" value="{{ request('checkin') }}"
                       class="bg-slate-50 border border-slate-200 text-sm text-gray-600 rounded-xl px-4 py-2.5 outline-none focus:border-cyan-500 focus:bg-white transition-all cursor-pointer">
                
                {{-- Input Date: Check-Out --}}
                <input type="date" name="checkout" value="{{ request('checkout') }}"
                       class="bg-slate-50 border border-slate-200 text-sm text-gray-600 rounded-xl px-4 py-2.5 outline-none focus:border-cyan-500 focus:bg-white transition-all cursor-pointer">

                {{-- Tombol Cari --}}
                <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-sm px-6 py-2.5 rounded-xl transition-colors shadow-md shadow-cyan-600/10 active:scale-95 duration-150">
                    Cari
                </button>

                {{-- Tombol Reset --}}
                @if(request()->anyFilled(['search','area','bintang','checkin','checkout']))
                    <a href="{{ route('hotel.index') }}"
                       class="text-sm font-semibold text-gray-400 hover:text-cyan-600 transition-colors ml-2">Reset</a>
                @endif
            </div>
        </form>
    </div>
</section>

{{-- ===== SECTION DAFTAR HASIL HOTEL (Warna Slate Terang Kontras Berbeda dari Atas) ===== --}}
<section class="px-12 py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto">
        
        {{-- Teks Info Pencarian --}}
        <p class="text-sm text-gray-500 mb-6">
            Menampilkan <span class="text-gray-800 font-bold">{{ $totalHotels ?? count($hotels ?? []) }}</span> hotel
            @if(request('search')) untuk "<span class="text-cyan-600 font-semibold">{{ request('search') }}</span>" @endif
            @if(request('area')) di area <span class="text-cyan-600 font-semibold">{{ request('area') }}</span> @endif
        </p>

        {{-- Grid Kartu Hotel --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if(isset($hotels) && $hotels->count() > 0)
                @foreach($hotels as $i => $hotel)
                    
                    {{-- 🔥 PERUBAHAN UTAMA: Ganti bg-white lama dengan inline style background warna cyan pastel --}}
                    <div style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-3xl overflow-hidden hover:-translate-y-1.5 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        
                        {{-- Gambar Hotel --}}
                        <div class="h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ $hotel->foto ? asset('storage/hotel/' . $hotel->foto) : asset('storage/hotel/hotelaston.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        
                        {{-- Konten Detail Card --}}
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-cyan-700 text-xs font-bold">📍 {{ $hotel->area->nama ?? 'Bandung' }}</div>
                                    <div class="text-xs">
                                        @for($s = 1; $s <= 5; $s++)
                                            <span class="{{ $s <= ($hotel->bintang ?? 4) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                                
                                <h3 class="text-gray-800 font-black text-base mb-1.5 leading-snug">{{ $hotel->nama }}</h3>
                                
                                {{-- Skor & Ulasan (Ubah bg badge jadi putih solid biar kebaca jelas) --}}
                                <div class="flex items-center gap-1.5 mb-4">
                                    <span class="bg-white text-cyan-700 text-xs font-bold px-1.5 py-0.5 rounded border border-cyan-100">{{ $hotel->rating ?? '4.5' }}</span>
                                    <span class="text-gray-500 text-xs">({{ $hotel->reviews ?? '100' }} ulasan)</span>
                                </div>
                                
                                {{-- Fasilitas (Badge diubah jadi background putih kontras) --}}
                                <div class="flex flex-wrap gap-1 mb-5">
                                    @if($hotel->facilities)
                                        @foreach(explode(',', $hotel->facilities) as $f)
                                            <span class="text-[10px] text-cyan-800 bg-white border border-cyan-100 px-2 py-1 rounded-md font-medium tracking-wide">{{ $f }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-[10px] text-cyan-800 bg-white border border-cyan-100 px-2 py-1 rounded-md font-medium tracking-wide">WiFi</span>
                                        <span class="text-[10px] text-cyan-800 bg-white border border-cyan-100 px-2 py-1 rounded-md font-medium tracking-wide">AC</span>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Baris Harga & Tombol Pesan --}}
                            <div class="flex items-center justify-between pt-4 border-t border-cyan-200/60 mt-2">
                                <div>
                                    <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">Mulai dari</p>
                                    <p class="text-cyan-700 font-black text-lg leading-none mt-0.5">Rp {{ number_format($hotel->hotel_rooms_min_price ?? $hotel->harga ?? 0,0,',','.') }}</p>
                                    <p class="text-[10px] text-gray-500 font-medium">/ malam</p>
                                </div>
                                <a href="{{ route('hotel.show', ['id' => $hotel->id_hotel, 'checkin' => request('checkin'), 'checkout' => request('checkout')]) }}"
                                   class="bg-cyan-600 text-white font-bold text-xs px-5 py-2.5 rounded-xl hover:bg-cyan-700 shadow-md shadow-cyan-600/10 active:scale-95 transition-all duration-150">
                                    Pesan
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            @else
                <div class="col-span-1 md:col-span-3 text-center py-20 bg-white border border-slate-100 rounded-3xl shadow-sm">
                    <span class="text-4xl">🏨</span>
                    <p class="text-gray-400 text-sm mt-3 font-medium">Tidak ada data hotel yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </div>
</section>

</x-app-layout>