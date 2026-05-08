<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Relaxin') }} – @yield('title', 'Masuk')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ice-cyan min-h-screen flex items-center justify-center p-4">

    {{-- Background decorations --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-rose/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="font-display text-3xl font-black text-primary tracking-tight">
                Relax<span class="text-rose">in</span>
            </a>
            <p class="text-slate-400 text-sm mt-1">Hotel Booking Terbaik di Indonesia</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-cyan-lg p-8">
            @yield('content')
        </div>

        {{-- Footer link --}}
        <p class="text-center text-xs text-slate-400 mt-6">
            &copy; {{ date('Y') }} Relaxin. All rights reserved.
        </p>
    </div>

    @stack('scripts')
</body>
</html>
