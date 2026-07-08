<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kamar - Admin RelaXin') }}
        </h2>
    </x-slot>
    
    <div class="pt-16 pb-16 px-4 md:px-8 max-w-5xl mx-auto">
        {{-- Grid Daftar Hotel --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($hotels as $hotel)
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 hover:shadow-cyan-lg transition-all duration-300">
                    <div class="mb-4">
                        @if ($hotel->gambar)
                            <img src="{{ asset('storage/hotel/' . $hotel->gambar) }}" alt="{{ $hotel->nama }}" class="w-full h-40 object-cover rounded-xl mb-4">
                        @endif
                        <h2 class="text-xl font-bold text-slate-900">{{ $hotel->nama }}</h2>
                    </div>
                    
        
                    <a href="{{ route('admin.kamar.index', ['id_hotel' => $hotel->id_hotel]) }}" 
                    class="block w-full text-center bg-primary text-white rounded-xl py-2.5 text-sm font-semibold hover:bg-primary/90 transition">
                        Kelola Kamar
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-admin>