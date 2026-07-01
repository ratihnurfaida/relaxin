<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-cyan-900 text-white flex-shrink-0">
            <div class="p-6 text-xl font-bold border-b border-cyan-800">RelaxIn Admin</div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-3 px-6 hover:bg-cyan-800 transition">Dashboard</a>
                <a href="#" class="block py-3 px-6 hover:bg-cyan-800 transition">Manajemen Hotel</a>
                <a href="#" class="block py-3 px-6 hover:bg-cyan-800 transition">Reservasi</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h2 class="font-semibold text-gray-800">Dashboard Admin</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600">Logout</button>
                </form>
            </header>
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>