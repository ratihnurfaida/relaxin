<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Hotel - Admin RelaXin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Data Hotel</h3>
                    <a href="{{ route('admin.hotel.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Hotel
                    </a>
                </div>

                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Nama Hotel</th>
                            <th class="border px-4 py-2">Kota</th>
                            <th class="border px-4 py-2">Alamat</th>
                            <th class="border px-4 py-2">Rating</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hotels as $hotel)
                            <tr>
                                <td class="border px-4 py-2">{{ $hotel->nama }}</td>
                                <td class="border px-4 py-2">{{ $hotel->kota }}</td>
                                <td class="border px-4 py-2">{{ $hotel->alamat }}</td>
                                <td class="border px-4 py-2">{{ $hotel->star_rating }}</td>
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
                                <td colspan="3" class="border px-4 py-2 text-center">Belum ada data hotel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin>