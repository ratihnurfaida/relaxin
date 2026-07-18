<x-app-layout>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    {{-- HEADER --}}
    <section class="px-12 py-12 bg-white border-b border-cyan-100" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto">
            <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Jelajahi</p>
            <h1 class="text-4xl mb-2 leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Area &amp; Kawasan di Bandung</h1>
            <p class="text-gray-500 text-base font-medium">Pilih kawasan favoritmu dan temukan hotel terbaik di sana</p>
        </div>
    </section>

    {{-- GRID AREA --}}
    <section class="px-12 py-12 bg-cyan-50/40 min-h-screen" style="font-family: 'Inter', sans-serif;">
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
                                <img src="{{ asset('foto/' . $meta['foto']) }}"
                                     alt="{{ $area->nama }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                <div class="absolute inset-0 bg-black/30"></div>

                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-sm font-extrabold px-3 py-1 rounded-full shadow-sm" style="color: #155E75; font-family: 'IBM Plex Mono', monospace;">
                                    {{ $area->hotels_count }} hotel
                                </div>

                                <div class="absolute bottom-3 left-4 flex items-center gap-2">
                                    <h3 class="text-white text-2xl drop-shadow-md leading-none" style="font-family: 'Fraunces', serif; font-weight: 600;">{{ $area->nama }}</h3>
                                </div>
                            </div>

                            <div class="p-5">
                                <p class="text-gray-600 text-sm leading-relaxed font-medium">{{ $meta['desc'] }}</p>
                            </div>
                        </div>

                        <div class="px-5 pb-5 pt-3 border-t border-cyan-200/40 flex items-center justify-between">
                            <span class="text-sm font-bold" style="color: rgba(21,94,117,0.7); font-family: 'IBM Plex Mono', monospace;">{{ $area->hotels_count }} hotel tersedia</span>
                            <span class="text-sm font-extrabold flex items-center gap-1 transition-colors group-hover:opacity-80" style="color: #0E7490;">
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
                <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Tips</p>
                <h2 class="text-2xl mb-6 leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Panduan Memilih Area</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['icon'=>'💼','title'=>'Perjalanan Bisnis','desc'=>'Pilih Pasteur dekat pintu tol gerbang utama dan pusat korporat Bandung.'],
                        ['icon'=>'🌄','title'=>'Liburan Keluarga','desc'=>'Lembang dan Dago menawarkan udara sejuk pegunungan serta aktivitas wisata outdoor.'],
                        ['icon'=>'🎭','title'=>'Wisata Budaya & Estetik','desc'=>'Braga dan Asia Afrika adalah pusatnya seni, jalan kaki, dan sejarah heritage kota.'],
                    ] as $tip)
                        <div class="flex gap-4">
                            <div style="background-color: #ecfbfc;" class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 border border-cyan-100 shadow-sm">
                                {{ $tip['icon'] }}
                            </div>
                            <div>
                                <h4 class="text-base mb-1 leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">{{ $tip['title'] }}</h4>
                                <p class="text-gray-500 text-sm leading-relaxed font-medium">{{ $tip['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-app-layout>