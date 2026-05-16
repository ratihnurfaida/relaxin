<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RelaXin') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 font-jakarta antialiased min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-5">
        <div class="text-center mb-8">
            <a href="{{ route('welcome') }}" class="text-3xl font-extrabold text-white">
                Rela<span class="text-green-400">Xin</span>
            </a>
        </div>
        {{ $slot }}
    </div>
</body>
</html>