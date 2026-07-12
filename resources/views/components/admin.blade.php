<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RelaXin Admin — {{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-fraunces { font-family: 'Fraunces', serif; }
        .font-mono-plex { font-family: 'IBM Plex Mono', monospace; }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">
    <div class="min-h-screen flex">

        {{-- ══════════════ SIDEBAR ══════════════ --}}
        <aside class="w-64 flex-shrink-0 bg-gradient-to-b from-cyan-900 to-cyan-950 text-white flex flex-col">
            <div class="p-6 border-b border-white/10 flex items-center gap-3">

                <div>
                    <div class="text-xl tracking-tight leading-none font-fraunces" style="font-weight: 600;">RelaXin</div>
                    <div class="text-xs text-cyan-300/70 font-semibold tracking-widest uppercase mt-0.5 font-mono-plex">Admin Panel</div>
                </div>
            </div>

            <nav class="mt-4 px-3 space-y-1 flex-1">
                <p class="px-3 pt-2 pb-1 text-xs font-bold uppercase tracking-widest text-cyan-400/50 font-mono-plex">Menu Utama</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-base font-semibold transition
                          {{ request()->routeIs('admin.dashboard') ? 'bg-white text-cyan-900 shadow-sm' : 'text-cyan-100 hover:bg-white/10' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.hotel.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-base font-semibold transition
                          {{ request()->routeIs('admin.hotel.*') ? 'bg-white text-cyan-900 shadow-sm' : 'text-cyan-100 hover:bg-white/10' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Manajemen Hotel
                </a>

                <a href="{{ route('admin.kamar.pilih-hotel') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-base font-semibold transition
                          {{ request()->routeIs('admin.kamar.*') ? 'bg-white text-cyan-900 shadow-sm' : 'text-cyan-100 hover:bg-white/10' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10m0-10a2 2 0 012-2h14a2 2 0 012 2m-18 0h18M3 17a2 2 0 002 2h14a2 2 0 002-2M7 7v4m0 0h10m-10 0v6m10-6v6"></path></svg>
                    Manajemen Kamar
                </a>

                <p class="px-3 pt-4 pb-1 text-xs font-bold uppercase tracking-widest text-cyan-400/50 font-mono-plex">Operasional</p>

                <a href="{{ route('admin.reservasi') }}"
                   class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-base font-semibold transition
                          {{ request()->routeIs('admin.reservasi.*') ? 'bg-white text-cyan-900 shadow-sm' : 'text-cyan-100 hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Reservasi
                    </span>
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="text-xs font-bold bg-rose-500 text-white rounded-full px-1.5 py-0.5 min-w-[18px] text-center font-mono-plex">{{ $pendingCount }}</span>
                    @endif
                </a>
            </nav>

            <div class="p-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 justify-center text-sm font-semibold text-rose-200 hover:text-white bg-rose-500/10 hover:bg-rose-500/20 rounded-lg py-2 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ══════════════ MAIN CONTENT ══════════════ --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white/80 backdrop-blur border-b border-slate-200 px-8 py-4">
                {{ $header ?? '' }}
            </header>
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>