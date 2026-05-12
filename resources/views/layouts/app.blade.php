<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Relaxin – @yield('title', 'Temukan Hotel Terbaikmu')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ice-cyan">

    @include('components.navbar')

    <main>
            {{ $slot ?? '' }}
        @yield('content')
    
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
