<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-sm text-gray-500">Senin, 12 Mei 2026 — Selamat datang kembali!</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Reservasi</p>
                            <h3 class="text-3xl font-bold text-gray-900">1.284</h3>
                            <p class="text-sm text-green-600 mt-2 font-medium">▲ +18% bulan ini</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-full">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pendapatan (Mei)</p>
                            <h3 class="text-3xl font-bold text-gray-900">Rp 84 jt</h3>
                            <p class="text-sm text-green-600 mt-2 font-medium">▲ +12% vs bulan lalu</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-full">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Hotel Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-900">47</h3>
                            <p class="text-sm text-green-600 mt-2 font-medium">▲ +3 hotel baru</p>
                        </div>
                        <div class="p-3 bg-orange-50 rounded-full">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg text-gray-800">Reservasi Terkini</h3>
                        <a href="#" class="text-blue-600 text-sm font-semibold hover:underline">Lihat semua →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    <th class="pb-3">Tamu</th>
                                    <th class="pb-3">Hotel / Area</th>
                                    <th class="pb-3">Check-In</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                <tr>
                                    <td class="py-4"><strong>Rizky Pratama</strong><br><span class="text-xs text-gray-400">2 malam • Deluxe</span></td>
                                    <td class="py-4 text-gray-600">Padma Hotel<br><span class="text-xs text-pink-500">📍 Dago</span></td>
                                    <td class="py-4 text-gray-600">15 Mei</td>
                                    <td class="py-4"><span class="px-2 py-1 bg-green-100 text-green-700 rounded-md text-xs font-bold">Konfirmasi</span></td>
                                    <td class="py-4 text-right font-bold text-gray-700">Rp 1,4 jt</td>
                                </tr>
                                <tr>
                                    <td class="py-4"><strong>Sari Dewi</strong><br><span class="text-xs text-gray-400">1 malam • Superior</span></td>
                                    <td class="py-4 text-gray-600">Lembang Park<br><span class="text-xs text-pink-500">📍 Lembang</span></td>
                                    <td class="py-4 text-gray-600">13 Mei</td>
                                    <td class="py-4"><span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-md text-xs font-bold">Check-in</span></td>
                                    <td class="py-4 text-right font-bold text-gray-700">Rp 650 rb</td>
                                </tr>
                                <tr>
                                    <td class="py-4"><strong>Hendra Wijaya</strong><br><span class="text-xs text-gray-400">1 malam • Standard</span></td>
                                    <td class="py-4 text-gray-600">Ibis Budget<br><span class="text-xs text-pink-500">📍 Pasteur</span></td>
                                    <td class="py-4 text-gray-600">12 Mei</td>
                                    <td class="py-4"><span class="px-2 py-1 bg-red-100 text-red-700 rounded-md text-xs font-bold">Batal</span></td>
                                    <td class="py-4 text-right font-bold text-gray-700">Rp 480 rb</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>