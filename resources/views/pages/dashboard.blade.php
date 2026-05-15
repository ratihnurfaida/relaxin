<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}!</h1>
            <p>Selamat datang di dashboard RelaxIn. Di sini nanti kamu bisa lihat riwayat booking kamu.</p>
        </div>
    </div>
</x-app-layout>