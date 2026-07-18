<x-admin>
    <x-slot name="title">Edit Hotel</x-slot>
<div class="pt-24 pb-16 px-4 md:px-8 max-w-3xl mx-auto" style="font-family: 'Inter', sans-serif;">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.hotel.index', $hotel->id_hotel) }}" class="inline-flex items-center gap-1.5 text-base text-primary hover:underline mb-3">
            ← Kembali ke daftar hotel
        </a>
        <h1 class="text-4xl" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Edit Hotel</h1>
        <p class="text-slate-400 text-base mt-1">
            Hotel <span class="font-semibold text-slate-600">{{ $hotel->nama }}</span>
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
        <form method="POST" action="{{ route('admin.hotel.update', $hotel->id_hotel) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Hotel --}}
            <div>
                <label for="nama" class="block text-base font-semibold text-slate-700 mb-1.5">Nama Hotel <span class="text-rose">*</span></label>
                <input
                    id="nama"
                    type="text"
                    name="nama"
                    value="{{ old('nama', $hotel->nama) }}"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           placeholder:text-slate-300 @error('nama') border-rose @enderror"
                >
                @error('nama') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="deskripsi" class="block text-base font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           placeholder:text-slate-300 resize-none @error('deskripsi') border-rose @enderror"
                >{{ old('deskripsi', $hotel->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Lokasi & Kota (2 kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kota" class="block text-base font-semibold text-slate-700 mb-1.5">Kota <span class="text-rose">*</span></label>
                    <input
                        id="kota"
                        type="text"
                        name="kota"
                        value="{{ old('kota', $hotel->kota) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('kota') border-rose @enderror"
                    >
                    @error('kota') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="alamat" class="block text-base font-semibold text-slate-700 mb-1.5">Alamat Lengkap <span class="text-rose">*</span></label>
                    <input
                        id="alamat"
                        type="text"
                        name="alamat"
                        value="{{ old('alamat', $hotel->alamat) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('alamat') border-rose @enderror"
                    >
                    @error('alamat') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Bintang & Harga (2 kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="star_rating" class="block text-base font-semibold text-slate-700 mb-1.5">Rating Bintang</label>
                    <select
                        id="star_rating"
                        name="star_rating"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('star_rating') border-rose @enderror"
                    >
                        <option value="">-- Pilih bintang --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('star_rating', $hotel->star_rating) == $i ? 'selected' : '' }}>
                                {{ $i }} Bintang
                            </option>
                        @endfor
                    </select>
                    @error('star_rating') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="harga" class="block text-base font-semibold text-slate-700 mb-1.5">Harga/Malam (Rp) <span class="text-rose">*</span></label>
                    <input
                        id="harga"
                        type="number"
                        name="harga"
                        value="{{ old('harga', $hotel->harga) }}"
                        required
                        min="0"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('harga') border-rose @enderror"
                        style="font-family: 'IBM Plex Mono', monospace;"
                    >
                    @error('harga') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Area --}}
            <div>
                <label for="id_area" class="block text-base font-semibold text-slate-700 mb-1.5">Area <span class="text-rose">*</span></label>
                <select
                    id="id_area"
                    name="id_area"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                        focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                        @error('id_area') border-rose @enderror"
                >
                    <option value="" disabled>-- Pilih area --</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id_area }}" {{ old('id_area', $hotel->id_area) == $area->id_area ? 'selected' : '' }}>
                            {{ $area->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_area') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Fasilitas --}}
            <div>
                <label class="block text-base font-semibold text-slate-700 mb-2">Fasilitas</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @php
                        $fasilitasDb = array_map('trim', explode(',', $hotel->fasilitas ?? ''));
                        $fasilitasDb = array_map('strtolower', $fasilitasDb);
                    @endphp

                    @foreach (['WiFi Gratis', 'Kolam Renang', 'Parkir', 'Restoran', 'Gym', 'Spa', 'AC', 'Room Service', 'Bar'] as $facility)
                        @php
                            $keyword = strtolower(str_replace(['WiFi Gratis', 'Room Service'], ['wifi', 'layanan kamar'], $facility));
                            $isChecked = false;
                            foreach ($fasilitasDb as $dbItem) {
                                if (str_contains($dbItem, $keyword)) {
                                    $isChecked = true;
                                    break;
                                }
                            }
                        @endphp
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility }}"
                                {{ $isChecked ? 'checked' : '' }}
                                class="rounded border-slate-300 text-primary focus:ring-primary/40">
                            <span class="text-base text-slate-600">{{ $facility }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Foto Utama --}}
            <div>
                <label for="gambar" class="block text-base font-semibold text-slate-700 mb-1.5">Ganti Foto Kamar</label>
                @if ($hotel->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('hotel/' . $hotel->gambar) }}" alt="Foto kamar saat ini" class="h-32 w-auto rounded-xl object-cover">
                        <p class="text-sm text-slate-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input
                    id="gambar"
                    type="file"
                    name="gambar"
                    accept="image/*"
                    class="w-full text-base text-slate-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-full file:border-0 file:text-base file:font-semibold
                           file:bg-ice-cyan file:text-primary hover:file:bg-primary/10"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.hotel.index', $hotel->id_hotel) }}" class="btn-outline">Batal</a>
                <button type="submit" class="btn-primary">Simpan Hotel</button>
            </div>
        </form>
    </div>
</div>
</x-admin>