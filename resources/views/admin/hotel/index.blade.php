<x-admin>
    <x-slot name="header">
        <h2 class="text-2xl leading-tight" style="font-family: 'Fraunces', serif; font-weight: 600; color: #0F172A;">
            {{ __('Manajemen Hotel - Admin RelaXin') }}
        </h2>
    </x-slot>

    <div class="py-12" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-xl" style="font-family: 'Fraunces', serif; font-weight: 600; color: #155E75;">Data Hotel</h3>
                    <a href="{{ route('admin.hotel.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-base py-2 px-4 rounded">
                        + Tambah Hotel
                    </a>
                </div>

                <table class="min-w-full table-auto text-base">
                    <thead>
                        <tr class="bg-gray-100 text-sm font-bold uppercase tracking-wide text-slate-500" style="font-family: 'IBM Plex Mono', monospace;">
                            <th class="border px-4 py-2">Nama Hotel</th>
                            <th class="border px-4 py-2">Area</th>
                            <th class="border px-4 py-2">Alamat</th>
                            <th class="border px-4 py-2">Rating</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hotels as $hotel)
                            <tr>
                                <td class="border px-4 py-2 font-semibold text-slate-800">{{ $hotel->nama }}</td>
                                <td class="border px-4 py-2">{{ $hotel->area->nama ?? '-'}}</td>
                                <td class="border px-4 py-2">{{ $hotel->alamat }}</td>
                                <td class="border px-4 py-2" style="font-family: 'IBM Plex Mono', monospace;">{{ $hotel->star_rating }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.hotel.edit', $hotel->id_hotel) }}" class="text-blue-600">Edit</a> |
                                    <form action="{{ route('admin.hotel.destroy', $hotel->id_hotel) }}" method="POST" class="relative z-10"
                                        onsubmit="return confirm('Yakin ingin menghapus hotel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-center">Belum ada data hotel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin>