<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight leading-tight">
                    {{ __('Dashboard Utama Admin') }}
                </h2>
                <p class="text-xs font-medium text-slate-400 mt-1">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} — Manajemen Reservasi RelaXin
                </p>
            </div>
            {{-- Navigasi Cepat Tambahan --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.hotel.index') }}" class="px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:text-slate-900 hover:bg-slate-50 rounded-lg text-xs font-semibold shadow-sm transition">
                    🏨 Kelola Hotel
                </a>
                <a href="{{ route('admin.kamar.index') }}" class="px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:text-slate-900 hover:bg-slate-50 rounded-lg text-xs font-semibold shadow-sm transition">
                    🛏️ Kelola Kamar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- ── 3 KOTAK STATISTIK UTAMA ── --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Box 1: Total Reservasi --}}
                <div class="bg-white overflow-hidden border border-slate-200/80 rounded-xl p-6 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Reservasi</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $booking->count() }}</h3>
                        <div class="flex items-center gap-1 text-xs text-cyan-600 font-semibold mt-2">
                            <span>●</span> Total pesanan masuk sistem
                        </div>
                    </div>
                    <div class="p-3.5 bg-cyan-50 text-cyan-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>

                {{-- Box 2: Pendapatan Riil --}}
                <div class="bg-white overflow-hidden border border-slate-200/80 rounded-xl p-6 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pendapatan Berhasil</p>
                        <h3 class="text-3xl font-black text-emerald-600 mt-1">
                            Rp {{ number_format($booking->sum(fn($b) => in_array(strtolower($b->status), ['confirmed', 'success', 'berhasil']) ? $b->total_harga : 0), 0, ',', '.') }}
                        </h3>
                        <div class="flex items-center gap-1 text-xs text-emerald-600 font-semibold mt-2">
                            <span>▲</span> Dari transaksi berstatus Confirmed
                        </div>
                    </div>
                    <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                {{-- Box 3: Hotel Terintegrasi --}}
                <div class="bg-white overflow-hidden border border-slate-200/80 rounded-xl p-6 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mitra Hotel Aktif</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $total_hotels ?? 47 }}</h3>
                        <div class="flex items-center gap-1 text-xs text-amber-600 font-semibold mt-2">
                            <span>★</span> Seluruh properti aktif
                        </div>
                    </div>
                    <div class="p-3.5 bg-amber-50 text-amber-500 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
            </div>

            {{-- ── TABEL RESERVASI TERKINI ── --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800 tracking-tight">Antrean Kontrol Reservasi</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Daftar pesanan masuk yang memerlukan tindakan validasi manual admin.</p>
                    </div>
                    <span class="px-2.5 py-1 text-xs font-bold rounded-md bg-slate-200/80 text-slate-700">
                        {{ $booking->filter(fn($b) => in_array(strtolower($b->status), ['pending', 'menunggu konfirmasi']))->count() }} Perlu Validasi
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3.5">Tamu & Kontak</th>
                                <th class="px-6 py-3.5">Hotel / Area</th>
                                <th class="px-6 py-3.5 text-center">Jadwal Check-In</th>
                                <th class="px-6 py-3.5 text-center">Bukti Bayar</th> 
                                <th class="px-6 py-3.5 text-center">Status</th>
                                <th class="px-6 py-3.5 text-right">Total Transaksi</th>
                                <th class="px-6 py-3.5 text-center">Konfirmasi Tindakan</th> 
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($booking as $item)
                            <tr class="hover:bg-slate-50/70 transition">
                                {{-- Kolom Tamu --}}
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ $item->nama_tamu }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5 font-medium">
                                        {{ $item->total_malam }} malam • {{ $item->kamar->tipe_kamar ?? 'Kamar Standar' }} ({{ $item->jumlah_kamar }} unit)
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $item->email_tamu }}</div>
                                </td>
                                
                                {{-- Kolom Hotel --}}
                                <td class="px-6 py-4 text-slate-700 font-medium">
                                    <div class="text-slate-800">{{ $item->hotel->nama ?? 'Hotel RelaXin' }}</div>
                                    <span class="inline-flex items-center text-[11px] text-cyan-600 mt-0.5 font-semibold">
                                        📍 {{ $item->hotel->kota ?? 'Bandung' }}
                                    </span>
                                </td>
                                
                                {{-- Kolom Check-In --}}
                                <td class="px-6 py-4 text-center font-medium text-slate-700">
                                    <div class="text-sm bg-slate-100 inline-block px-2.5 py-1 rounded-md border border-slate-200/60">
                                        {{ \Carbon\Carbon::parse($item->tgl_checkin)->format('d M Y') }}
                                    </div>
                                </td>

                                {{-- Kolom Gambar Bukti Bayar --}}
                                <td class="px-6 py-4 text-center">
                                    @if($item->bukti_payment)
                                        <a href="{{ asset('storage/bukti_transfer/' . $item->bukti_payment) }}" target="_blank" class="inline-block group relative">
                                            <img src="{{ asset('storage/bukti_transfer/' . $item->bukti_payment) }}" alt="Bukti Transfer" class="w-10 h-10 object-cover rounded-lg border border-slate-200 hover:scale-110 transition shadow-sm mx-auto">
                                            <span class="absolute hidden group-hover:block bottom-12 left-1/2 transform -translate-x-1/2 bg-slate-900 text-white text-[10px] py-0.5 px-2 rounded whitespace-nowrap z-10 shadow">Klik Perbesar</span>
                                        </a>
                                    @ graves else
                                        <span class="text-xs text-slate-400 italic font-medium bg-slate-50 px-2 py-1 rounded border border-dashed border-slate-200">Bukan Transfer</span>
                                    @endif
                                </td>
                                
                                {{-- Kolom Status Badge --}}
                                <td class="px-6 py-4 text-center">
                                    @if(in_array(strtolower($item->status), ['confirmed', 'success', 'berhasil']))
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">
                                            ✅ Berhasil
                                        </span>
                                    @elseif(in_array(strtolower($item->status), ['pending', 'menunggu konfirmasi']))
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 rounded-full">
                                            ⏳ Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200 rounded-full">
                                            ❌ {{ $item->status }}
                                        </span>
                                    @endif
                                </td>
                                
                                {{-- Kolom Total Harga --}}
                                <td class="px-6 py-4 text-right font-black text-slate-900 text-base">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>

                                {{-- Kolom Tombol Aksi Admin --}}
                                <td class="px-6 py-4 text-center">
                                    @if(in_array(strtolower($item->status), ['pending', 'menunggu konfirmasi']))
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Tombol Setuju (Confirmed) --}}
                                        <form method="POST" action="{{ route('admin.booking.status', $item->id_booking) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Confirmed">
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin MENYETUJUI reservasi ini?')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-3 py-1.5 rounded-lg shadow-sm transition-all hover:shadow" title="Setujui Pemesanan">
                                                ✓ Setuju
                                            </button>
                                        </form>
                                        
                                        {{-- Tombol Tolak (Cancelled) --}}
                                        <form method="POST" action="{{ route('admin.booking.status', $item->id_booking) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Cancelled">
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin MENOLAK reservasi ini?')" class="bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 font-bold text-xs px-2.5 py-1.5 rounded-lg transition-all" title="Tolak Pemesanan">
                                                ✕ Tolak
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                        <div class="text-xs text-slate-400 italic font-medium flex items-center justify-center gap-1">
                                            🔒 Locked
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 italic bg-slate-50/30">
                                    <div class="max-w-xs mx-auto space-y-1">
                                        <p class="font-bold text-slate-500 text-sm">Tidak Ada Data</p>
                                        <p class="text-xs text-slate-400">Belum ada data bookingan masuk di database RelaXin.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>