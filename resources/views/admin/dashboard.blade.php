<x-admin :pendingCount="$booking->filter(fn($b) => in_array(strtolower(trim($b->status)), ['pending', 'menunggu konfirmasi']))->count()">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4" style="font-family: 'Inter', sans-serif;">
            <div>
                <h2 class="text-3xl tracking-tight leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">
                    {{ __('Dashboard Utama Admin') }}
                </h2>
                <p class="text-sm font-medium text-slate-400 mt-1">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} Manajemen Reservasi RelaXin
                </p>
            </div>
        </div>
    </x-slot>

    @php
        $totalReservasi = $booking->count();
        $pendapatan = $booking->sum(fn($b) => in_array(strtolower(trim($b->status)), ['confirmed', 'success', 'selesai']) ? $b->total_harga : 0);
        $pendingCount = $booking->filter(fn($b) => in_array(strtolower(trim($b->status)), ['pending', 'menunggu konfirmasi']))->count();
        $confirmedCount = $booking->filter(fn($b) => in_array(strtolower(trim($b->status)), ['confirmed', 'selesai', 'success']))->count();
        $latest = $booking->sortByDesc('created_at')->take(5);
    @endphp

    <div class="py-10 bg-slate-50 min-h-screen" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ── 4 KOTAK STATISTIK ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Total Reservasi --}}
                <div class="relative overflow-hidden bg-white border border-cyan-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-cyan-50"></div>
                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold text-cyan-700/70 uppercase tracking-widest" style="font-family: 'IBM Plex Mono', monospace;">Total Reservasi</p>
                            <h3 class="text-4xl mt-1.5" style="font-family: 'IBM Plex Mono', monospace; font-weight: 600; color: #0F172A;">{{ $totalReservasi }}</h3>
                        </div>
                        <div class="p-2.5 bg-cyan-50 text-cyan-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <p class="relative text-sm text-slate-400 font-medium mt-3">Seluruh pesanan masuk sistem</p>
                </div>

                {{-- Pendapatan --}}
                <div class="relative overflow-hidden bg-white border border-emerald-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-emerald-50"></div>
                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold text-emerald-700/70 uppercase tracking-widest" style="font-family: 'IBM Plex Mono', monospace;">Pendapatan Berhasil</p>
                            <h3 class="text-3xl mt-1.5 leading-tight" style="font-family: 'IBM Plex Mono', monospace; font-weight: 600; color: #059669;">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <p class="relative text-sm text-slate-400 font-medium mt-3">Dari transaksi terkonfirmasi</p>
                </div>

                {{-- Perlu Validasi --}}
                <div class="relative overflow-hidden bg-white border border-amber-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-amber-50"></div>
                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold text-amber-700/70 uppercase tracking-widest" style="font-family: 'IBM Plex Mono', monospace;">Perlu Validasi</p>
                            <h3 class="text-4xl mt-1.5" style="font-family: 'IBM Plex Mono', monospace; font-weight: 600; color: #0F172A;">{{ $pendingCount }}</h3>
                        </div>
                        <div class="p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <a href="{{ route('admin.reservasi') }}" class="relative text-sm text-amber-600 font-bold mt-3 inline-flex items-center gap-1 hover:underline">Tinjau sekarang →</a>
                </div>

                {{-- Hotel Aktif --}}
                <div class="relative overflow-hidden bg-white border border-cyan-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-cyan-50"></div>
                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-xs font-bold text-cyan-700/70 uppercase tracking-widest" style="font-family: 'IBM Plex Mono', monospace;">Mitra Hotel Aktif</p>
                            <h3 class="text-4xl mt-1.5" style="font-family: 'IBM Plex Mono', monospace; font-weight: 600; color: #0F172A;">{{ $total_hotel }}</h3>
                        </div>
                        <div class="p-2.5 bg-amber-50 text-amber-500 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <p class="relative text-sm text-slate-400 font-medium mt-3">Seluruh properti aktif</p>
                </div>
            </div>

            {{-- ── RINGKASAN STATUS ── --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
                <h3 class="text-lg mb-4" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Ringkasan Status Reservasi</h3>
                @php
                    $confirmedPct = $totalReservasi > 0 ? round($confirmedCount / $totalReservasi * 100) : 0;
                    $pendingPct = $totalReservasi > 0 ? round($pendingCount / $totalReservasi * 100) : 0;
                @endphp
                <div class="w-full h-3 rounded-full bg-slate-100 overflow-hidden flex">
                    <div class="h-full bg-emerald-500" style="width: {{ $confirmedPct }}%"></div>
                    <div class="h-full bg-amber-400" style="width: {{ $pendingPct }}%"></div>
                </div>
                <div class="flex gap-6 mt-3 text-sm font-semibold">
                    <span class="flex items-center gap-1.5 text-slate-500"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Terkonfirmasi ({{ $confirmedCount }})</span>
                    <span class="flex items-center gap-1.5 text-slate-500"><span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span> Menunggu ({{ $pendingCount }})</span>
                </div>
            </div>

            {{-- ── PREVIEW RESERVASI TERBARU ── --}}
            <div class="bg-white border border-cyan-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-cyan-100 flex justify-between items-center bg-[#ecfbfc]">
                    <div>
                        <h3 class="text-xl tracking-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Reservasi Terbaru</h3>
                        <p class="text-sm text-cyan-800/60 mt-0.5">5 pesanan paling baru masuk ke sistem.</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 text-left text-base">
                        <thead class="bg-slate-50 text-sm font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200" style="font-family: 'IBM Plex Mono', monospace;">
                            <tr>
                                <th class="px-6 py-3">Tamu</th>
                                <th class="px-6 py-3">Hotel</th>
                                <th class="px-6 py-3 text-center">Check-In</th>
                                <th class="px-6 py-3 text-right">Total</th>
                                <th class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($latest as $item)
                                @php $st = strtolower(trim($item->status ?? 'pending')); @endphp
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="px-6 py-3.5 font-semibold text-slate-800">{{ $item->nama_tamu }}</td>
                                    <td class="px-6 py-3.5 text-slate-600">{{ $item->hotel->nama ?? 'Hotel RelaXin' }}</td>
                                    <td class="px-6 py-3.5 text-center text-slate-600">{{ \Carbon\Carbon::parse($item->tgl_checkin)->format('d M Y') }}</td>
                                    <td class="px-6 py-3.5 text-right font-bold text-slate-900" style="font-family: 'IBM Plex Mono', monospace;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-3.5 text-center">
                                        @if(in_array($st, ['pending', 'menunggu konfirmasi']))
                                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 border border-amber-200">Menunggu</span>
                                        @elseif($st == 'ditolak')
                                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-orange-50 text-orange-600 border border-orange-200">Upload Ulang</span>
                                        @elseif(in_array($st, ['confirmed', 'selesai', 'success']))
                                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200">Terkonfirmasi</span>
                                        @else
                                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-200">Dibatalkan</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-slate-400 italic">Belum ada data reservasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-admin>