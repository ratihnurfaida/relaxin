<x-app-layout>

{{-- HEADER --}}
<section class="px-12 py-10 bg-gray-800 border-b border-gray-700">
    <div class="border-b border-gray-700 pb-10">
        <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-1">Jelajahi</p>
        <h1 class="text-3xl font-extrabold text-white mb-2">Area & Kawasan di Bandung</h1>
        <p class="text-gray-400 text-sm">Pilih kawasan favoritmu dan temukan hotel terbaik di sana</p>
    </div>
    <div class="mt-10">
    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-1">Tips</p>
        <h2 class="text-xl font-extrabold text-white mb-6">Panduan Memilih Area</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon'=>'💼','title'=>'Perjalanan Bisnis','desc'=>'Pilih Pasteur atau Cicendo — dekat tol dan pusat bisnis.'],
                ['icon'=>'🌄','title'=>'Liburan Keluarga','desc'=>'Lembang dan Dago menawarkan udara segar dan aktivitas outdoor.'],
                ['icon'=>'🎭','title'=>'Wisata Budaya','desc'=>'Braga adalah pusatnya seni, kuliner, dan bangunan heritage Bandung.'],
            ] as $tip)
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-gray-700 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                        {{ $tip['icon'] }}
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm mb-1">{{ $tip['title'] }}</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">{{ $tip['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- GRID AREA --}}
<section class="px-12 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($areas as $area)
            <a href="{{ route('hotel.search', ['area' => $area->nama]) }}"
               class="group bg-gray-800 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">
                <div class="bg-gradient-to-br {{ $area['color'] }} h-28 flex items-center justify-center relative">
                    <span class="text-5xl">{{ $area['ikon'] }}</span>
                    <div class="absolute top-3 right-3 bg-black/30 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                        {{ $area['count'] }} hotel
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-white font-extrabold text-lg mb-1">{{ $area['name'] }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $area['desc'] }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">{{ $area['count'] }} hotel tersedia</span>
                        <span class="text-cyan-400 text-sm font-bold group-hover:translate-x-1 transition-transform">
                            Lihat hotel →
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

</x-app-layout>