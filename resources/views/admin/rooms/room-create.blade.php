@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="pt-24 pb-16 px-4 md:px-8 max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('hotels.rooms.index', $hotel) }}" class="inline-flex items-center gap-1.5 text-sm text-primary hover:underline mb-3">
            ← Kembali ke daftar kamar
        </a>
        <h1 class="font-display text-3xl font-black text-slate-900">Tambah Kamar</h1>
        <p class="text-slate-400 text-sm mt-1">Hotel: <span class="font-semibold text-slate-600">{{ $hotel->name }}</span></p>
    </div>

    <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
        <form method="POST" action="{{ route('hotels.rooms.store', $hotel) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Tipe & Nomor Kamar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="room_type" class="block text-sm font-semibold text-slate-700 mb-1.5">Tipe Kamar <span class="text-rose">*</span></label>
                    <select
                        id="room_type"
                        name="room_type"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('room_type') border-rose @enderror"
                    >
                        <option value="">-- Pilih tipe --</option>
                        @foreach (['Standard', 'Deluxe', 'Superior', 'Suite', 'Executive', 'Presidential Suite'] as $type)
                            <option value="{{ $type }}" {{ old('room_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('room_type') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="room_number" class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Kamar <span class="text-rose">*</span></label>
                    <input
                        id="room_number"
                        type="text"
                        name="room_number"
                        value="{{ old('room_number') }}"
                        required
                        placeholder="cth. 101, A-201"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('room_number') border-rose @enderror"
                    >
                    @error('room_number') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Harga & Kapasitas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="price_per_night" class="block text-sm font-semibold text-slate-700 mb-1.5">Harga/Malam (Rp) <span class="text-rose">*</span></label>
                    <input
                        id="price_per_night"
                        type="number"
                        name="price_per_night"
                        value="{{ old('price_per_night') }}"
                        required
                        min="0"
                        placeholder="cth. 350000"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300 @error('price_per_night') border-rose @enderror"
                    >
                    @error('price_per_night') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="capacity" class="block text-sm font-semibold text-slate-700 mb-1.5">Kapasitas Tamu <span class="text-rose">*</span></label>
                    <input
                        id="capacity"
                        type="number"
                        name="capacity"
                        value="{{ old('capacity', 2) }}"
                        required
                        min="1"
                        max="10"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('capacity') border-rose @enderror"
                    >
                    @error('capacity') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Ukuran & Lantai --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="size_sqm" class="block text-sm font-semibold text-slate-700 mb-1.5">Ukuran (m²)</label>
                    <input
                        id="size_sqm"
                        type="number"
                        name="size_sqm"
                        value="{{ old('size_sqm') }}"
                        min="0"
                        placeholder="cth. 28"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               placeholder:text-slate-300"
                    >
                </div>
                <div>
                    <label for="bed_type" class="block text-sm font-semibold text-slate-700 mb-1.5">Tipe Kasur</label>
                    <select
                        id="bed_type"
                        name="bed_type"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary"
                    >
                        <option value="">-- Pilih tipe kasur --</option>
                        @foreach (['Single', 'Double', 'Twin', 'King', 'Queen'] as $bed)
                            <option value="{{ $bed }}" {{ old('bed_type') === $bed ? 'selected' : '' }}>{{ $bed }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Kamar</label>
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    placeholder="Deskripsikan kamar secara singkat..."
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           placeholder:text-slate-300 resize-none"
                >{{ old('description') }}</textarea>
            </div>

            {{-- Fasilitas Kamar --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Fasilitas Kamar</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach (['AC', 'TV', 'WiFi', 'Kulkas', 'Bathtub', 'Shower', 'Balkon', 'Safe Box', 'Hair Dryer', 'Minibar', 'Sofa', 'Meja Kerja'] as $facility)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility }}"
                                {{ in_array($facility, old('facilities', [])) ? 'checked' : '' }}
                                class="rounded border-slate-300 text-primary focus:ring-primary/40"
                            >
                            <span class="text-sm text-slate-600">{{ $facility }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Status Ketersediaan --}}
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-1.5">Status Ketersediaan</label>
                <select
                    id="status"
                    name="status"
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary"
                >
                    <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="occupied"  {{ old('status') === 'occupied'  ? 'selected' : '' }}>Terisi</option>
                    <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            {{-- Foto Kamar --}}
            <div>
                <label for="photo" class="block text-sm font-semibold text-slate-700 mb-1.5">Foto Kamar</label>
                <input
                    id="photo"
                    type="file"
                    name="photo"
                    accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-full file:border-0 file:text-sm file:font-semibold
                           file:bg-ice-cyan file:text-primary hover:file:bg-primary/10"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('hotels.rooms.index', $hotel) }}" class="btn-outline">Batal</a>
                <button type="submit" class="btn-primary">Simpan Kamar</button>
            </div>
        </form>
    </div>
</div>
@endsection
