<x-app-layout>
<div class="min-h-screen bg-slate-50 px-8 py-10 max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">
        <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-1">Dashboard</p>
        <h1 class="text-3xl font-extrabold text-slate-900">Halo, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-slate-400 text-sm mt-1">Selamat datang kembali di RelaXin. Berikut riwayat booking kamu.</p>
    </div>

    {{-- STATS CARD (Ubah background putih lama ke style #ecfbfc + border cyan tipis) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
        
        {{-- Card 1: Total Booking --}}
        <div style="background-color: #ecfbfc;" class="border border-cyan-200/70 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs font-bold text-cyan-800/80 uppercase tracking-widest mb-1">Total Booking</p>
                <p class="text-3xl font-black text-slate-900">{{ $bookings->count() }}</p>
                <p class="text-xs text-cyan-600 font-semibold mt-1">● semua waktu</p>
            </div>
            <div class="p-3.5 bg-white border border-cyan-100 text-cyan-600 rounded-xl shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        {{-- Card 2: Berhasil --}}
        <div style="background-color: #ecfbfc;" class="border border-cyan-200/70 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs font-bold text-cyan-800/80 uppercase tracking-widest mb-1">Berhasil</p>
                <p class="text-3xl font-black text-emerald-600">
                    {{ $bookings->filter(fn($b) => strtolower($b->status) == 'confirmed' || $b->status == 'Berhasil')->count() }}
                </p>
                <p class="text-xs text-emerald-600 font-semibold mt-1">▲ reservasi dikonfirmasi</p>
            </div>
            <div class="p-3.5 bg-white border border-cyan-100 text-emerald-600 rounded-xl shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        {{-- Card 3: Total Pengeluaran --}}
        <div style="background-color: #ecfbfc;" class="border border-cyan-200/70 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs font-bold text-cyan-800/80 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                <p class="text-3xl font-black text-cyan-600">
                    Rp {{ number_format($bookings->sum('total_harga'), 0, ',', '.') }}
                </p>
                <p class="text-xs text-amber-600 font-semibold mt-1">★ semua transaksi</p>
            </div>
            <div class="p-3.5 bg-white border border-cyan-100 text-amber-500 rounded-xl shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    {{-- RIWAYAT BOOKING (Box Utama diubah ke background #ecfbfc & border cyan tipis) --}}
    <div style="background-color: #ecfbfc;" class="border border-cyan-200/70 rounded-xl shadow-sm overflow-hidden">
        
        {{-- Header Sub-Section (Dibuat putih padat agar kontras pembatasnya jelas) --}}
        <div class="p-5 border-b border-cyan-100 flex items-center justify-between bg-white">
            <div>
                <h2 class="font-bold text-lg text-slate-800 tracking-tight">Riwayat Booking</h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftar semua reservasi hotel kamu di RelaXin.</p>
            </div>
            <span class="px-2.5 py-1 text-xs font-bold rounded-md bg-cyan-100 text-cyan-800">
                {{ $bookings->count() }} reservasi
            </span>
        </div>

        @if($bookings->isEmpty())
            <div class="p-12 text-center bg-white">
                <div class="text-4xl mb-3">🏨</div>
                <p class="text-slate-700 font-bold mb-1">Belum ada booking</p>
                <p class="text-slate-400 text-sm mb-5">Yuk temukan hotel terbaik di Bandung dan mulai perjalananmu!</p>
                <a href="{{ route('welcome') }}"
                   class="inline-block bg-[#0891b2] hover:bg-[#0e7490] text-white font-bold text-sm px-6 py-2.5 rounded-xl transition-colors">
                    Cari Hotel Sekarang
                </a>
            </div>
        @else
            {{-- List Item (Ganti divider garis ke warna cyan-100) --}}
            <div class="divide-y divide-cyan-100/60 bg-white/40">
                @foreach($bookings as $booking)
                    {{-- Hover state diganti ke warna putih padat agar efek transisinya anggun --}}
                    <div class="p-6 flex flex-col md:flex-row justify-between gap-4 hover:bg-white transition-all duration-150">

                        {{-- KIRI: Info Hotel --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 bg-white border border-cyan-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 shadow-sm">
                                🏨
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">{{ $booking->hotel->nama ?? 'Nama Hotel' }}</h3>
                                <p class="text-sm text-gray-500 mt-0.5">
                                    Kamar: <span class="text-cyan-600 font-bold">{{ $booking->kamar->tipe_kamar ?? 'N/A' }}</span>
                                </p>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <span class="text-slate-400 text-xs">📅</span>
                                    <span class="text-xs text-slate-600 font-medium">
                                        {{ \Carbon\Carbon::parse($booking->tgl_checkin)->format('d M Y') }}
                                        <span class="text-cyan-400 mx-1">→</span>
                                        {{ \Carbon\Carbon::parse($booking->tgl_checkout)->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-cyan-700 font-bold ml-1 bg-cyan-100/70 px-2 py-0.5 rounded-md border border-cyan-200/40">
                                        {{ \Carbon\Carbon::parse($booking->tgl_checkin)->diffInDays($booking->tgl_checkout) }} malam
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- KANAN: Harga & Status --}}
                        <div class="flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center gap-3 border-t md:border-t-0 border-cyan-100/50 pt-4 md:pt-0">
                            <div class="text-left md:text-right">
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Pembayaran</p>
                                <p class="text-lg font-black text-cyan-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                            </div>

                            @if(strtolower($booking->status) == 'pending' || $booking->status == 'Menunggu Konfirmasi')
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold bg-amber-50 text-amber-700 rounded-full border border-amber-200 shadow-sm">
                                    ⏳ Menunggu
                                </span>
                            @elseif(strtolower($booking->status) == 'confirmed' || $booking->status == 'Berhasil')
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200 shadow-sm">
                                    ✅ Berhasil
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold bg-red-50 text-red-700 rounded-full border border-red-200 shadow-sm">
                                    ❌ Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
</x-app-layout>