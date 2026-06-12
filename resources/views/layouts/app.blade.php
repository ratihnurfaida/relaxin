<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RelaXin') }} – {{ $title ?? 'Hotel Bandung' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 font-jakarta antialiased">

    {{-- NAVBAR --}}
    <nav class="bg-[#0e7490] sticky top-0 z-50 px-12 py-4 flex items-center justify-between">
        <a href="{{ route('welcome') }}" class="text-2xl font-extrabold text-white">
            Rela<span class="text-cyan-300">Xin</span>
        </a>
        <ul class="flex items-center gap-8 list-none">
            <li><a href="{{ route('hotel.index') }}" class="text-gray-100 text-sm font-medium hover:text-white transition-colors">Hotel</a></li>
<li><a href="{{ route('destinasi.index') }}" class="text-gray-100 text-sm font-medium hover:text-white transition-colors">Destinasi</a></li>
<li><a href="#promo" class="text-gray-100 text-sm font-medium hover:text-white transition-colors">Promo</a></li>
<li><a href="#tentang" class="text-gray-100 text-sm font-medium hover:text-white transition-colors">Tentang</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}" class="text-gray-100 text-sm font-medium hover:text-white transition-colors">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-100 text-sm font-medium hover:text-white transition-colors">
                            Keluar
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                       class="bg-white text-cyan-700 text-sm font-bold px-5 py-2 rounded-lg hover:bg-cyan-50 transition-colors">
                        Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}"
                       class="bg-[#ef4444] text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        Daftar
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

    {{-- CONTENT --}}
    {{ $slot }}

    {{-- FOOTER --}}
    <footer class="bg-[#0a3d4a] mt-16 px-12 py-12">
        <div class="grid grid-cols-3 gap-12 mb-10">
            <div>
                <h3 class="text-xl font-extrabold text-white mb-2">
                    Rela<span class="text-cyan-400">Xin</span>
                </h3>
                <p class="text-sm text-gray-400">Hotel Bandung, semua ada di sini.</p>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('hotel.index') }}" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors">Hotel</a></li>
<li><a href="{{ route('destinasi.index') }}" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors">Destinasi</a></li>
<li><a href="#promo" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors">Promo</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Informasi</h4>
                <ul class="space-y-2">
                    <li><a href="#tentang" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-[#0e7490] pt-6">
            <p class="text-xs text-gray-600">© {{ date('Y') }} RelaXin — Proyek 1</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>