<x-app-layout>
<div class="min-h-screen bg-slate-50" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-[1400px] mx-auto px-4 md:px-8 py-8 grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-6">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="lg:sticky lg:top-24 h-fit">
            <nav class="bg-white border border-slate-100 rounded-2xl shadow-sm p-3 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-base font-semibold transition-colors"
                   style="background-color: #ecfbfc; color: #0E7490;">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#riwayat-booking"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-base font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Booking Saya
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-base font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil Saya
                </a>
                <a href="{{ url('kontak') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-base font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Bantuan
                </a>

                <div class="pt-2 mt-2 border-t border-slate-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-base font-semibold text-rose-500 hover:bg-rose-50 transition-colors">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- ===== KONTEN UTAMA ===== --}}
        <div class="min-w-0">

            {{-- HEADER --}}
            <div class="mb-6">
                <h1 class="text-3xl leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                <p class="text-slate-400 text-base mt-1">Selamat datang kembali di RelaXin. Kelola booking dan perjalananmu dengan mudah.</p>
            </div>

            {{-- BOOKING BERIKUTNYA --}}
            @if($nextBooking)
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 mb-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="#0E7490" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h2 class="text-lg" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Booking Berikutnya</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-[280px_1fr] gap-5">
                        <div class="h-44 md:h-full rounded-xl overflow-hidden bg-slate-100">
                            <img src="{{ $nextBooking->kamar->gambar ? asset('storage/hotel/' . $nextBooking->kamar->gambar) : asset('storage/hotel/hotelaston.jpg') }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex flex-col justify-between">
                            <div>
                                <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                                    ✓ Confirmed
                                </span>
                                <h3 class="text-xl mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">{{ $nextBooking->hotel->nama ?? 'Hotel RelaXin' }}</h3>
                                <p class="text-sm text-slate-500 mb-4">📍 {{ $nextBooking->hotel->kota ?? 'Bandung' }}</p>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pb-4 border-b border-dashed border-slate-200">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Check In</p>
                                        <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($nextBooking->tgl_checkin)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Check Out</p>
                                        <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($nextBooking->tgl_checkout)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Kamar</p>
                                        <p class="text-sm font-bold text-slate-800">{{ $nextBooking->kamar->tipe_kamar ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Tamu</p>
                                        <p class="text-sm font-bold text-slate-800">{{ $nextBooking->total_tamu }} Orang</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 flex-wrap gap-3">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Pembayaran</p>
                                    <p class="text-2xl font-bold" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Rp {{ number_format($nextBooking->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- RINGKASAN BOOKING --}}
            <div class="mb-6">
                <h2 class="text-lg mb-3" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Ringkasan Booking</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 flex items-center gap-3">
                        <div style="background-color: #ecfbfc;" class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="#0E7490" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Total Booking</p>
                            <p class="text-2xl font-bold text-slate-900" style="font-family: 'IBM Plex Mono', monospace;">{{ $totalBooking }}</p>
                            <p class="text-xs text-slate-400">Semua waktu</p>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Selesai</p>
                            <p class="text-2xl font-bold text-emerald-600" style="font-family: 'IBM Plex Mono', monospace;">{{ $selesaiCount }}</p>
                            <p class="text-xs text-slate-400">{{ $selesaiPercent }}% dari total</p>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Pending</p>
                            <p class="text-2xl font-bold text-amber-500" style="font-family: 'IBM Plex Mono', monospace;">{{ $pendingCount }}</p>
                            <p class="text-xs text-slate-400">{{ $pendingPercent }}% dari total</p>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Dibatalkan</p>
                            <p class="text-2xl font-bold text-rose-500" style="font-family: 'IBM Plex Mono', monospace;">{{ $dibatalkanCount }}</p>
                            <p class="text-xs text-slate-400">{{ $dibatalkanPercent }}% dari total</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIWAYAT BOOKING --}}
            <div id="riwayat-booking">
                <h2 class="text-lg mb-3" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Riwayat Booking</h2>

                {{-- Search + Filter --}}
                <div class="flex flex-col md:flex-row gap-3 mb-4">
                    <div class="flex-1 flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-2.5 focus-within:border-cyan-500 transition-colors">
                        <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                        <input id="searchRiwayat" type="text" placeholder="Cari hotel, kota, atau nomor booking..." class="w-full text-base text-slate-700 outline-none border-none bg-transparent placeholder-slate-400">
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 mb-5">
                    <button class="filter-tab active px-4 py-2 rounded-lg text-sm font-bold transition-colors" data-filter="all" style="background-color: #ecfbfc; color: #0E7490;">Semua</button>
                    <button class="filter-tab px-4 py-2 rounded-lg text-sm font-bold text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 transition-colors" data-filter="confirmed">Confirmed</button>
                    <button class="filter-tab px-4 py-2 rounded-lg text-sm font-bold text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 transition-colors" data-filter="pending">Pending</button>
                    <button class="filter-tab px-4 py-2 rounded-lg text-sm font-bold text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 transition-colors" data-filter="selesai">Selesai</button>
                    <button class="filter-tab px-4 py-2 rounded-lg text-sm font-bold text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 transition-colors" data-filter="dibatalkan">Dibatalkan</button>
                </div>

     {{-- List --}}
<div class="space-y-3" id="bookingList">
    @forelse($bookings as $booking)
        @php
            $st = strtolower(trim($booking->status ?? 'pending'));
            $filterKey = in_array($st, ['confirmed','berhasil']) ? 'confirmed' : (in_array($st, ['selesai']) ? 'selesai' : (in_array($st, ['cancelled','dibatalkan']) ? 'dibatalkan' : 'pending'));
            $kodeBooking = 'RXN-' . \Carbon\Carbon::parse($booking->created_at)->format('ymd') . '-' . str_pad($booking->id_booking, 3, '0', STR_PAD_LEFT);
        @endphp

        <div data-status="{{ $filterKey }}" data-search="{{ strtolower(($booking->hotel->nama ?? '') . ' ' . ($booking->hotel->kota ?? '') . ' ' . $kodeBooking) }}"
             class="booking-row flex flex-col sm:flex-row items-start sm:items-center gap-4 bg-white border border-slate-100 rounded-2xl shadow-sm p-4 hover:shadow-md hover:border-cyan-200 transition-all">

            <div class="w-full sm:w-24 h-24 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                <img src="{{ $booking->kamar->gambar ? asset('storage/hotel/' . $booking->kamar->gambar) : asset('storage/hotel/hotelaston.jpg') }}" class="w-full h-full object-cover">
            </div>

            <div class="flex-1 min-w-0">
                <h3 class="text-base font-bold text-slate-900 truncate" style="font-family: 'Fraunces', serif; font-weight: 600;">{{ $booking->hotel->nama ?? 'Hotel RelaXin' }}</h3>
                <p class="text-sm text-slate-400 mb-1.5">📍 {{ $booking->hotel->kota ?? 'Bandung' }}</p>
                <div class="flex items-center gap-3 text-sm text-slate-500 flex-wrap">
                    <span class="flex items-center gap-1">📅 {{ \Carbon\Carbon::parse($booking->tgl_checkin)->format('d M') }} – {{ \Carbon\Carbon::parse($booking->tgl_checkout)->format('d M Y') }}</span>
                    <span class="flex items-center gap-1">👤 {{ $booking->total_tamu }} Tamu</span>
                </div>
            </div>

            <div class="flex flex-col items-start sm:items-end gap-1.5 sm:min-w-[160px]">
                @if($filterKey == 'pending')
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200">Pending</span>

                    {{-- Notifikasi ditolak, arahkan ke halaman upload ulang --}}
                    @if($booking->status == 'ditolak')
                        <a href="{{ route('booking.uploadUlang', $booking->id_booking) }}"
                           class="mt-2 flex items-center gap-1.5 px-2.5 py-1.5 bg-rose-50 border border-rose-200 rounded-lg w-full text-[11px] font-bold text-rose-700 hover:bg-rose-100 transition-colors">
                            ⚠️ Ditolak, klik untuk upload ulang →
                        </a>
                    @endif

                @elseif($filterKey == 'confirmed')
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Confirmed</span>
                @elseif($filterKey == 'selesai')
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-cyan-50 text-cyan-700 border border-cyan-200">Selesai</span>
                @else
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-200">Dibatalkan</span>
                @endif

                <p class="text-xs text-slate-400 mt-1" style="font-family: 'IBM Plex Mono', monospace;">{{ $kodeBooking }}</p>

                <div class="text-left sm:text-right">
                    <p class="text-[11px] text-slate-400 uppercase font-bold tracking-wide">Total</p>
                    <p class="text-base font-bold" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <svg class="hidden sm:block w-5 h-5 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
        </div>
    @empty
        <div class="bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center">
            <div class="text-4xl mb-3">🏨</div>
            <p class="text-slate-700 font-bold mb-1 text-lg">Belum ada booking</p>
            <p class="text-slate-400 text-base mb-5">Yuk temukan hotel terbaik di Bandung dan mulai perjalananmu!</p>
            <a href="{{ route('welcome') }}" class="inline-block text-white font-bold text-base px-6 py-2.5 rounded-xl transition-colors" style="background-color: #0E7490;">
                Cari Hotel Sekarang
            </a>
        </div>
    @endforelse
</div>

                <p id="noResultRiwayat" class="hidden text-center text-slate-400 text-sm py-8">Tidak ada booking yang cocok dengan pencarian.</p>

                {{-- PAGINASI --}}
                @if($bookings->hasPages())
                    <div class="flex items-center justify-center gap-2 mt-6">
                        @if($bookings->onFirstPage())
                            <span class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-300">‹</span>
                        @else
                            <a href="{{ $bookings->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">‹</a>
                        @endif

                        @for($p = 1; $p <= $bookings->lastPage(); $p++)
                            @if($p == $bookings->currentPage())
                                <span class="w-9 h-9 flex items-center justify-center rounded-lg text-white font-bold text-sm" style="background-color: #0E7490; font-family: 'IBM Plex Mono', monospace;">{{ $p }}</span>
                            @else
                                <a href="{{ $bookings->url($p) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold" style="font-family: 'IBM Plex Mono', monospace;">{{ $p }}</a>
                            @endif
                        @endfor

                        @if($bookings->hasMorePages())
                            <a href="{{ $bookings->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">›</a>
                        @else
                            <span class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-300">›</span>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchRiwayat');
    const filterTabs = document.querySelectorAll('.filter-tab');
    const rows = Array.from(document.querySelectorAll('.booking-row'));
    const noResult = document.getElementById('noResultRiwayat');
    let activeFilter = 'all';

    function applyFilters() {
        const q = searchInput.value.trim().toLowerCase();
        let visible = 0;
        rows.forEach(row => {
            const matchStatus = activeFilter === 'all' || row.dataset.status === activeFilter;
            const matchSearch = !q || row.dataset.search.includes(q);
            const show = matchStatus && matchSearch;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        noResult.classList.toggle('hidden', visible !== 0 || rows.length === 0);
    }

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            activeFilter = tab.dataset.filter;
            filterTabs.forEach(t => {
                t.classList.remove('active');
                t.style.backgroundColor = '';
                t.style.color = '';
                t.classList.add('bg-white', 'border', 'border-slate-200', 'text-slate-500');
            });
            tab.classList.add('active');
            tab.classList.remove('bg-white', 'border', 'border-slate-200', 'text-slate-500');
            tab.style.backgroundColor = '#ecfbfc';
            tab.style.color = '#0E7490';
            applyFilters();
        });
    });

    if (searchInput) searchInput.addEventListener('input', applyFilters);
</script>
</x-app-layout>