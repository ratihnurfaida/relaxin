<x-admin>

<div class="pt-24 pb-16 px-4 md:px-8 max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.hotel.index') }}" class="inline-flex items-center gap-1.5 text-sm text-primary hover:underline mb-3">
            ← Kembali ke daftar hotel
        </a>
        <h1 class="font-display text-3xl font-black text-slate-900">Tambah Hotel Baru</h1>
        <p class="text-slate-400 text-sm mt-1">Isi informasi hotel dengan lengkap dan benar</p>
    </div>

    <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
        <form method="POST" action="{{ route('admin.hotel.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Nama Hotel --}}
            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Hotel <span class="text-rose">*</span></label>
                <input
                    id="nama"
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                    placeholder="cth. The Grand Relaxin Hotel"
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           placeholder:text-slate-300 @error('nama') border-rose @enderror"
                >
                @error('nama') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi <span class="text-rose">*</span></label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    placeholder="Deskripsikan hotel secara singkat..."
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           placeholder:text-slate-300 resize-none @error('deskripsi') border-rose @enderror"
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Lokasi & Kota (2 kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kota" class="block text-sm font-semibold text-slate-700 mb-1.5">Kota <span class="text-rose">*</span></label>
                    <input
                        id="kota"
                        type="text"
                        name="kota"
                        value="{{ old('kota') }}"
                        required
                        placeholder="cth. Bandung"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('kota') border-rose @enderror"
                    >
                    @error('kota') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Lengkap <span class="text-rose">*</span></label>
                    <input
                        id="alamat"
                        type="text"
                        name="alamat"
                        value="{{ old('alamat') }}"
                        required
                        placeholder="Jl. Merdeka No. 10"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('alamat') border-rose @enderror"
                    >
                    @error('alamat') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Bintang & Harga (2 kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kolom Kiri: Rating Bintang -->
                <div>
                    <label for="star_rating" class="block text-sm font-semibold text-slate-700 mb-1.5">Rating Bintang <span class="text-rose">*</span></label>
                    <select id="star_rating" name="star_rating" class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary @error('star_rating') border-rose @enderror">
                        <option value="">-- Pilih bintang --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('star_rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                        @endfor
                    </select>
                    @error('star_rating') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kolom Kanan: Harga -->
                <div>
                    <label for="harga" class="block text-sm font-semibold text-slate-700 mb-1.5">Harga/Malam (Rp) <span class="text-rose">*</span></label>
                    <input id="harga" type="number" name="harga" value="{{ old('harga') }}" required min="0" placeholder="cth. 500000" class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary placeholder:text-slate-300 @error('harga') border-rose @enderror">
                    @error('harga') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- BARU: Kolom Area (Kita taruh di bawahnya agar rapi) -->
                <div class="md:col-span-2">
                    <label for="id_area" class="block text-sm font-semibold text-slate-700 mb-1.5">Area <span class="text-rose">*</span></label>
                    <select id="id_area" name="id_area" class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary @error('id_area') border-rose @enderror" required>
                        <option value="" disabled selected>-- Pilih area --</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id_area }}" {{ old('id_area') == $area->id_area ? 'selected' : '' }}>{{ $area->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_area') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Fasilitas --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Fasilitas</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach (['WiFi Gratis', 'Kolam Renang', 'Parkir', 'Restoran', 'Gym', 'Spa', 'AC', 'Room Service', 'Bar'] as $facility)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility }}"
                                {{ in_array($facility, old('fasilitas', [])) ? 'checked' : '' }}
                                class="rounded border-slate-300 text-primary focus:ring-primary/40"
                            >
                            <span class="text-sm text-slate-600">{{ $facility }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Foto Utama --}}
            <div>
                <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-1.5">Foto Utama Hotel</label>
                <input
                    id="gambar"
                    type="file"
                    name="gambar"
                    accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-full file:border-0 file:text-sm file:font-semibold
                           file:bg-ice-cyan file:text-primary hover:file:bg-primary/10
                           @error('gambar') border-rose @enderror"
                >
                @error('gambar') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.hotel.index') }}" class="btn-outline">Batal</a>
                <button type="submit" class="btn-primary">Simpan Hotel</button>
            </div>
        </form>
    </div>
</div>
</x-admin>
