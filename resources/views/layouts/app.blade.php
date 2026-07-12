<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RelaXin') }} – {{ $title ?? 'Hotel Bandung' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    @stack('styles')
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        .font-fraunces { font-family: 'Fraunces', serif; }
        .font-mono-plex { font-family: 'IBM Plex Mono', monospace; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 text-gray-800">
    <div class="min-h-screen flex flex-col justify-between">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-cyan-50/70 backdrop-blur-md px-6 md:px-12 py-4 border-b border-cyan-100 shadow-sm flex items-center justify-between lg:grid lg:grid-cols-[auto_1fr_auto] lg:gap-6">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="1.8" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14M13 21V4a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v17M7.5 9h1M7.5 12h1M7.5 15h1M15.5 6h1M15.5 9h1M15.5 12h1M15.5 15h1" />
            </svg>
            <span class="text-3xl tracking-tight font-fraunces" style="font-weight: 600; color: #155E75;">
                Rela<span style="color: #0E7490;">Xin</span>
            </span>
        </a>

        <ul class="hidden lg:flex items-center justify-center gap-8 list-none">
            <li>
                <a href="{{ url('/') }}" class="relative text-cyan-900/70 text-base font-bold hover:text-cyan-600 transition-colors {{ request()->routeIs('welcome') ? 'text-cyan-600' : '' }}">
                    Beranda
                    @if(request()->routeIs('welcome'))
                        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-cyan-600 rounded-full"></span>
                    @endif
                </a>
            </li>
            <li><a href="{{ route('hotel.index') }}" class="text-cyan-900/70 text-base font-bold hover:text-cyan-600 transition-colors">Hotel</a></li>
            <li><a href="{{ route('destinasi.index') }}" class="text-cyan-900/70 text-base font-bold hover:text-cyan-600 transition-colors">Destinasi</a></li>
            <li><a href="{{ route('about') }}" class="text-cyan-900/70 text-base font-bold hover:text-cyan-600 transition-colors">Tentang Kami</a></li>
            <li><a href="{{ url('kontak') }}" class="text-cyan-900/70 text-base font-bold hover:text-cyan-600 transition-colors">Kontak</a></li>
        </ul>

        <ul class="hidden lg:flex items-center gap-4 list-none justify-self-end">
            @auth
                <li class="relative">
                    <details class="group">
                        <summary class="list-none flex items-center gap-2.5 cursor-pointer select-none px-2 py-1.5 rounded-xl hover:bg-white/60 transition-colors">
                            <span class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0 shadow-sm"
                                  style="background-color: #0E7490; font-family: 'IBM Plex Mono', monospace;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="text-cyan-900/80 text-base font-bold max-w-[140px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-cyan-900/50 transition-transform duration-150 group-open:rotate-180 flex-shrink-0"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </summary>

                        <div class="absolute right-0 mt-2 w-52 bg-white border border-cyan-100 rounded-xl shadow-xl py-2 z-50">
                            <div class="px-4 py-2.5 border-b border-cyan-50">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-cyan-50 hover:text-cyan-700 transition-colors">
                                    Profile
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-cyan-50 hover:text-cyan-700 transition-colors">
                                    Profile
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </details>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-1.5 bg-white/60 text-cyan-700 text-base font-bold px-5 py-2 rounded-lg hover:bg-white transition-colors border border-cyan-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}"
                       class="bg-cyan-600 text-white text-base font-bold px-5 py-2 rounded-lg hover:bg-cyan-700 transition-colors shadow-sm shadow-cyan-600/20">
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
    <footer class="bg-gradient-to-b from-white to-cyan-50 border-t border-cyan-100/80 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 md:px-12">

            {{-- Grid Utama Footer --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-cyan-100">

                {{-- Kolom 1: Branding --}}
                <div class="space-y-4 lg:col-span-1">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="1.8" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14M13 21V4a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v17M7.5 9h1M7.5 12h1M7.5 15h1M15.5 6h1M15.5 9h1M15.5 12h1M15.5 15h1" />
                        </svg>
                        <span class="text-2xl tracking-tight font-fraunces" style="font-weight: 600; color: #155E75;">
                            Rela<span style="color: #0E7490;">Xin</span>
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed max-w-xs">
                        Platform booking hotel terbaik di Bandung dengan harga terjangkau dan pelayanan terpercaya.
                    </p>
                    <div class="flex items-center gap-3 pt-1">
                        @foreach([
                            ['label' => 'Facebook', 'path' => 'M22 12.06C22 6.505 17.523 2 12 2S2 6.505 2 12.06c0 5.02 3.657 9.184 8.438 9.94v-7.03H7.898v-2.91h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.878h2.773l-.443 2.91h-2.33V22c4.78-.756 8.437-4.92 8.437-9.94Z'],
                            ['label' => 'Instagram', 'path' => 'M12 2c2.72 0 3.06.01 4.12.06 1.06.05 1.79.22 2.43.47.66.26 1.22.6 1.77 1.15.55.55.9 1.11 1.15 1.77.25.64.42 1.37.47 2.43.05 1.06.06 1.4.06 4.12s-.01 3.06-.06 4.12c-.05 1.06-.22 1.79-.47 2.43a4.9 4.9 0 0 1-1.15 1.77 4.9 4.9 0 0 1-1.77 1.15c-.64.25-1.37.42-2.43.47-1.06.05-1.4.06-4.12.06s-3.06-.01-4.12-.06c-1.06-.05-1.79-.22-2.43-.47a4.9 4.9 0 0 1-1.77-1.15 4.9 4.9 0 0 1-1.15-1.77c-.25-.64-.42-1.37-.47-2.43C2.01 15.06 2 14.72 2 12s.01-3.06.06-4.12c.05-1.06.22-1.79.47-2.43.26-.66.6-1.22 1.15-1.77A4.9 4.9 0 0 1 5.45 2.53c.64-.25 1.37-.42 2.43-.47C8.94 2.01 9.28 2 12 2Zm0 1.8c-2.67 0-2.99.01-4.04.06-.87.04-1.34.18-1.65.3-.42.16-.71.35-1.02.66-.31.31-.5.6-.66 1.02-.12.31-.26.78-.3 1.65C4.28 8.53 4.27 8.85 4.27 12s.01 3.47.06 4.51c.04.87.18 1.34.3 1.65.16.42.35.71.66 1.02.31.31.6.5 1.02.66.31.12.78.26 1.65.3 1.05.05 1.37.06 4.04.06s2.99-.01 4.04-.06c.87-.04 1.34-.18 1.65-.3.42-.16.71-.35 1.02-.66.31-.31.5-.6.66-1.02.12-.31.26-.78.3-1.65.05-1.04.06-1.36.06-4.51s-.01-3.47-.06-4.51c-.04-.87-.18-1.34-.3-1.65a2.75 2.75 0 0 0-.66-1.02 2.75 2.75 0 0 0-1.02-.66c-.31-.12-.78-.26-1.65-.3C14.99 3.81 14.67 3.8 12 3.8Zm0 3.05a5.15 5.15 0 1 1 0 10.3 5.15 5.15 0 0 1 0-10.3Zm0 1.8a3.35 3.35 0 1 0 0 6.7 3.35 3.35 0 0 0 0-6.7Zm5.35-1.99a1.2 1.2 0 1 1-2.4 0 1.2 1.2 0 0 1 2.4 0Z'],
                            ['label' => 'TikTok', 'path' => 'M16.5 2h-3.2v13.6a2.9 2.9 0 1 1-2.05-2.77V9.6a6.1 6.1 0 1 0 5.25 6.05V8.9a7.7 7.7 0 0 0 4.5 1.44V7.13A4.6 4.6 0 0 1 16.5 2Z'],
                            ['label' => 'YouTube', 'path' => 'M21.6 7.2s-.21-1.49-.86-2.15c-.82-.87-1.74-.87-2.16-.92C15.6 4 12 4 12 4h-.01s-3.6 0-6.58.13c-.42.05-1.34.05-2.16.92-.65.66-.86 2.15-.86 2.15S2.16 8.94 2.16 10.68v1.53c0 1.74.22 3.48.22 3.48s.21 1.49.86 2.15c.82.87 1.9.84 2.38.93 1.73.17 7.38.22 7.38.22s3.6-.01 6.58-.14c.42-.05 1.34-.05 2.16-.92.65-.66.86-2.15.86-2.15s.22-1.74.22-3.48v-1.53c0-1.74-.22-3.48-.22-3.48ZM9.96 14.6V8.8l5.6 2.9-5.6 2.9Z'],
                        ] as $social)
                            <a href="#" aria-label="{{ $social['label'] }}"
                               class="w-9 h-9 rounded-full bg-white/80 border border-cyan-100 flex items-center justify-center text-cyan-700 hover:bg-cyan-600 hover:text-white hover:border-cyan-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="{{ $social['path'] }}" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Kolom 2: Navigasi --}}
                <div>
                    <h4 class="text-sm uppercase tracking-widest mb-4 font-mono-plex font-semibold" style="color: #0E7490;">Navigasi</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ url('/') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Beranda</a></li>
                        <li><a href="{{ route('hotel.index') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Hotel</a></li>
                        <li><a href="{{ route('destinasi.index') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Destinasi</a></li>
                        <li><a href="{{ route('about') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Tentang Kami</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Bantuan --}}
                <div>
                    <h4 class="text-sm uppercase tracking-widest mb-4 font-mono-plex font-semibold" style="color: #0E7490;">Bantuan</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#cara-booking" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Cara Booking</a></li>
                        <li><a href="{{ route('syarat') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('kebijakan') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ url('kontak') }}" class="text-base text-gray-500 hover:text-cyan-600 font-medium transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                {{-- Kolom 4: Kontak --}}
                <div>
                    <h4 class="text-sm uppercase tracking-widest mb-4 font-mono-plex font-semibold" style="color: #0E7490;">Kontak Kami</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2.5 text-base text-gray-500 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="2" class="w-5 h-5 flex-shrink-0 mt-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Jl. Sariasih No.54, Sarijadi, Kec. Sukasari, Kota Bandung, Jawa Barat 40151, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-2.5 text-base text-gray-500 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="2" class="w-5 h-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a1.5 1.5 0 0 0 1.5-1.5v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.5 1.5 0 0 0-1.52.43l-.773.773a11.25 11.25 0 0 1-5.586-5.586l.774-.773a1.5 1.5 0 0 0 .43-1.52L8.963 3.852a1.125 1.125 0 0 0-1.091-.852H6.5A1.5 1.5 0 0 0 5 4.5v.75Z" />
                            </svg>
                            <span>(+62) 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-2.5 text-base text-gray-500 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0E7490" stroke-width="2" class="w-5 h-5 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span>relaxin@gmail.com</span>
                        </li>
                    </ul>
                </div>

                {{-- Kolom 5: Download Aplikasi --}}
                <div>
                    <h4 class="text-sm uppercase tracking-widest mb-4 font-mono-plex font-semibold" style="color: #0E7490;">Download Aplikasi</h4>
                    <div class="flex flex-col gap-3">
                        <a href="#" class="flex items-center gap-2.5 bg-gray-900 hover:bg-gray-800 transition-colors rounded-xl px-4 py-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" class="w-6 h-6 flex-shrink-0">
                                <path d="M3.6 2.4a1 1 0 0 0-.6.92v17.36a1 1 0 0 0 .6.92l10.36-9.6L3.6 2.4Zm12.1 8.36 2.5-1.46 2.98 1.73a1 1 0 0 1 0 1.74l-2.98 1.73-2.5-1.46 1.24-1.14-1.24-1.14ZM14.7 12l-11 10.2 10.3-5.98L14.7 12Zm0 0 -.7-.65L4.7 1.8 15 7.98 14.7 12Z"/>
                            </svg>
                            <span class="text-left leading-tight">
                                <span class="block text-[10px] text-gray-300 font-medium">GET IT ON</span>
                                <span class="block text-sm text-white font-bold">Google Play</span>
                            </span>
                        </a>
                        <a href="#" class="flex items-center gap-2.5 bg-gray-900 hover:bg-gray-800 transition-colors rounded-xl px-4 py-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" class="w-6 h-6 flex-shrink-0">
                                <path d="M16.3 1.2c.1 1-.3 2-.9 2.7-.6.7-1.6 1.3-2.6 1.2-.1-1 .4-2 1-2.6.6-.7 1.6-1.2 2.5-1.3ZM19.9 17c-.5 1.1-.7 1.6-1.4 2.6-.9 1.4-2.2 3.1-3.8 3.1-1.4 0-1.8-.9-3.7-.9-1.9 0-2.4.9-3.7.9-1.6 0-2.8-1.5-3.7-2.9C1.4 17 .8 13.4 2.2 10.8c.9-1.7 2.6-2.8 4.4-2.8 1.4 0 2.7.9 3.6.9.8 0 2.4-1.1 4-1 .7 0 2.6.3 3.8 2-3.4 1.9-2.9 6.6-.1 7.1Z"/>
                            </svg>
                            <span class="text-left leading-tight">
                                <span class="block text-[10px] text-gray-300 font-medium">Download on the</span>
                                <span class="block text-sm text-white font-bold">App Store</span>
                            </span>
                        </a>
                    </div>
                </div>

            </div>

            {{-- Baris Hak Cipta --}}
            <div class="pt-8 text-center text-sm font-medium text-gray-400 font-mono-plex">
                © 2024 <span class="font-semibold" style="color: #0E7490;">RelaXin</span>. All rights reserved.
            </div>

        </div>
    </footer>

    </div>

    @stack('scripts')
</body>
</html>