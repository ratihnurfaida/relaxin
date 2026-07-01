<x-app-layout>
    @slot('title', 'Form Booking')

    <div class="min-h-screen bg-slate-50 flex flex-col lg:flex-row">
    
        {{-- ── KIRI: SIDE PANEL (Soft Cyan Palette) ── --}}
        <aside class="w-full lg:w-5/12 bg-cyan-800 p-8 lg:p-12 flex flex-col justify-between lg:sticky lg:top-0 lg:h-screen">
            <div>
                <span class="text-xs font-bold tracking-widest text-cyan-200 uppercase">RelaXin Hotels</span>
            </div>
    
            <div class="my-12 lg:my-0">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Your perfect<br>
                    <span class="text-cyan-300">escape</span> awaits
                </h1>
                <p class="text-cyan-100/70 text-sm mt-4 max-w-sm leading-relaxed">
                    Satu langkah lagi untuk menikmati pengalaman menginap terbaik dengan kenyamanan ekstra.
                </p>
            </div>
    
            @isset($hotel)
            <div class="border-t border-white/20 pt-6">
                <p class="text-xs text-cyan-300/70 uppercase tracking-wider font-semibold mb-2">Destinasi Anda</p>
                <h3 class="text-xl font-bold text-white">{{ $hotel->nama }}</h3>
                <p class="text-sm text-cyan-100/70 mt-1">📍 {{ $hotel->kota ?? 'Bandung' }}</p>
            </div>
            @endisset
        </aside>
    
        {{-- ── KANAN: FORM PANEL (Soft Cyan Accents) ── --}}
        <main class="w-full lg:w-7/12 bg-white px-6 py-10 md:px-12 lg:py-14 overflow-y-auto">
            
            <div class="mb-10 pb-6 border-b border-slate-100">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Formulir Reservasi</h2>
                <p class="text-slate-400 text-sm mt-1">Silakan isi data kontak dan detail penginapan Anda dengan benar.</p>
            </div>
    
            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-lg">
                <p class="text-red-800 font-medium text-sm">Mohon periksa kembali inputan Anda:</p>
                <ul class="list-disc list-inside text-red-700 text-xs mt-1 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    
            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <input type="hidden" name="id_hotel" value="{{ $selected_hotel ?? $hotel->id_hotel ?? '' }}">
    
                <div class="space-y-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Informasi Kontak</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_tamu" value="{{ old('nama_tamu', auth()->user()->name ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email_tamu" value="{{ old('email_tamu', auth()->user()->email ?? '') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">No. Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">No. KTP / Paspor</label>
                            <input type="text" name="no_identitas" value="{{ old('no_identitas') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition">
                        </div>
                    </div>
                </div>
    
                <div class="space-y-5 pt-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Detail Penginapan</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Tanggal Check-in <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_checkin" id="tgl_checkin" value="{{ old('tgl_checkin') }}" min="{{ date('Y-m-d') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Tanggal Check-out <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_checkout" id="tgl_checkout" value="{{ old('tgl_checkout') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Tipe Kamar <span class="text-red-500">*</span></label>
                            <select name="id_kamar" id="id_kamar" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition cursor-pointer" required>
                                <option value="" disabled {{ old('id_kamar', $selected_kamar ?? '') ? '' : 'selected' }}>Pilih tipe kamar</option>
                                @isset($kamar)
                                    @foreach($kamar as $k)
                                    <option value="{{ $k->id_kamar }}" data-harga="{{ $k->harga_per_kamar }}" {{ old('id_kamar', $selected_kamar ?? '') == $k->id_kamar ? 'selected' : '' }}>
                                        {{ $k->tipe_kamar }} — Rp {{ number_format($k->harga_per_kamar, 0, ',', '.') }}/malam
                                    </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Jumlah Kamar <span class="text-red-500">*</span></label>
                            <select name="jumlah_kamar" id="jumlah_kamar" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition cursor-pointer" required>
                                @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('jumlah_kamar', 1) == $i ? 'selected' : '' }}>{{ $i }} Kamar</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Jumlah Tamu <span class="text-red-500">*</span></label>
                            <input type="number" name="total_tamu" id="tamuInput" min="1" max="10" value="{{ old('total_tamu', 2) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition" required>
                        </div>
                    </div>
                </div>
    
                <div class="space-y-3 pt-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Permintaan Khusus (Opsional)</h3>
                    <textarea name="catatan" rows="3" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition resize-none">{{ old('catatan') }}</textarea>
                </div>
    
            
    
                <div class="pt-6 border-t border-slate-100 space-y-3">
                    <div class="flex justify-between text-sm text-slate-600">
                        <span id="summaryRoom" class="font-medium text-slate-800">Tipe Kamar</span>
                        <span id="summaryNightPrice" class="font-semibold text-slate-800">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-xs text-slate-400 -mt-1">
                        <span id="summaryDuration">1 kamar × 1 malam</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-600">
                        <span>Pajak (10%)</span>
                        <span id="summaryTax">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                        <span class="text-base font-bold text-slate-900">Total Pembayaran</span>
                        <span class="text-2xl font-black text-cyan-600" id="summaryTotal">Rp —</span>
                    </div>
                    <input type="hidden" name="total_harga" id="totalHargaInput" value="{{ old('total_harga') }}">
                </div>
    
                <div class="flex flex-col sm:flex-row-reverse gap-3 pt-4">
                    <button type="submit" class="w-full sm:w-auto sm:px-8 py-3 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-all text-center">
                        Konfirmasi Reservasi
                    </button>
                    <a href="{{ url()->previous() }}" class="w-full sm:w-auto sm:px-6 py-3 bg-white border border-slate-200 text-slate-500 hover:text-slate-800 hover:bg-slate-50 text-sm font-medium rounded-lg text-center transition">
                        Kembali
                    </a>
                </div>
            </form>
        </main>
    </div>

    {{-- Script Tetap --}}
    <script>
    function updateDateDisplay() { updateHarga(); }
    function updateHarga() {
        const ciVal = document.getElementById('tgl_checkin').value;
        const coVal = document.getElementById('tgl_checkout').value;
        const kamarSel = document.getElementById('id_kamar');
        const jmlKamar = parseInt(document.getElementById('jumlah_kamar').value) || 1;
        if (!kamarSel.value) return;
        const opt = kamarSel.options[kamarSel.selectedIndex];
        const hargaRaw = opt.getAttribute('data-harga') || '0';
        const harga = parseInt(hargaRaw.replace(/[^0-9]/g, '')) || 0; 
        const namaKamar = opt.text.split(' — ')[0];
        document.getElementById('summaryRoom').textContent = namaKamar;
        document.getElementById('summaryNightPrice').textContent = 'Rp ' + fmt(harga);
        let malam = 1;
        if (ciVal && coVal) {
            const hitungMalam = Math.round((new Date(coVal) - new Date(ciVal)) / 86400000);
            if (hitungMalam > 0) malam = hitungMalam;
        }
        const subtotal = harga * malam * jmlKamar;
        const pajak = Math.round(subtotal * 0.1);
        const total = subtotal + pajak;
        document.getElementById('summaryDuration').textContent = `${jmlKamar} kamar × ${malam} malam`;
        document.getElementById('summaryTax').textContent = 'Rp ' + fmt(pajak);
        document.getElementById('summaryTotal').textContent = 'Rp ' + fmt(total);
        document.getElementById('totalHargaInput').value = total;
    }
    function fmt(n) { return n.toLocaleString('id-ID'); }
    function togglePaymentMethod() {
        const paymentMethod = document.getElementById('metode_payment').value;
        const bankSection = document.getElementById('bankTransferDetails');
        const fileInput = document.getElementById('bukti_payment');
        if (paymentMethod === 'transfer_bank') {
            bankSection.classList.remove('hidden');
            fileInput.setAttribute('required', 'required');
        } else {
            bankSection.classList.add('hidden');
            fileInput.removeAttribute('required');
        }
    }
    document.getElementById('tgl_checkin').addEventListener('change', function () {
        const next = new Date(this.value);
        next.setDate(next.getDate() + 1);
        const minCo = next.toISOString().split('T')[0];
        const coEl = document.getElementById('tgl_checkout');
        coEl.min = minCo;
        if (!coEl.value || coEl.value <= this.value) coEl.value = minCo;
        updateDateDisplay();
    });
    document.getElementById('tgl_checkout').addEventListener('change', updateDateDisplay);
    document.getElementById('id_kamar').addEventListener('change', updateHarga);
    document.getElementById('jumlah_kamar').addEventListener('change', updateHarga);
    document.getElementById('metode_payment').addEventListener('change', togglePaymentMethod);
    document.addEventListener('DOMContentLoaded', function() {
        updateHarga();
        togglePaymentMethod();
    });
    </script>
</x-app-layout>