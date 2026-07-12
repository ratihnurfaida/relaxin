<x-app-layout>
<div class="min-h-screen bg-slate-50 px-4 md:px-8 py-12" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-5xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8">
            <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Langkah Terakhir</p>
            <h1 class="text-3xl leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Selesaikan Pembayaran</h1>
            <p class="text-slate-400 text-base mt-1">Reservasi kamu akan otomatis dibatalkan kalau tidak dibayar sebelum waktu habis.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-start">

            {{-- ===== KOLOM KIRI: FORM PEMBAYARAN ===== --}}
            <div class="md:col-span-3 space-y-5">

                {{-- Countdown --}}
                <div id="countdown-box" style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
                    <div class="w-11 h-11 bg-white border border-cyan-100 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="1.8" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold" style="color: #155E75;">Selesaikan pembayaran dalam</p>
                        <span id="timer" class="text-2xl font-bold" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">--:--</span>
                    </div>
                </div>

                {{-- Form Upload --}}
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 md:p-8">
                    <h2 class="text-xl mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Upload Bukti Pembayaran</h2>
                    <p class="text-slate-400 text-sm mb-6">Transfer sesuai nominal total, lalu upload screenshot atau foto struk.</p>

                    <form action="{{ route('booking.confirm', $booking->id_booking) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        {{-- Metode Pembayaran --}}
                        <div>
                            <label class="block text-base font-semibold text-slate-700 mb-1.5">Pilih Metode Pembayaran</label>
                            <select name="metode_payment"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                                       focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white transition duration-150"
                                required>
                                <option value="transfer_bank">Transfer Bank (BCA 12345678)</option>
                                <option value="kartu_kredit">Kartu Kredit</option>
                            </select>
                        </div>

                        {{-- Info rekening tujuan --}}
                        <div style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-xl px-4 py-3.5 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-500" style="font-family: 'IBM Plex Mono', monospace;">Transfer ke</p>
                                <p class="text-base font-bold text-slate-800 mt-0.5">BCA — a.n. PT RelaXin Indonesia</p>
                            </div>
                            <p class="text-lg font-bold flex-shrink-0" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">12345678</p>
                        </div>

                        {{-- Upload File --}}
                        <div>
                            <label class="block text-base font-semibold text-slate-700 mb-1.5">Upload Bukti Transfer</label>
                            <input type="file" name="bukti_payment" accept="image/*" required
                                class="w-full text-base text-slate-500 file:mr-4 file:py-2.5 file:px-5
                                       file:rounded-xl file:border-0 file:text-base file:font-semibold
                                       file:bg-cyan-100 file:text-cyan-700 hover:file:bg-cyan-200 file:transition-colors
                                       border border-slate-200 bg-slate-50 rounded-xl px-2 py-2">
                            <p class="text-sm text-slate-400 mt-1.5">Format JPG/PNG, maksimal 2MB.</p>
                        </div>

                        <button type="submit"
                            class="w-full text-white font-bold text-base py-3.5 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150"
                            style="background-color: #0E7490;" onmouseover="this.style.backgroundColor='#0C6280'" onmouseout="this.style.backgroundColor='#0E7490'">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>

            {{-- ===== KOLOM KANAN: RINCIAN PESANAN ===== --}}
            <div class="md:col-span-2">
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden sticky top-6">

                    <div style="background-color: #ecfbfc;" class="p-6 border-b border-cyan-100">
                        <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Ringkasan Pesanan</p>
                        <h2 class="text-xl leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">
                            {{ $booking->hotel->nama ?? 'Hotel RelaXin' }}
                        </h2>
                        <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                            📍 {{ $booking->hotel->kota ?? 'Bandung' }}
                        </p>
                    </div>

                    <div class="p-6 space-y-4">

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">Tipe Kamar</span>
                            <span class="text-sm font-bold text-slate-800">{{ $booking->kamar->tipe_kamar ?? 'Standard' }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">Jadwal Menginap</span>
                            <span class="text-sm font-semibold text-slate-700" style="font-family: 'IBM Plex Mono', monospace;">
                                {{ \Carbon\Carbon::parse($booking->tgl_checkin)->format('d M') }}
                                <span class="mx-1" style="color:#67C7DA;">→</span>
                                {{ \Carbon\Carbon::parse($booking->tgl_checkout)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">Lama Menginap</span>
                            <span class="text-sm font-bold px-2 py-0.5 rounded-md bg-cyan-100/70 border border-cyan-200/40" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">
                                {{ $booking->total_malam }} malam
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">Jumlah Kamar</span>
                            <span class="text-sm font-semibold text-slate-700" style="font-family: 'IBM Plex Mono', monospace;">{{ $booking->jumlah_kamar }} unit</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">Jumlah Tamu</span>
                            <span class="text-sm font-semibold text-slate-700" style="font-family: 'IBM Plex Mono', monospace;">{{ $booking->total_tamu }} orang</span>
                        </div>

                        <div class="pt-4 border-t border-dashed border-slate-200">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Total Bayar</p>
                            <p class="text-3xl font-bold" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Sudah termasuk pajak & biaya layanan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var expiredString = "{{ session('payment_expired_at') }}";

    if (expiredString) {
        var expiredAt = new Date(expiredString).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = expiredAt - now;

            var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var s = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = m + "m " + s + "s";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Waktu Habis";
                window.location.href = "{{ route('welcome') }}";
            }
        }, 1000);
    } else {
        document.getElementById("timer").innerHTML = "Tidak ada sesi aktif";
    }
</script>
</x-app-layout>