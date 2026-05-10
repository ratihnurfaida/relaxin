{{-- resources/views/components/hotel-card.blade.php --}}
{{--
    Cara pakai:
    @include('components.hotel-card', ['hotel' => $hotel])

    Struktur $hotel:
    [
        'id'        => 1,
        'name'      => 'Nama Hotel',
        'location'  => 'Kota, Provinsi',
        'image'     => 'https://...',
        'stars'     => 4,           // 1–5
        'rating'    => '4.8',
        'reviews'   => '1.2k',
        'amenities' => ['🏊 Pool', '🍳 Sarapan'],
        'price'     => 850000,
        'badge'     => 'Best Seller',   // null = tidak ada
        'badge_color' => 'rose',        // rose | primary | emerald
    ]
--}}

<div class="hotel-card group">

    {{-- Gambar --}}
    <div class="relative h-48 overflow-hidden">
        <img
            src="{{ asset('assets/hotel/' . $hotel->gambar) }}" 
            alt="{{ $hotel->nama }}"
            class="w-full h-full object-cover
                   transition-transform duration-500 group-hover:scale-105"
        >

        {{-- Badge opsional --}}
        @if (!empty($hotel['badge']))
            @php
                $bg = match($hotel['badge_color'] ?? 'rose') {
                    'primary' => 'bg-primary',
                    'emerald' => 'bg-emerald-600',
                    default   => 'bg-rose',
                };
            @endphp
            <span class="absolute top-3 left-3 {{ $bg }} text-white
                         text-[0.65rem] font-bold uppercase tracking-wide
                         px-2.5 py-1 rounded-full">
                {{ $hotel['badge'] }}
            </span>
        @endif

        {{-- Tombol favorit --}}
        <button
            data-id="{{ $hotel['id'] }}"
            class="fav-btn absolute top-3 right-3 w-8 h-8 bg-white/90 hover:bg-white
                   rounded-full flex items-center justify-center shadow
                   transition-all duration-200 text-base">
            🤍
        </button>
    </div>

    {{-- Konten --}}
    <div class="p-4">

        {{-- Lokasi --}}
        <p class="text-[0.68rem] font-bold uppercase tracking-wider text-primary mb-0.5">
            📍 {{ $hotel['location'] }}
        </p>

        {{-- Nama --}}
        <h3 class="font-display text-[1.05rem] font-bold text-slate-900
                   leading-snug mb-2 line-clamp-1">
            {{ $hotel['nama'] }}
        </h3>

        {{-- Rating --}}
        <div class="flex items-center gap-1.5 mb-3">
            <span class="text-amber-400 text-xs">
                {{ str_repeat('★', $hotel['stars']) }}{{ str_repeat('☆', 5 - $hotel['stars']) }}
            </span>
            <span class="text-xs font-bold text-slate-800">{{ $hotel['star_rating'] }}</span>
            <span class="text-xs text-slate-400">({{ $hotel['reviews'] }} ulasan)</span>
        </div>

        {{-- Fasilitas --}}
        <div class="flex flex-wrap gap-1.5 mb-4">
            @if(!empty($hotel['fasilitas']))
             @php
            // Kita pecah tulisan "AC, WiFi" menjadi daftar berdasarkan tanda koma
                 $data_fasilitas = is_string($hotel['fasilitas']) 
                    ? explode(',', $hotel['fasilitas']) 
                    : $hotel['fasilitas'];
            @endphp

            @foreach($data_fasilitas as $am)
                <span class="tag">{{ trim($am) }}</span>
            @endforeach
            @else
                <span class="text-xs text-gray-400 italic">Fasilitas standar</span>
            @endif
        </div>

        {{-- Harga + tombol --}}
        <div class="flex items-end justify-between
                    pt-3 border-t border-[#B2EBF5]">
            <div>
                <p class="text-[0.65rem] text-slate-400 mb-0.5">Mulai dari</p>
                <p class="font-display text-xl font-black text-rose leading-none">
                    Rp {{ number_format($hotel->harga, 0, ',', '.') }}
                    <span class="font-sans text-xs text-slate-400 font-normal">/ malam</span>
                </p>
            </div>
            <a href="{{ route('hotels.show', $hotel['id_hotel']) }}" class="btn-primary">
                Pesan
            </a>
        </div>
    </div>
</div>
