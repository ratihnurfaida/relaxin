<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Hotel: {{ $hotel->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-blue-900">{{ $hotel->nama }}</h1>
                    <p class="text-gray-500 flex items-center mt-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $hotel->alamat }}, {{ $hotel->kota }}
                    </p>
                </div>

                <div class="mt-10">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Pilihan Kamar</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($hotel->kamar as $item)
                            @php
                                $sisaKamar = $item->total_kamar - ($item->pesanan_terisi ?? 0);
                            @endphp

                            <div class="border rounded-2xl p-5 hover:shadow-lg transition bg-white">
                                <div class="w-full h-48 overflow-hidden rounded-xl mb-4">
                                    <img src="{{ asset('assets/hotel/' . $item->gambar) }}" 
                                         alt="{{ $item->tipe_kamar }}" 
                                         class="w-full h-full object-cover shadow-sm">
                                </div>
                                
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">{{ $item->tipe_kamar }}</h4>
                                        <p class="text-sm text-gray-500 mt-1">Kapasitas: {{ $item->kapasitas }} Orang</p>
                                        
                                        <p class="text-xs mt-2 font-medium {{ $sisaKamar > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            @if($sisaKamar > 0)
                                                ● Tersisa {{ $sisaKamar }} kamar untuk tanggal ini
                                            @else
                                                ● Maaf, kamar sudah penuh
                                            @endif
                                        </p>
                                    </div>
                                    
                                    @if($sisaKamar > 0)
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                                            Penuh
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="mt-6 flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase">Harga Per Malam</p>
                                        <p class="text-lg font-bold text-blue-600">
                                            Rp {{ number_format($item->harga_per_kamar, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    @if($sisaKamar > 0)
                                        <a href="{{ route('booking.create', ['hotel_id' => $hotel->id_hotel, 'id_kamar' => $item->id_kamar]) }}" 
                                           class="text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl transition">
                                            Pesan Sekarang
                                        </a>
                                    @else
                                        <button class="bg-gray-300 text-gray-500 font-bold py-2 px-6 rounded-xl cursor-not-allowed" disabled>
                                            Penuh
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>