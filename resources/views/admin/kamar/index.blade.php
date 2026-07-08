<x-admin>
    <div class="container mx-auto p-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        
            {{-- Header --}}
            <div>
            <a href="{{ route('admin.kamar.pilih-hotel', $hotel) }}" class="inline-flex items-center gap-1.5 text-sm text-primary hover:underline mb-3">
                    ← Kembali ke daftar hotel
            </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h2 class="text-xl font-bold text-slate-800">Manajemen Kamar</h2>
                    <a href="{{ route('admin.kamar.create', $hotel) }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                        + Tambah Kamar
                    </a>
                </div>
                
            </div>
            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs font-bold uppercase text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">Kode</th>
                            <th class="px-6 py-4">Tipe Kamar</th>
                            <th class="px-6 py-4">Tipe Bed</th>
                            <th class="px-6 py-4">Harga</th>
                            <th class="px-6 py-4">Stok</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($daftar_kamar as $kamar)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-mono font-medium text-slate-900">{{ $kamar->kode_kamar }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $kamar->tipe_kamar }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $kamar->tipe_bed }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($kamar->harga_per_kamar, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $kamar->total_kamar }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.kamar.edit', $kamar->id_kamar) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.kamar.destroy', $kamar->id_kamar) }}" method="POST" class="relative z-10"
                                        onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-slate-500">Data kamar kosong atau tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin>