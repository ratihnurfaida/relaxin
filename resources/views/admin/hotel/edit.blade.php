@extends('layouts.app')

@section('title', 'Edit Hotel')

@section('content')
<div class="pt-24 pb-16 px-4 md:px-8 max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('hotels.index') }}" class="inline-flex items-center gap-1.5 text-sm text-primary hover:underline mb-3">
            ← Kembali ke daftar hotel
        </a>
        <h1 class="font-display text-3xl font-black text-slate-900">Edit Hotel</h1>
        <p class="text-slate-400 text-sm mt-1">Perbarui informasi hotel <span class="font-semibold text-slate-600">{{ $hotel->name }}</span></p>
    </div>

    <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
        <form method="POST" action="{{ route('hotels.update', $hotel) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Hotel --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Hotel <span class="text-rose">*</span></label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $hotel->name) }}"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           @error('name') border-rose @enderror"
                >
                @error('name') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                           resize-none @error('description') border-rose @enderror"
                >{{ old('description', $hotel->description) }}</textarea>
                @error('description') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Kota & Alamat --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="city" class="block text-sm font-semibold text-slate-700 mb-1.5">Kota <span class="text-rose">*</span></label>
                    <input
                        id="city"
                        type="text"
                        name="city"
                        value="{{ old('city', $hotel->city) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('city') border-rose @enderror"
                    >
                    @error('city') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="address" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Lengkap <span class="text-rose">*</span></label>
                    <input
                        id="address"
                        type="text"
                        name="address"
                        value="{{ old('address', $hotel->address) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('address') border-rose @enderror"
                    >
                    @error('address') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Bintang & Harga --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="star_rating" class="block text-sm font-semibold text-slate-700 mb-1.5">Rating Bintang</label>
                    <select
                        id="star_rating"
                        name="star_rating"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary"
                    >
                        <option value="">-- Pilih bintang --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('star_rating', $hotel->star_rating) == $i ? 'selected' : '' }}>
                                {{ $i }} Bintang
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="price_per_night" class="block text-sm font-semibold text-slate-700 mb-1.5">Harga/Malam (Rp) <span class="text-rose">*</span></label>
                    <input
                        id="price_per_night"
                        type="number"
                        name="price_per_night"
                        value="{{ old('price_per_night', $hotel->price_per_night) }}"
                        required
                        min="0"
                        class="w-full rounded-xl border border-slate-200 bg-ice-cyan/50 px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary
                               @error('price_per_night') border-rose @enderror"
                    >
                    @error('price_per_night') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
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
                                {{ in_array($facility, old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}
                                class="rounded border-slate-300 text-primary focus:ring-primary/40"
                            >
                            <span class="text-sm text-slate-600">{{ $facility }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Foto Utama --}}
            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-slate-700 mb-1.5">Ganti Foto Utama</label>
                @if ($hotel->thumbnail)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $hotel->thumbnail) }}" alt="Foto saat ini" class="h-32 w-auto rounded-xl object-cover">
                        <p class="text-xs text-slate-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input
                    id="thumbnail"
                    type="file"
                    name="thumbnail"
                    accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-full file:border-0 file:text-sm file:font-semibold
                           file:bg-ice-cyan file:text-primary hover:file:bg-primary/10"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('hotels.index') }}" class="btn-outline">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
