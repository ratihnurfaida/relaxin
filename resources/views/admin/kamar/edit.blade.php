<x-admin>

<div class="pt-24 pb-16 px-4 md:px-8 max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.kamar.index', $hotel) }}" class="inline-flex items-center gap-1.5 text-sm text-primary hover:underline mb-3">
            ← Kembali ke daftar kamar
        </a>
        <h1 class="font-display text-3xl font-black text-slate-900">Edit Kamar</h1>
        <p class="text-slate-400 text-sm mt-1">
            Kamar <span class="font-semibold text-slate-600">{{ $kamar->kode_kamar }}</span> –
            {{ $hotel->nama }}
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
        <form method="POST" action="{{ route('admin.kamar.update', $kamar->id_kamar) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $kamar->id_kamar }}">

            {{-- Tipe & Nomor Kamar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="tipe_kamar" class="block text-sm font-semibold text-slate-700 mb-1.5">Tipe Kamar <span class="text-rose">*</span></label>
                    <input
                        id="tipe_kamar"
                        type="text"
                        name="tipe_kamar"
                        value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                            focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                            @error('tipe_kamar') border-rose @enderror"
                    >
                    @error('tipe_kamar') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="kode_kamar" class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Kamar <span class="text-rose">*</span></label>
                    <input
                        id="kode_kamar"
                        type="text"
                        name="kode_kamar"
                        value="{{ old('kode_kamar', $kamar->kode_kamar) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('kode_kamar') border-rose @enderror"
                    >
                    @error('kode_kamar') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="tipe_bed" class="block text-sm font-semibold text-slate-700 mb-1.5">Tipe Bed <span class="text-rose">*</span>
                    </label>
                        <select
                            id="tipe_bed"
                            name="tipe_bed"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm
                                focus:outline-none focus:ring-2 focus:ring-cyan-500/40 focus:border-cyan-500
                                @error('tipe_bed') border-rose @enderror">
                            <option value="" disabled {{ old('tipe_bed', $kamar->tipe_bed) == '' ? 'selected' : '' }}>
                                Pilih Tipe Bed
                            </option>
                            <option value="Single Bed" {{ old('tipe_bed', $kamar->tipe_bed) == 'Single Bed' ? 'selected' : '' }}>Single Bed</option>
                            <option value="Double Bed" {{ old('tipe_bed', $kamar->tipe_bed) == 'Double Bed' ? 'selected' : '' }}>Double Bed</option>
                            <option value="Twin Bed" {{ old('tipe_bed', $kamar->tipe_bed) == 'Twin Bed' ? 'selected' : '' }}>Twin Bed</option>
                            <option value="Queen Bed" {{ old('tipe_bed', $kamar->tipe_bed) == 'Queen Bed' ? 'selected' : '' }}>Queen Bed</option>
                            <option value="King Bed" {{ old('tipe_bed', $kamar->tipe_bed) == 'King Bed' ? 'selected' : '' }}>King Bed</option>
                        </select>
                    @error('tipe_bed') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="total_kamar" class="block text-sm font-semibold text-slate-700 mb-1.5">Stok Kamar *</label>
                    <input 
                        type="number" 
                        id="total_kamar" 
                        name="total_kamar" 
                        value="{{ old('total_kamar', $kamar->total_kamar) }}" 
                        required 
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg 
                        focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>
            {{-- Harga & Kapasitas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="harga_per_kamar" class="block text-sm font-semibold text-slate-700 mb-1.5">Harga/Malam (Rp) <span class="text-rose">*</span></label>
                    <input
                        id="harga_per_kamar"
                        type="number"
                        name="harga_per_kamar"
                        value="{{ old('harga_per_kamar', $kamar->harga_per_kamar) }}"
                        required
                        min="0"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('harga_per_kamar') border-rose @enderror"
                    >
                    @error('harga_per_kamar') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="kapasitas" class="block text-sm font-semibold text-slate-700 mb-1.5">Kapasitas Tamu <span class="text-rose">*</span></label>
                    <input
                        id="kapasitas"
                        type="number"
                        name="kapasitas"
                        value="{{ old('kapasitas', $kamar->kapasitas) }}"
                        required
                        min="1"
                        max="10"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary"
                    >
                </div>
            </div>


            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-1.5">Status Ketersediaan</label>
                <select
                    id="status"
                    name="status"
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary"
                >
                    <option value="available"   {{ old('status', $kamar->status) === 'available'   ? 'selected' : '' }}>Tersedia</option>
                    <option value="occupied"    {{ old('status', $kamar->status) === 'occupied'    ? 'selected' : '' }}>Terisi</option>
                    <option value="maintenance" {{ old('status', $kamar->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            {{-- Foto Kamar --}}
            <div>
                <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-1.5">Ganti Foto Kamar</label>
                @if ($kamar->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/hotel/' . $kamar->gambar) }}" alt="Foto kamar saat ini" class="h-32 w-auto rounded-xl object-cover">
                        <p class="text-xs text-slate-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input
                    id="gambar"
                    type="file"
                    name="gambar"
                    accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-full file:border-0 file:text-sm file:font-semibold
                           file:bg-ice-cyan file:text-primary hover:file:bg-primary/10"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.kamar.index', $hotel) }}" class="btn-outline">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
</x-admin>