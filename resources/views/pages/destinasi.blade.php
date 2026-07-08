<x-app-layout>

    {{-- HEADER --}}
    <section class="px-12 py-12 bg-white border-b border-cyan-100">
        <div class="max-w-7xl mx-auto">
            <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Jelajahi</p>
            <h1 class="text-3xl font-black text-gray-800 mb-2 tracking-tight">Area & Kawasan di Bandung</h1>
            <p class="text-gray-500 text-sm font-medium">Pilih kawasan favoritmu dan temukan hotel terbaik di sana</p>
        </div>
    </section>

    {{-- GRID AREA --}}
    <section class="px-12 py-12 bg-cyan-50/40 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $areaMeta = [
                        'Asia Afrika' => ['desc' => 'Jalan bersejarah ikonik Bandung, pusat budaya dan landmark kota.', 'foto' => 'bg.jpeg'],
                        'Braga'       => ['desc' => 'Pusat seni dan kuliner, dikelilingi bangunan bersejarah Belanda.', 'foto' => 'braga1.jpeg'],
                        'Dago'        => ['desc' => 'Kawasan hijau dengan hotel bernuansa alam dan view pegunungan.', 'foto' => 'dago.jpeg'],
                        'Lembang'     => ['desc' => 'Udara sejuk pegunungan dengan pemandangan alam yang indah.', 'foto' => 'lembang.jpeg'],
                        'Pasteur'     => ['desc' => 'Dekat pintu tol, cocok untuk perjalanan bisnis dan transit.', 'foto' => 'pasteur.jpeg'],
                        'Buah Batu' => ['desc' => 'Kawasan tenang dan asri, jauh dari hiruk pikuk pusat kota.', 'foto' => 'bg.jpeg'],
                    ];
                @endphp

                @foreach($areas as $area)
                    @php
                        $meta = $areaMeta[$area->nama] ?? ['desc' => 'Temukan hotel terbaik di kawasan ini.', 'foto' => 'default-area.jpeg'];
                    @endphp

                    <a href="{{ route('hotel.index', ['area' => $area->nama]) }}"
                       style="background-color: #ecfbfc;"
                       class="group rounded-2xl overflow-hidden border border-cyan-200/70 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">

                        <div>
                            {{-- FOTO dengan overlay --}}
                            <div class="relative h-48 overflow-hidden bg-white">
                                <img src="{{ asset('storage/foto/' . $meta['foto']) }}"
                                     alt="{{ $area->nama }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                <div class="absolute inset-0 bg-black/30"></div>

                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-cyan-800 text-xs font-extrabold px-3 py-1 rounded-full shadow-sm">
                                    {{ $area->hotels_count }} hotel
                                </div>

                                <div class="absolute bottom-3 left-4 flex items-center gap-2">
                                    <h3 class="text-white font-black text-xl drop-shadow-md tracking-tight">{{ $area->nama }}</h3>
                                </div>
                            </div>

                            <div class="p-5">
                                <p class="text-gray-600 text-xs leading-relaxed font-medium">{{ $meta['desc'] }}</p>
                            </div>
                        </div>

                        <div class="px-5 pb-5 pt-3 border-t border-cyan-200/40 flex items-center justify-between">
                            <span class="text-xs text-cyan-800/70 font-bold">{{ $area->hotels_count }} hotel tersedia</span>
                            <span class="text-cyan-600 text-xs font-extrabold group-hover:text-cyan-700 flex items-center gap-1 transition-colors">
                                Lihat hotel
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- TIPS --}}
            <div class="mt-12 bg-white rounded-3xl p-8 border border-cyan-100 shadow-sm">
                <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Tips</p>
                <h2 class="text-xl font-black text-gray-800 mb-6 tracking-tight">Panduan Memilih Area</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['icon'=>'💼','title'=>'Perjalanan Bisnis','desc'=>'Pilih Pasteur dekat pintu tol gerbang utama dan pusat korporat Bandung.'],
                        ['icon'=>'🌄','title'=>'Liburan Keluarga','desc'=>'Lembang dan Dago menawarkan udara sejuk pegunungan serta aktivitas wisata outdoor.'],
                        ['icon'=>'🎭','title'=>'Wisata Budaya & Estetik','desc'=>'Braga dan Asia Afrika adalah pusatnya seni, jalan kaki, dan sejarah heritage kota.'],
                    ] as $tip)
                        <div class="flex gap-4">
                            <div style="background-color: #ecfbfc;" class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl flex-shrink-0 border border-cyan-100 shadow-sm">
                                {{ $tip['icon'] }}
                            </div>
                            <div>
                                <h4 class="text-gray-800 font-bold text-sm mb-1 tracking-tight">{{ $tip['title'] }}</h4>
                                <p class="text-gray-500 text-xs leading-relaxed font-medium">{{ $tip['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-app-layout>