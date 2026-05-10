{{-- resources/views/components/hero.blade.php --}}
<section class="relative min-h-[520px] flex flex-col items-center justify-center
                pt-32 pb-20 px-4
                bg-gradient-to-br from-primary via-[#0891B2] to-[#164E63]
                overflow-hidden">

    {{-- Soft blobs --}}
    <div class="absolute -top-16 -right-16 w-80 h-80 rounded-full
                bg-light-cyan/20 blur-[72px] animate-float pointer-events-none"></div>
    <div class="absolute -bottom-10 -left-12 w-64 h-64 rounded-full
                bg-rose/15 blur-[60px] animate-float-r pointer-events-none"></div>

    {{-- Headline --}}
    <p class="animate-fade-up relative z-10 text-[0.72rem] font-bold uppercase
              tracking-[0.2em] text-[#A5F3FC] mb-3">
        ✦ Hotel Booking Terbaik di Indonesia
    </p>

    <h1 class="animate-fade-up-1 relative z-10 font-display font-black text-white text-center
               text-4xl md:text-5xl leading-tight mb-3 max-w-xl">
        Temukan Hotel <span class="italic text-[#67E8F9]">Impianmu</span>
    </h1>

    <p class="animate-fade-up-2 relative z-10 text-white/65 text-sm text-center
              mb-10 max-w-sm leading-relaxed">
        Cari, bandingkan, dan pesan hotel terbaik dengan harga dijamin paling hemat.
    </p>

    {{-- ── Search box ── --}}
    <div class="animate-fade-up-3 relative z-10 w-full max-w-3xl">
        <form action="{{ route('hotels.search') }}" method="GET">
            <div class="bg-white rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,.22)] p-4">

                {{-- Fields row --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[1fr_1fr_1fr_auto] gap-3">

                    {{-- Destinasi --}}
                    <div class="flex flex-col gap-1 px-3 py-2 rounded-xl bg-ice-cyan">
                        <label class="text-[0.65rem] font-bold uppercase tracking-widest text-primary">
                            📍 Destinasi
                        </label>
                        <input
                            type="text" name="location"
                            placeholder="Kota atau nama hotel..."
                            class="field bg-transparent text-sm placeholder-slate-400"
                        >
                    </div>

                    {{-- Check-in --}}
                    <div class="flex flex-col gap-1 px-3 py-2 rounded-xl bg-ice-cyan">
                        <label class="text-[0.65rem] font-bold uppercase tracking-widest text-primary">
                            📅 Check-in
                        </label>
                        <input
                            type="date" name="checkin"
                            class="field bg-transparent text-sm"
                        >
                    </div>

                    {{-- Check-out --}}
                    <div class="flex flex-col gap-1 px-3 py-2 rounded-xl bg-ice-cyan">
                        <label class="text-[0.65rem] font-bold uppercase tracking-widest text-primary">
                            📅 Check-out
                        </label>
                        <input
                            type="date" name="checkout"
                            class="field bg-transparent text-sm"
                        >
                    </div>

                    {{-- Tombol cari --}}
                    <button type="submit"
                            class="btn-rose flex items-center justify-center gap-2
                                   rounded-xl px-6 py-3 text-sm sm:col-span-2 lg:col-span-1">
                        🔍 Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
