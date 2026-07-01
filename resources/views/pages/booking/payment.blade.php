<x-app-layout>
    <div class="container mx-auto py-10 px-4 text-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-2">
                <div id="countdown-box" class="bg-cyan-50 border-l-4 border-cyan-400 text-cyan-800 p-4 mb-4 rounded shadow-sm">
                    Selesaikan pembayaran dalam: <span id="timer" class="font-bold text-lg text-cyan-900">--:--</span>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-cyan-100">
                    <h4 class="text-xl font-bold mb-4 text-cyan-900">Upload Bukti Pembayaran</h4>
                    <form action="{{ route('booking.confirm', $booking->id_booking) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4 class="font-semibold mb-2">Pilih Metode Pembayaran</h4>
                        <select name="metode_payment" class="w-full border-cyan-200 rounded-md shadow-sm mb-4 p-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                            <option value="transfer_bank">Transfer Bank (BCA 12345678)</option>
                            <option value="kartu_kredit">Kartu Kredit</option>
                        </select>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Upload Bukti Transfer</label>
                            <input type="file" name="bukti_payment" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-100 file:text-cyan-700 hover:file:bg-cyan-200" required>
                        </div>
                        
                        <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded transition duration-200 shadow-lg shadow-cyan-200">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-cyan-100">
                    <h4 class="text-xl font-bold mb-4 text-cyan-900">Rincian Hotel</h4>
                    <p class="font-semibold text-lg">{{ $booking->hotel->nama_hotel }}</p>
                    <p class="text-gray-600 mb-4">{{ $booking->hotel->kota }}</p>
                    <hr class="my-4 border-cyan-50">
                    <p class="text-gray-700">Total Bayar:</p>
                    <p class="text-2xl font-bold text-cyan-700">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil data dari PHP
        var expiredString = "{{ session('payment_expired_at') }}";
        
        if (expiredString) {
            var expiredAt = new Date(expiredString).getTime();
            
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = expiredAt - now;
                
                var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var s = Math.floor((distance % (1000 * 60)) / 1000);
                
                document.getElementById("timer").innerHTML = m + "m " + s + "s ";
                
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "EXPIRED";
                    window.location.href = "{{ route('welcome') }}";
                }
            }, 1000);
        } else {
            document.getElementById("timer").innerHTML = "Waktu habis/Tidak ada sesi";
        }
    </script>
</x-app-layout>