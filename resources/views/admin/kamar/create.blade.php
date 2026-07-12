<x-admin>
<x-slot name="title">Tambah Kamar</x-slot>
<div class="pt-24 pb-16 px-4 md:px-8 max-w-3xl mx-auto" style="font-family: 'Inter', sans-serif;">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.kamar.index', $hotel) }}" class="inline-flex items-center gap-1.5 text-base text-primary hover:underline mb-3">
            ← Kembali ke daftar kamar
        </a>
        <h1 class="text-4xl" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">Tambah Kamar</h1>
        <p class="text-slate-400 text-base mt-1">Hotel: <span class="font-semibold text-slate-600">{{ $hotel->nama }}</span></p>
    </div>

    <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
        <form method="POST" action="{{ route('admin.kamar.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Input hidden untuk id_hotel agar terhubung dengan relasi hotel --}}
            <input type="hidden" name="id_hotel" value="{{ $hotel->id_hotel }}">

            {{-- Tipe & Kode Kamar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="tipe_kamar" class="block text-base font-semibold text-slate-700 mb-1.5">Tipe Kamar <span class="text-rose">*</span></label>
                    <input
                        id="tipe_kamar"
                        type="text"
                        name="tipe_kamar"
                        value="{{ old('tipe_kamar') }}"
                        required
                        placeholder="cth. Standard"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('tipe_kamar') border-rose @enderror"
                    >
                    @error('tipe_kamar') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="kode_kamar" class="block text-base font-semibold text-slate-700 mb-1.5">Kode Kamar <span class="text-rose">*</span></label>
                    <input
                        id="kode_kamar"
                        type="text"
                        name="kode_kamar"
                        value="{{ old('kode_kamar') }}"
                        required
                        placeholder="cth. KM001"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('kode_kamar') border-rose @enderror"
                        style="font-family: 'IBM Plex Mono', monospace;"
                    >
                    @error('kode_kamar') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Harga & Kapasitas & Total --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="harga_per_kamar" class="block text-base font-semibold text-slate-700 mb-1.5">Harga/Malam (Rp) <span class="text-rose">*</span></label>
                    <input
                        id="harga_per_kamar"
                        type="number"
                        name="harga_per_kamar"
                        value="{{ old('harga_per_kamar') }}"
                        required
                        min="0"
                        placeholder="cth. 500000"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('harga_per_kamar') border-rose @enderror"
                        style="font-family: 'IBM Plex Mono', monospace;"
                    >
                    @error('harga_per_kamar') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="kapasitas" class="block text-base font-semibold text-slate-700 mb-1.5">Kapasitas Tamu <span class="text-rose">*</span></label>
                    <input
                        id="kapasitas"
                        type="number"
                        name="kapasitas"
                        value="{{ old('kapasitas', 2) }}"
                        required
                        min="1"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('kapasitas') border-rose @enderror"
                        style="font-family: 'IBM Plex Mono', monospace;"
                    >
                    @error('kapasitas') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="total_kamar" class="block text-base font-semibold text-slate-700 mb-1.5">Total Stok Kamar <span class="text-rose">*</span></label>
                    <input
                        id="total_kamar"
                        type="number"
                        name="total_kamar"
                        value="{{ old('total_kamar', 1) }}"
                        required
                        min="1"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-base
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('total_kamar') border-rose @enderror"
                        style="font-family: 'IBM Plex Mono', monospace;"
                    >
                    @error('total_kamar') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Foto Kamar --}}
           <div>
                <label for="gambar" class="block text-base font-semibold text-slate-700 mb-1.5">Foto Utama Hotel</label>
                <input
                    id="gambar"
                    type="file"
                    name="gambar"
                    accept="image/*"
                    class="w-full text-base text-slate-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-full file:border-0 file:text-base file:font-semibold
                           file:bg-ice-cyan file:text-primary hover:file:bg-primary/10
                           @error('gambar') border-rose @enderror"
                >
                @error('gambar') <p class="text-rose text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.kamar.index') }}" class="btn-outline">Batal</a>
                <button type="submit" class="btn-primary">Simpan Kamar</button>
            </div>
        </form>
    </div>
</div>
</x-admin>