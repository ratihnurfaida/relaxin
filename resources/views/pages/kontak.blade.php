<x-app-layout>

{{-- ===== HERO KONTAK ===== --}}
<section class="px-12 py-20 bg-white" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-3xl mx-auto text-center">
        <p class="text-sm font-bold uppercase tracking-widest mb-2" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">Hubungi Kami</p>
        <h1 class="text-4xl md:text-5xl leading-tight mb-4" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">
            Ada yang Bisa Kami Bantu?
        </h1>
        <p class="text-gray-500 text-lg leading-relaxed">
            Tim RelaXin siap membantu pertanyaan seputar reservasi, pembayaran, atau kerja sama hotel. Pilih cara paling nyaman buat kamu di bawah ini.
        </p>
    </div>
</section>

{{-- ===== INFO KONTAK (3 KARTU) ===== --}}
<section class="px-12 pb-16 bg-white" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- WhatsApp --}}
        <div style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
            <div class="w-12 h-12 bg-white border border-cyan-100 rounded-xl flex items-center justify-center mb-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="1.8" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75a9.72 9.72 0 01-4.874-1.3L2.25 21.75l1.31-4.796A9.72 9.72 0 012.25 12z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.5 9.5c0 3.5 2.5 6 6 6 .5 0 1-.5 1-1v-1l-2-1-1 1c-1-.5-2-1.5-2.5-2.5l1-1-1-2h-1c-.5 0-.5.5-.5 1.5z" />
                </svg>
            </div>
            <h3 class="text-lg mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">WhatsApp</h3>
            <p class="text-gray-500 text-sm mb-3 leading-relaxed">Respon tercepat untuk pertanyaan reservasi & pembayaran.</p>
            <a href="https://wa.me/6281234567890" target="_blank"
               class="inline-flex items-center gap-1.5 font-bold text-base hover:underline" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">
                +62 812-3456-7890 →
            </a>
        </div>

        {{-- Email --}}
        <div style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
            <div class="w-12 h-12 bg-white border border-cyan-100 rounded-xl flex items-center justify-center mb-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="1.8" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <h3 class="text-lg mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Email</h3>
            <p class="text-gray-500 text-sm mb-3 leading-relaxed">Cocok untuk pertanyaan detail atau lampiran dokumen.</p>
            <a href="mailto:support@relaxin.com"
               class="inline-flex items-center gap-1.5 font-bold text-base hover:underline" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">
                support@relaxin.com →
            </a>
        </div>

        {{-- Jam Operasional --}}
        <div style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
            <div class="w-12 h-12 bg-white border border-cyan-100 rounded-xl flex items-center justify-center mb-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="1.8" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Jam Operasional</h3>
            <p class="text-gray-500 text-sm mb-3 leading-relaxed">Tim kami aktif membalas setiap hari, termasuk akhir pekan.</p>
            <p class="font-bold text-base" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">
                08.00 – 22.00 WIB
            </p>
        </div>

    </div>
</section>

{{-- ===== FORM KONTAK + PETA ===== --}}
<section class="px-12 py-16 bg-slate-50 border-t border-b border-gray-100" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-5 gap-10">

        {{-- Form --}}
        <div class="lg:col-span-3 bg-white border border-slate-100 rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Kirim Pesan</h2>
            <p class="text-gray-500 text-sm mb-6">Isi form di bawah, kami akan membalas ke email kamu secepatnya.</p>

            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-700 text-sm rounded-xl px-4 py-3 mb-5 border border-emerald-100 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 text-rose-700 text-sm rounded-xl px-4 py-3 mb-5 border border-rose-100 font-medium">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 text-rose-700 text-sm rounded-xl px-4 py-3 mb-5 border border-rose-100 font-medium">
                    <ul class="space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kontak.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="block text-base font-semibold text-slate-700 mb-1.5">Nama</label>
                        <input
                            id="nama" type="text" name="nama" value="{{ old('nama') }}" required
                            placeholder="Nama kamu"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                                   placeholder-gray-400 transition duration-150 @error('nama') border-rose-400 @enderror">
                        @error('nama') <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-base font-semibold text-slate-700 mb-1.5">Email</label>
                        <input
                            id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="kamu@email.com"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                                   placeholder-gray-400 transition duration-150 @error('email') border-rose-400 @enderror">
                        @error('email') <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="subjek" class="block text-base font-semibold text-slate-700 mb-1.5">Subjek</label>
                    <select id="subjek" name="subjek" required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white transition duration-150">
                        <option value="">-- Pilih topik --</option>
                        <option value="Reservasi & Pembayaran" {{ old('subjek') == 'Reservasi & Pembayaran' ? 'selected' : '' }}>Reservasi & Pembayaran</option>
                        <option value="Pembatalan / Refund" {{ old('subjek') == 'Pembatalan / Refund' ? 'selected' : '' }}>Pembatalan / Refund</option>
                        <option value="Kerja Sama Hotel/Mitra" {{ old('subjek') == 'Kerja Sama Hotel/Mitra' ? 'selected' : '' }}>Kerja Sama Hotel/Mitra</option>
                        <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('subjek') <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="pesan" class="block text-base font-semibold text-slate-700 mb-1.5">Pesan</label>
                    <textarea
                        id="pesan" name="pesan" rows="5" required
                        placeholder="Tulis pertanyaan atau keluhan kamu di sini..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-base text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                               placeholder-gray-400 transition duration-150 resize-none @error('pesan') border-rose-400 @enderror">{{ old('pesan') }}</textarea>
                    @error('pesan') <p class="text-rose-600 text-sm mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-base py-3 rounded-xl transition-all shadow-md shadow-cyan-600/10 active:scale-[0.98] duration-150">
                    Kirim Pesan
                </button>
            </form>
        </div>

        {{-- Info tambahan / peta --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-56 bg-slate-100">
                    <iframe
                        src="https://www.google.com/maps?q=Universitas+Logistik+dan+Bisnis+Internasional,+Bandung&output=embed"
                        class="w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="p-5">
                    <h3 class="text-lg mb-1" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Kantor RelaXin</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Jl. Sariasih No. 54, Sarijadi, Kec. Sukasari,<br> Kota Bandung, Jawa Barat 40151
                    </p>
                </div>
            </div>

            <div style="background-color: #ecfbfc;" class="border border-cyan-200 rounded-2xl p-6">
                <h3 class="text-lg mb-3" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Ikuti Kami</h3>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-white border border-cyan-100 rounded-xl flex items-center justify-center hover:shadow-md transition-all" style="color: #0E7490;" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-5 h-5">
                            <rect x="3" y="3" width="18" height="18" rx="5" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.2" cy="6.8" r="0.6" fill="currentColor" stroke="none" />
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white border border-cyan-100 rounded-xl flex items-center justify-center hover:shadow-md transition-all" style="color: #0E7490;" aria-label="Twitter/X">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M18.9 3H21.5l-5.6 6.4L22.5 21h-5.9l-4.6-6.1L6.6 21H4l6-6.9L3.5 3h6l4.2 5.6L18.9 3z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white border border-cyan-100 rounded-xl flex items-center justify-center hover:shadow-md transition-all" style="color: #0E7490;" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M13.5 21v-7.5H16l.4-3H13.5V8.3c0-.87.24-1.46 1.5-1.46H16.5V4.2C16.2 4.16 15.2 4 14 4c-2.5 0-4.2 1.5-4.2 4.3v2.2H7.3v3h2.5V21h3.7z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===== FAQ SINGKAT ===== --}}
<section class="px-12 py-16 bg-white" style="font-family: 'Inter', sans-serif;">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-2" style="color: #0E7490; font-family: 'IBM Plex Mono', monospace;">FAQ</p>
            <h2 class="text-3xl leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Pertanyaan yang Sering Ditanyakan</h2>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'Berapa lama proses validasi bukti pembayaran?', 'a' => 'Biasanya tim admin memvalidasi dalam 1x24 jam pada hari kerja. Kamu akan melihat status booking berubah otomatis di halaman Dashboard.'],
                ['q' => 'Bagaimana cara membatalkan reservasi?', 'a' => 'Kamu bisa menghubungi kami lewat WhatsApp atau email dengan menyertakan detail booking. Kebijakan refund mengikuti ketentuan masing-masing hotel.'],
                ['q' => 'Apakah harga yang tertera sudah termasuk pajak?', 'a' => 'Ya, seluruh harga yang tampil di RelaXin sudah termasuk pajak dan tanpa biaya tersembunyi.'],
                ['q' => 'Bukti pembayaran saya ditolak, apa yang harus dilakukan?', 'a' => 'Cek alasan penolakan di halaman Dashboard kamu, lalu upload ulang bukti pembayaran yang sesuai melalui tombol yang tersedia di booking terkait.'],
            ] as $i => $faq)
                <details class="group border border-slate-200 rounded-xl px-5 py-4 open:bg-slate-50 transition-colors">
                    <summary class="flex items-center justify-between cursor-pointer list-none">
                        <span class="font-semibold text-slate-800 text-base pr-4">{{ $faq['q'] }}</span>
                        <span class="text-cyan-600 text-xl flex-shrink-0 transition-transform group-open:rotate-45">+</span>
                    </summary>
                    <p class="text-gray-500 text-sm leading-relaxed mt-3">{{ $faq['a'] }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>

</x-app-layout>