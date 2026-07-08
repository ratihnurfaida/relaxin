<x-app-layout>
    @slot('title', 'Syarat & Ketentuan')

    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-xl shadow-cyan-100/50 border border-slate-100 text-center max-w-4xl w-full">
            <h1 class="text-3xl font-extrabold text-slate-900 mb-3 tracking-tight">Syarat & Ketentuan</h1>
            <p class="text-slate-500 text-sm mb-10 leading-relaxed">
                Berikut adalah syarat dan ketentuan penggunaan platform <span class="text-cyan-600 font-semibold">RelaXin</span>.
            </p>

            {{-- Konten Syarat & Ketentuan --}}
            <div class="text-left text-gray-700 space-y-4">
                <h1 class="font-bold text-lg text-slate-800 mb-3">1. Ketentuan Umum</h1>
                <p>Dengan mengakses atau menggunakan platform RelaXin, Anda dianggap telah membaca, memahami, dan menyetujui seluruh isi syarat dan ketentuan ini.</p>

                <h3 class="font-bold text-lg text-slate-800 mb-3">2. Pemesanan dan Pembayaran</h3>
                <p>Pemesanan Anda akan diproses setelah pembayaran diterima dan diverifikasi oleh sistem. Harga yang tertera dapat berubah sewaktu-waktu sesuai kebijakan hotel mitra.</p>

                <h3 class="font-bold text-lg text-slate-800 mb-3">3. Pembatalan</h3>
                <p>Kebijakan pembatalan dan pengembalian dana (refund) mengikuti aturan masing-masing hotel yang dipilih. RelaXin hanya bertindak sebagai platform penyedia layanan reservasi.</p>
            </div>
        </div>
    </div>
</x-app-layout>