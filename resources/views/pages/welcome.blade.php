<x-app-layout>

{{-- ===== HERO SECTION (Tetap Cerah Berenergi) ===== --}}
    <section class="relative px-12 pt-28 pb-24 text-center bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('storage/foto/bg.jpeg') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/30 z-0"></div>

        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 bg-cyan-400/20 border border-cyan-400/40 text-cyan-200 text-xs font-bold px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
                Khusus Hotel Bandung
            </div>

            <h1 class="text-2xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-3">
                Temukan Hotel Terbaik<br>
                di <span class="text-cyan-300">Bandung</span>, Mudah & Cepat
            </h1>
            <p class="text-cyan-50/90 text-base mb-10 max-w-xl mx-auto">
                Dari budget hingga bintang lima semua hotel Bandung ada di sini
            </p>

            <form action="{{ route('hotel.index') }}" method="GET">
                <div class="bg-white rounded-2xl px-7 py-5 max-w-2xl mx-auto shadow-xl border border-gray-100 flex items-center gap-4 flex-wrap md:flex-nowrap">
                    <div class="flex flex-col flex-1 min-w-[120px] text-left">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Destination</label>
                        <input type="text" name="search" placeholder="Cari hotel di Bandung...."
                               class="text-sm font-bold text-gray-800 outline-none border-none bg-transparent w-full placeholder-gray-400">
                    </div>
                    <div class="w-px h-10 bg-gray-200 hidden md:block"></div>
                    <div class="flex flex-col flex-1 min-w-[120px] text-left">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Check-in</label>
                        <input type="date" name="checkin" class="text-sm font-bold text-gray-700 outline-none border-none bg-transparent w-full">
                    </div>
                    <div class="w-px h-10 bg-gray-200 hidden md:block"></div>
                    <div class="flex flex-col flex-1 min-w-[120px] text-left">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Check-out</label>
                        <input type="date" name="checkout" class="text-sm font-bold text-gray-700 outline-none border-none bg-transparent w-full">
                    </div>
                    <!-- Tombol Cari diubah jadi Gradasi Cyan-Teal yang Pop Out -->
                    <button type="submit" class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold text-sm px-7 py-3.5 rounded-xl hover:from-cyan-700 hover:to-teal-700 transition-all shadow-md shadow-cyan-600/20">
                        Cari Hotel
                    </button>
                </div>
            </form>
        </div>
    </section>

{{-- ===== HOTEL POPULER (Background Putih Bersih) ===== --}}
<section id="hotel" class="px-12 py-16 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Rekomendasi</p>
                <h2 class="text-2xl font-extrabold text-gray-800">Hotel Populer Minggu Ini</h2>
            </div>
            <a href="{{ route('hotel.index') }}" class="text-cyan-600 text-sm font-bold hover:text-cyan-700 transition-colors">
                Lihat semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @if(isset($hotels) && $hotels->count() > 0)
                @foreach($hotels as $i => $hotel)
                    
                    {{-- 🔥 DISINI PERUBAHANNYA: Ganti bg-white lama dengan inline style background warna soft cyan + border cyan --}}
                    <div style="background-color: #ecfbfc;" class="rounded-2xl overflow-hidden border border-cyan-200 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                        <div class="bg-slate-100 h-48 overflow-hidden relative">
                            <img src="{{ $hotel->gambar ? asset('storage/hotel/' . $hotel->gambar) : asset('storage/app/public/hotel/hotelaston.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-cyan-700 text-xs font-bold">📍 {{ $hotel->area->name ?? 'Bandung' }}</div>
                                    <div class="text-xs">
                                        @for($s = 1; $s <= 5; $s++)
                                            <span class="{{ $s <= ($hotel->star_rating ?? 4) ? 'text-yellow-400' : 'text-gray-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                                <h3 class="text-gray-800 font-extrabold text-lg mb-2 hover:text-cyan-600 transition-colors">{{ $hotel->nama }}</h3>
                                
                                {{-- Rating & Skor (Diberi border tipis dan bg-white biar mencolok di atas background cyan) --}}
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="bg-white text-cyan-700 text-xs font-bold px-1.5 py-0.5 rounded border border-cyan-100">4.5</span>
                                    <span class="text-gray-500 text-xs">(100 ulasan)</span>
                                </div>
                                
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    {{-- Badge fasilitas diubah dari bg-cyan-50 ke bg-white padat supaya kontras bersih --}}
                                    @if($hotel->fasilitas)
                                        @foreach(explode(',', $hotel->fasilitas) as $f)
                                            <span class="text-[11px] text-cyan-800 bg-white border border-cyan-100 font-semibold px-2.5 py-1 rounded-md">{{ trim($f) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-[11px] text-cyan-800 bg-white border border-cyan-100 font-semibold px-2.5 py-1 rounded-md">WiFi</span>
                                        <span class="text-[11px] text-cyan-800 bg-white border border-cyan-100 font-semibold px-2.5 py-1 rounded-md">AC</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-cyan-200/60 mt-2">
                                <div>
                                    <p class="text-[9px] uppercase font-bold tracking-wider text-gray-400">Mulai dari</p>
                                    <p class="text-cyan-700 font-black text-xl">Rp {{ number_format($hotel->harga,0,',','.') }}</p>
                                    <p class="text-xs text-gray-400">/malam</p>
                                </div>
                                <a href="{{ route('hotel.show', ['id' => $hotel->id_hotel, 'checkin' => request('checkin'), 'checkout' => request('checkout')]) }}"
                                   class="bg-gradient-to-r from-cyan-600 to-cyan-500 text-white font-bold text-sm px-5 py-2.5 rounded-xl hover:from-cyan-700 hover:to-cyan-600 transition-colors shadow-md shadow-cyan-600/10">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-1 md:col-span-3 text-center py-12 bg-slate-50 border border-dashed border-gray-200 rounded-2xl">
                    <p class="text-gray-400 font-medium">Belum ada rekomendasi hotel tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ===== JELAJAHI AREA (Background Selang-seling: Slate Ringan) ===== --}}
<section id="destinasi" class="px-12 py-16 bg-slate-50 border-t border-b border-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Jelajahi</p>
            <h2 class="text-2xl font-extrabold text-gray-800">Cari berdasarkan area</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach([
                ['name'=>'Dago',      'count'=>32],
                ['name'=>'Pasteur',   'count'=>18],
                ['name'=>'Lembang',   'count'=>24],
                ['name'=>'Buah Batu', 'count'=>15],
                ['name'=>'Braga',     'count'=>11],
            ] as $area)
                <a href="{{ route('hotel.index', ['area' => $area['name']]) }}"
                   style="background-color: #ecfbfc;"
                   class="border border-cyan-200 rounded-xl p-5 flex items-center gap-4
                          hover:border-cyan-400 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-150 cursor-pointer">
                    
                    {{-- Kontainer Icon (Dibuat bg-white padat agar menonjol di atas background soft cyan) --}}
                    <div class="w-12 h-12 bg-white border border-cyan-100 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                        
                        @if($area['name'] == 'Dago')
                            {{-- Icon Daun / Alam (Dago) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18M16.5 7.5a4.5 4.5 0 0 1-9 0" />
                            </svg>

                        @elseif($area['name'] == 'Pasteur')
                            {{-- Icon Gedung / Office Kantor (Pasteur) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 16.5h1.5m3 0H15" />
                            </svg>

                        @elseif($area['name'] == 'Lembang')
                            {{-- Icon Kompas / Petualangan Gunung (Lembang) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                        @elseif($area['name'] == 'Buah Batu')
                            {{-- Icon Rumah / Homey (Buah Batu) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                        @elseif($area['name'] == 'Braga')
                            {{-- Icon Kamera Seni / Estetik (Braga) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        @endif

                    </div>

                    {{-- Info Teks --}}
                    <div>
                        <div class="text-gray-800 text-sm font-bold">{{ $area['name'] }}</div>
                        <div class="text-cyan-700 text-xs font-semibold mt-0.5">{{ $area['count'] }} hotel</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== KENAPA RELAXIN (Background Kembali ke Putih) ===== --}}
<section id="tentang" class="px-12 py-16 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Kenapa RelaXin?</p>
            <h2 class="text-2xl font-extrabold text-gray-800">Lebih fokus, lebih mudah</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach([
                ['title'=>'Khusus Bandung',    'desc'=>'Semua hotel yang tampil memang ada di Bandung tidak perlu filter ulang.'],
                ['title'=>'Pesan cepat',        'desc'=>'Pilih hotel, tentukan tanggal, konfirmasi selesai dalam hitungan menit.'],
                ['title'=>'Ulasan terpercaya',  'desc'=>'Rating dan ulasan dari tamu yang benar-benar sudah menginap.'],
                ['title'=>'Harga transparan',   'desc'=>'Harga yang tampil sudah termasuk pajak, tanpa biaya tersembunyi.'],
            ] as $why)
                <div style="background-color: #ecfbfc;" 
                     class="border border-cyan-200 rounded-2xl p-6 hover:bg-white hover:shadow-xl hover:border-cyan-400 hover:-translate-y-1 transition-all duration-200">
                    
                    {{-- Kontainer Icon SVG --}}
                    <div class="w-12 h-12 bg-white border border-cyan-100 rounded-xl flex items-center justify-center mb-4 shadow-sm">
                        
                        @if($why['title'] == 'Khusus Bandung')
                            {{-- Icon Pin Peta (Location Map Pin) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                        @elseif($why['title'] == 'Pesan cepat')
                            {{-- Icon Petir / Kilat (Lightning Bolt) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                            </svg>

                        @elseif($why['title'] == 'Ulasan terpercaya')
                            {{-- Icon Bintang Gari-garis (Star Outline) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.151-.312.59-.312.741 0l2.22 4.504 4.97A.75.75 0 0 1 19.83 9.22l-3.597 3.504.85 4.952a.75.75 0 0 1-1.088.791L11.5 16.12l-4.444 2.333a.75.75 0 0 1-1.088-.791l.85-4.952-3.597-3.504a.75.75 0 0 1 .419-1.282l4.97-.443 2.22-4.504Z" />
                            </svg>

                        @elseif($why['title'] == 'Harga transparan')
                            {{-- Icon Kartu/Dompet/Tag Uang (Banknotes / Tag) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M5.25 7.5h13.5m-15 3h15m-16.5 3h16.5m-18 3h19.5M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                        @endif

                    </div>
                    
                    {{-- Judul & Deskripsi --}}
                    <h4 class="text-gray-800 font-bold text-base mb-2">{{ $why['title'] }}</h4>
                    <p class="text-gray-600 text-xs leading-relaxed">{{ $why['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
</x-app-layout>