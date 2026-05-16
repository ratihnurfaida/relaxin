@props([
    'hotel',
    'bgColor' => 'bg-green-100',
])

<div class="bg-gray-800 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">

    {{-- Gambar / Placeholder --}}
    <div class="{{ $bgColor }} h-40 flex items-center justify-center text-5xl">
        🏨
    </div>

    <div class="p-4">
        {{-- Area --}}
        <div class="flex items-center gap-1 text-green-400 text-xs font-semibold mb-1">
            📍 {{ $hotel->area ?? 'Bandung' }}
        </div>

        {{-- Nama --}}
        <h3 class="text-white font-bold text-base mb-2">{{ $hotel->name }}</h3>

        {{-- Rating --}}
        <div class="flex items-center gap-2 mb-3">
            <span class="text-yellow-400 text-sm">★★★★☆</span>
            <span class="text-white text-sm font-bold">{{ number_format($hotel->rating ?? 4.5, 1) }}</span>
            <span class="text-gray-500 text-xs">({{ $hotel->reviews_count ?? 0 }} ulasan)</span>
        </div>

        {{-- Fasilitas --}}
        <div class="flex flex-wrap gap-1 mb-4">
            @foreach(explode(',', $hotel->facilities ?? 'WiFi,Parkir,AC') as $f)
                <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-md">{{ trim($f) }}</span>
            @endforeach
        </div>

        {{-- Harga + Tombol --}}
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500">Mulai dari</p>
                <p class="text-green-400 font-extrabold text-base">
                    Rp {{ number_format($hotel->price_per_night ?? 0, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-500">/malam</p>
            </div>
            <a href="{{ route('hotel.detail', $hotel->id) }}"
               class="bg-white text-gray-900 font-bold text-sm px-5 py-2 rounded-lg hover:bg-green-400 transition-colors">
                Pesan
            </a>
        </div>
    </div>
</div>