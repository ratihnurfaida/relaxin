<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RelaXin') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-fraunces { font-family: 'Fraunces', serif; }

        @keyframes floatSlow {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, -25px) scale(1.05); }
        }
        @keyframes floatSlower {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-25px, 20px) scale(1.08); }
        }
        .blob-a { animation: floatSlow 12s ease-in-out infinite; }
        .blob-b { animation: floatSlower 15s ease-in-out infinite; }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .fade-in-delay { animation: fadeIn 0.6s ease-out 0.12s both; }
    </style>
</head>

{{-- Perubahan utama: hapus overflow-hidden, tambah py-12 agar bisa scroll --}}
<body class="antialiased min-h-screen relative py-12" style="background-color: #F0F9FA;">

    {{-- Dekorasi Background (Tetap menggunakan fixed agar tidak ikut bergerak saat scroll) --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
        <div class="blob-a absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-60" style="background: radial-gradient(circle, #A5F3FC 0%, transparent 70%);"></div>
        <div class="blob-b absolute -bottom-32 -right-16 w-[28rem] h-[28rem] rounded-full opacity-60" style="background: radial-gradient(circle, #67E8F9 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 rounded-full opacity-30" style="background: radial-gradient(circle, #CCFBF1 0%, transparent 70%);"></div>

        <svg class="absolute inset-0 w-full h-full opacity-[0.35]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="dotgrid" width="28" height="28" patternUnits="userSpaceOnUse">
                    <circle cx="1.5" cy="1.5" r="1.5" fill="#0E7490" fill-opacity="0.12" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dotgrid)" />
        </svg>
    </div>

    {{-- Konten Utama --}}
    <div class="w-full max-w-md px-5 mx-auto relative z-10">
        <div class="fade-in-delay">
            {{ $slot }}
        </div>
    </div>

</body>
</html>