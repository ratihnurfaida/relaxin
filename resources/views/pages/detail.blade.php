<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight">
            Detail Hotel: {{ $hotel->nama }}
        </h2>
    </x-slot>

    {{-- ===== BACKGROUND SOFT CYAN POLOS SOLID ===== --}}
    <div class="py-12 bg-cyan-50/40 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Box Utama Putih Bersih --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl p-8 border border-cyan-100/30">
                
                {{-- Nama Hotel & Alamat Header --}}
                <div class="mb-8 pb-6 border-b border-slate-100">
                    <h1 class="text-3xl font-black text-gray-800 tracking-tight">{{ $hotel->nama }}</h1>
                    <p class="text-sm text-cyan-700 font-bold flex items-center mt-2">
                        <svg class="w-4 h-4 mr-1.5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $hotel->alamat }}, {{ $hotel->kota }}
                    </p>
                </div>

                {{-- Bagian Pilihan Kamar --}}
                <div class="mt-8">
                    <h3 class="text-xl font-black text-gray-800 mb-6 tracking-tight">Pilihan Kamar yang Tersedia</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($hotel->kamar as $item)
                            @php
                                $sisaKamar = $item->total_kamar - ($item->pesanan_terisi ?? 0);
                            @endphp

                            {{-- 🔥 PERUBAHAN DISINI: Mengubah background card menjadi soft cyan (#ecfbfc) & border cyan tipis --}}
                            <div style="background-color: #ecfbfc;" 
                                 class="border border-cyan-200/70 rounded-3xl p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                                
                                <div>
                                    {{-- Foto Kamar --}}
                                    <div class="w-full h-52 overflow-hidden rounded-2xl mb-4 bg-white border border-cyan-100/50">
                                        <img src="{{ asset('storage/hotel/' . $item->gambar) }}" 
                                             alt="{{ $item->tipe_kamar }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    
                                    {{-- Informasi Status Ketersediaan --}}
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="text-lg font-black text-gray-800 tracking-tight">{{ $item->tipe_kamar }}</h4>
                                            <p class="text-xs font-medium text-gray-500 mt-0.5">Kapasitas: {{ $item->kapasitas }} Orang</p>
                                        </div>
                                        
                                        @if($sisaKamar > 0)
                                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-lg">
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="bg-rose-100 text-rose-800 text-xs font-bold px-3 py-1 rounded-lg">
                                                Penuh
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Indikator Sisa Kamar --}}
                                    <p class="text-xs font-bold mb-4 {{ $sisaKamar > 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                                        @if($sisaKamar > 0)
                                            ● Tersisa {{ $sisaKamar }} kamar untuk tanggal ini
                                        @else
                                            ● Maaf, kamar sudah penuh
                                        @endif
                                    </p>
                                </div>
                                
                                {{-- Footer Card Kamar --}}
                                {{-- Perubahan: Mengubah border-t agar serasi dengan warna cyan kontainer --}}
                                <div class="mt-4 pt-4 border-t border-cyan-200/50 flex justify-between items-center">
                                    <div>
                                        <p class="text-[10px] text-cyan-800/70 font-bold uppercase tracking-wider">Harga Per Malam</p>
                                        <p class="text-xl font-black text-cyan-600 leading-tight">
                                            Rp {{ number_format($item->harga_per_kamar, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    @if($sisaKamar > 0)
                                        {{-- Tombol Cerah Premium --}}
                                        <a href="{{ route('booking.create', ['hotel_id' => $hotel->id_hotel, 'id_kamar' => $item->id_kamar]) }}" 
                                           class="text-center bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs px-5 py-3 rounded-xl shadow-md shadow-cyan-600/10 active:scale-95 transition-all duration-150">
                                            Pesan Sekarang
                                        </a>
                                    @else
                                        <button class="bg-slate-200 text-slate-500 font-bold text-xs px-5 py-3 rounded-xl cursor-not-allowed" disabled>
                                            Habis Terjual
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