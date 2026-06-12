<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}!</h1>
            <p>Selamat datang di dashboard RelaxIn. Di sini nanti kamu bisa lihat riwayat booking kamu.</p>
        </div>

        <div class="mt-10 px-4 md:px-0 max-w-5xl mx-auto">
    <h2 class="text-xl font-bold text-white mb-6 tracking-wide">Riwayat Booking Kamu</h2>

    {{-- Cek jika data booking kosong --}}
    @if($bookings->isEmpty())
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8 text-center text-gray-400 shadow-lg">
            <p class="text-base">Kamu belum memiliki riwayat pemesanan hotel saat ini.</p>
        </div>
    @else
        {{-- Jika ada data, lakukan perulangan --}}
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 hover:border-cyan-500/40 transition-all duration-200 shadow-lg">
                    <div>
                        {{-- Nama Hotel --}}
                        <h3 class="text-lg font-bold text-white tracking-wide">{{ $booking->hotel->nama ?? 'Nama Hotel' }}</h3>
                        {{-- Detail Tipe Kamar --}}
                        <p class="text-sm text-gray-400 mt-1">
                            Tipe Kamar: <span class="text-cyan-400 font-medium">{{ $booking->kamar->tipe_kamar ?? 'N/A' }}</span>
                        </p>
                        {{-- Tanggal Pemesanan --}}
                        <p class="text-xs text-gray-500 mt-3 flex items-center gap-1">
                            📅 {{ \Carbon\Carbon::parse($booking->tgl_checkin)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($booking->tgl_checkout)->format('d M Y') }}
                        </p>
                    </div>

                    <div class="text-left md:text-right w-full md:w-auto border-t md:border-t-0 border-gray-700 pt-4 md:pt-0 flex flex-col md:items-end justify-between">
                        <div>
                            <p class="text-xs text-gray-400">Total Pembayaran</p>
                            <p class="text-lg font-extrabold text-cyan-400 mt-0.5">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                        </div>
                        
                        {{-- Status Badge Dinamis --}}
                        <div class="mt-3">
                            @if(strtolower($booking->status) == 'pending' || $booking->status == 'Menunggu Konfirmasi')
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-amber-500/10 text-amber-400 rounded-full border border-amber-500/20">
                                    ⏳ Menunggu Konfirmasi
                                </span>
                            @elseif(strtolower($booking->status) == 'confirmed' || $booking->status == 'Berhasil')
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-green-500/10 text-green-400 rounded-full border border-green-500/20">
                                    ✅ Berhasil
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-500/10 text-red-400 rounded-full border border-red-500/20">
                                    ❌ Dibatalkan (Nilai: {{ $booking->status }})
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
    </div>
</x-app-layout>