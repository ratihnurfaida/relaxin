{{-- resources/views/components/hotel-recommendations.blade.php --}}
{{-- Dipanggil dari welcome.blade.php dengan variabel $hotels --}}

<section class="py-16 px-4">
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-8 gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-primary mb-1">
                    Rekomendasi
                </p>
                <h2 class="font-display text-2xl md:text-3xl font-black text-slate-900">
                    Hotel Populer Minggu Ini
                </h2>
            </div>
            <a href="{{ route('admin.hotel.index') }}"
               class="text-sm font-semibold text-primary border-2 border-light-cyan
                      px-4 py-1.5 rounded-full whitespace-nowrap
                      hover:bg-primary hover:text-white hover:border-primary transition-all">
                Lihat Semua →
            </a>
        </div>

        {{-- Grid kartu hotel --}}
        @if ($hotels->isEmpty())
            <div class="text-center py-20 text-slate-400 text-sm">
                Belum ada hotel tersedia saat ini.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach ($hotels as $hotel)
                    @include('components.hotel-card', ['hotel' => $hotel])
                @endforeach
            </div>
        @endif

    </div>
</section>
