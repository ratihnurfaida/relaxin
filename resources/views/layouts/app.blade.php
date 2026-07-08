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
<body class="font-sans antialiased bg-slate-50 text-gray-800">
    <div class="min-h-screen flex flex-col justify-between">

    {{-- NAVBAR --}}
<nav class="sticky top-0 z-50 bg-cyan-50/70 backdrop-blur-md px-12 py-4 flex items-center justify-between border-b border-cyan-100 shadow-sm">
    <a href="{{ route('welcome') }}" class="text-2xl font-black text-gray-800 hover:opacity-80 transition-opacity tracking-tighter">
        Rela<span class="text-cyan-600">Xin</span>
    </a>
    
    <ul class="flex items-center gap-8 list-none">
        <li><a href="{{ url('/') }}" class="text-cyan-900/70 text-sm font-bold hover:text-cyan-600 transition-colors">Beranda</a></li>
        <li><a href="{{ route('hotel.index') }}" class="text-cyan-900/70 text-sm font-bold hover:text-cyan-600 transition-colors">Hotel</a></li>
        <li><a href="{{ route('destinasi.index') }}" class="text-cyan-900/70 text-sm font-bold hover:text-cyan-600 transition-colors">Destinasi</a></li>
        <li><a href="{{ route('about') }}" class="text-cyan-900/70 text-sm font-bold hover:text-cyan-600 transition-colors">Tentang</a></li>
        
        @auth
            <li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-cyan-900/70 text-sm font-bold hover:text-cyan-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('dashboard') }}" class="text-cyan-900/70 text-sm font-bold hover:text-cyan-600 transition-colors">Dashboard</a>
                @endif
            </li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-cyan-900/70 text-sm font-bold hover:text-red-500 transition-colors">
                        Keluar
                    </button>
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}"
                   class="bg-white/50 text-cyan-700 text-sm font-bold px-5 py-2 rounded-lg hover:bg-white transition-colors border border-cyan-200 shadow-sm">
                    Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}"
                   class="bg-cyan-600 text-white text-sm font-bold px-5 py-2 rounded-lg hover:bg-cyan-700 transition-colors shadow-sm shadow-cyan-600/20">
                    Daftar
                </a>
            </li>
        @endauth
    </ul>
</nav>

    {{-- CONTENT --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    {{-- ===== FOOTER RELAXIN (Tema Biru Cyan Modern) ===== --}}
<footer class="bg-gradient-to-b from-white to-cyan-50 border-t border-cyan-100/80 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-12">
        
        {{-- Grid Utama Footer --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-12 border-b border-cyan-100">
            
            {{-- Kolom 1: Branding Proyek --}}
            <div class="space-y-4">
                <div class="text-2xl font-black text-gray-800 tracking-tight">
                    Relax<span class="text-cyan-600">In</span>
                </div>
                <p class="text-sm text-gray-500 font-medium leading-relaxed max-w-xs">
                    Hotel Bandung, semua ada di sini. Temukan akomodasi terbaik dengan mudah dan cepat.
                </p>
            </div>

            {{-- Kolom 2: Navigasi --}}
            <div>
                <h4 class="text-xs font-bold text-cyan-700 uppercase tracking-widest mb-4">Navigasi</h4>
                <ul class="space-y-2.5">
                    <li>
                        <a href="{{ url('/hotel') }}" class="text-sm text-gray-500 hover:text-cyan-600 font-medium transition-colors">Hotel</a>
                    </li>
                    <li>
                        <a href="{{ route('destinasi.index') ?? '#' }}" class="text-sm text-gray-500 hover:text-cyan-600 font-medium transition-colors">Destinasi</a>
                    </li>
                </ul>
            </div>

            {{-- Kolom 3: Informasi --}}
            <div>
                <h4 class="text-xs font-bold text-cyan-700 uppercase tracking-widest mb-4">Informasi</h4>
                <ul class="space-y-2.5">
                    <li>
                        <a href="{{ url('/about') }}" class="text-sm text-gray-500 hover:text-cyan-600 font-medium transition-colors">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="{{ route('kebijakan') }}" class="text-sm text-gray-500 hover:text-cyan-600 font-medium transition-colors">Kebijakan Privasi</a>
                    </li>
                    <li>
                        <a href="{{ route('syarat') }}" class="text-sm text-gray-500 hover:text-cyan-600 font-medium transition-colors">Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Baris Hak Cipta / Copyright --}}
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-medium text-gray-400">
            <div>
                © 2026 <span class="text-cyan-600 font-semibold">RelaxIn</span> 
            </div>
            <div class="flex gap-4">
                <span class="hover:text-cyan-600 cursor-pointer transition-colors">IDR / ID</span>
                <span class="hover:text-cyan-600 cursor-pointer transition-colors">Bandung, Indonesia</span>
            </div>
        </div>

    </div>
</footer>

    </div>

    @stack('scripts')
</body>
</html>