<x-app-layout>
<div class="min-h-screen bg-slate-50 flex items-center justify-center py-12 px-4" style="font-family: 'Inter', sans-serif;">
    <div class="w-full max-w-lg">

        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-cyan-600 mb-4 transition-colors">
            ← Kembali ke Dashboard
        </a>

        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 md:p-8">

            <div class="flex items-center gap-2 mb-1">
                <span class="text-2xl">⚠️</span>
                <h1 class="text-2xl" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Upload Ulang Bukti Pembayaran</h1>
            </div>
            <p class="text-sm text-slate-400 mb-5">Bukti transfer kamu ditolak admin, silakan unggah ulang yang benar.</p>

            {{-- Alasan penolakan --}}
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 mb-5">
                <p class="text-xs font-bold text-rose-700 uppercase tracking-wide mb-1">Alasan Penolakan</p>
                <p class="text-sm text-rose-800">{{ $booking->payment->alasan_penolakan ?? 'Bukti pembayaran tidak sesuai.' }}</p>
            </div>

            {{-- Ringkasan booking --}}
            <div class="flex gap-4 mb-6 pb-6 border-b border-dashed border-slate-200">
                <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                    <img src="{{ $booking->kamar->gambar ? asset('fotohotel/' . $booking->kamar->gambar) : asset('fotohotel/hotelaston.jpg') }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-slate-900 truncate">{{ $booking->hotel->nama ?? 'Hotel RelaXin' }}</h3>
                    <p class="text-sm text-slate-500">📍 {{ $booking->hotel->kota ?? 'Bandung' }}</p>
                    <p class="text-sm text-slate-500 mt-1">
                        📅 {{ \Carbon\Carbon::parse($booking->tgl_checkin)->format('d M') }} – {{ \Carbon\Carbon::parse($booking->tgl_checkout)->format('d M Y') }}
                    </p>
                    <p class="text-base font-bold mt-1" style="color: #0E7490;">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Alert error --}}
            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-lg p-3 mb-4">{{ session('error') }}</div>
            @endif
            @error('bukti_payment')
                <div class="bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-lg p-3 mb-4">{{ $message }}</div>
            @enderror

            {{-- Form upload ulang --}}
            <form action="{{ route('booking.updateBukti', $booking->id_booking) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Bukti Transfer Baru</label>
                    <input type="file" name="bukti_payment" accept="image/*" required
                           class="w-full text-sm border border-slate-200 rounded-xl p-2.5 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-cyan-50 file:text-cyan-700 file:font-semibold file:text-sm">
                    <p class="text-xs text-slate-400 mt-1">Format JPG/PNG, maksimal 2MB.</p>
                </div>

                <button type="submit" class="w-full text-white font-bold text-base py-3 rounded-xl transition-colors" style="background-color: #0E7490;">
                    Kirim Ulang Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
</x-app-layout>