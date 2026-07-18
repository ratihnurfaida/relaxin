<x-admin :pendingCount="$booking->filter(fn($b) => in_array(strtolower(trim($b->status)), ['pending', 'menunggu konfirmasi']))->count()">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight leading-tight">
                    {{ __('Antrean Kontrol Reservasi') }}
                </h2>
                <p class="text-xs font-medium text-slate-400 mt-1">
                    Daftar pesanan masuk yang memerlukan tindakan validasi manual admin.
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 bg-white border border-cyan-100 text-slate-700 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg text-xs font-semibold shadow-sm transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white border border-cyan-100 rounded-xl shadow-sm overflow-hidden">
                <div style="background-color: #ecfbfc;" class="p-5 border-b border-cyan-100 flex justify-between items-center">
                    <span class="px-2.5 py-1 text-xs font-bold rounded-md bg-cyan-600 text-white shadow-sm shadow-cyan-600/10">
                        {{ $booking->filter(fn($b) => in_array(strtolower($b->status), ['pending', 'menunggu konfirmasi']))->count() }} Perlu Validasi
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3.5">Tamu & Kontak</th>
                                <th class="px-6 py-3.5">Tipe kamar</th>
                                <th class="px-6 py-3.5">Hotel / Area</th>
                                <th class="px-6 py-3.5 text-center">Jadwal Check-In</th>
                                <th class="px-6 py-3.5 text-center">Bukti Bayar</th> 
                                <th class="px-6 py-3.5 text-right">Total Transaksi</th>
                                <th class="px-6 py-3.5 text-center">Konfirmasi Tindakan</th> 
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($booking as $item)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ $item->nama_tamu }}</div>
                                    <div class="text-[11px] text-slate-400 mt-1">{{ $item->email_tamu }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800">{{ $item->kamar->tipe_kamar ?? 'Kamar Standar' }}</div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $item->total_malam }} malam • {{ $item->jumlah_kamar }} unit
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-slate-700 font-medium">
                                    <div class="text-slate-800">{{ $item->hotel->nama ?? 'Hotel RelaXin' }}</div>
                                    <span class="inline-flex items-center text-[11px] text-cyan-600 mt-0.5 font-semibold">
                                        📍 {{ $item->hotel->kota ?? 'Bandung' }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-center font-medium text-slate-700">
                                    <div class="text-sm bg-slate-100 inline-block px-2.5 py-1 rounded-md border border-slate-200/60">
                                        {{ \Carbon\Carbon::parse($item->tgl_checkin)->format('d M Y') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($item->payment && $item->payment->bukti_payment)
                                        <a href="{{ asset('storage/bukti_transfer/' . $item->payment->bukti_payment) }}" 
                                           target="_blank" 
                                           class="text-blue-600 underline font-semibold text-xs">
                                           Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs italic">Bukan Transfer</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-right font-black text-slate-900 text-base">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $status = strtolower(trim($item->status ?? 'pending'));
                                    @endphp

                                    @if(in_array($status, ['pending', 'menunggu konfirmasi']))
                                        <div class="flex items-center justify-center gap-2 flex-wrap">
                                            <form method="POST" action="{{ route('admin.booking.status', $item->id_booking) }}">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="bg-emerald-600 text-white text-xs px-3 py-1.5 rounded-lg">✓ Setuju</button>
                                            </form>

                                            <button type="button"
                                                    onclick="document.getElementById('rejectModal-{{ $item->id_booking }}').showModal()"
                                                    class="bg-white border border-amber-200 text-amber-600 text-xs px-2.5 py-1.5 rounded-lg">
                                                ⟲ Tolak (Upload Ulang)
                                            </button>

                                            <form method="POST" action="{{ route('admin.booking.status', $item->id_booking) }}"
                                                  onsubmit="return confirm('Batalkan permanen? Stok kamar akan dikembalikan.')">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="bg-white border border-rose-200 text-rose-600 text-xs px-2.5 py-1.5 rounded-lg">✕ Batalkan</button>
                                            </form>
                                        </div>

                                        {{-- Modal alasan penolakan --}}
                                        <dialog id="rejectModal-{{ $item->id_booking }}" class="rounded-xl p-0 backdrop:bg-slate-900/40 w-full max-w-sm">
                                            <form method="POST" action="{{ route('admin.booking.reject', $item->id_booking) }}" class="p-5 space-y-3">
                                                @csrf
                                                <h4 class="font-bold text-slate-800 text-sm">Tolak Bukti Pembayaran</h4>
                                                <p class="text-xs text-slate-500">Jelaskan alasan penolakan, akan ditampilkan ke tamu agar upload ulang.</p>
                                                <textarea name="alasan_penolakan" required rows="3"
                                                          class="w-full text-sm border border-slate-200 rounded-lg p-2 focus:ring-2 focus:ring-amber-300 focus:outline-none"
                                                          placeholder="Contoh: Nominal transfer tidak sesuai total tagihan."></textarea>
                                                <div class="flex justify-end gap-2 pt-1">
                                                    <button type="button"
                                                            onclick="document.getElementById('rejectModal-{{ $item->id_booking }}').close()"
                                                            class="text-xs px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600">Batal</button>
                                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-amber-600 text-white font-semibold">Kirim Penolakan</button>
                                                </div>
                                            </form>
                                        </dialog>

                                    @elseif($status == 'ditolak')
                                        <div class="text-xs text-amber-600 italic font-semibold">⟲ Menunggu Upload Ulang</div>

                                    @elseif($status == 'selesai' || $status == 'confirmed')
                                        <form method="POST" action="{{ route('admin.booking.archive', $item->id_booking) }}" class="archive-form">
                                            @csrf @method('PUT')
                                            <button type="submit" class="text-blue-600 font-bold text-xs hover:underline">Arsipkan</button>
                                        </form>
                                    @else
                                        <div class="text-xs text-slate-400 italic">🔒 Terkunci</div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 italic bg-slate-50/30">
                                    <div class="max-w-xs mx-auto space-y-1">
                                        <p class="font-bold text-slate-500 text-sm">Tidak Ada Data</p>
                                        <p class="text-xs text-slate-400">Belum ada data bookingan masuk di database RelaXin.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
    // Archive via AJAX (fade out row)
    document.querySelectorAll('.archive-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const row = form.closest('tr');
            const formData = new FormData(form);
            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                });
                if (res.ok) {
                    row.style.transition = 'opacity 0.3s';
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }
            } catch (err) {
                console.error(err);
            }
        });
    });

    // Filter by status + search
    const rows = Array.from(document.querySelectorAll('#reservasiTable .row-item'));
    const searchInput = document.getElementById('searchInput');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const noResult = document.getElementById('noResult');
    let activeFilter = 'all';

    function applyFilters() {
        const q = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;
        rows.forEach(row => {
            const matchesStatus = activeFilter === 'all' || row.dataset.status === activeFilter;
            const matchesSearch = !q || row.dataset.search.includes(q);
            const show = matchesStatus && matchesSearch;
            row.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });
        noResult.classList.toggle('hidden', visibleCount !== 0);
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            activeFilter = btn.dataset.filter;
            filterBtns.forEach(b => b.classList.remove('bg-cyan-600', 'text-white'));
            filterBtns.forEach(b => b.classList.add('bg-slate-100', 'text-slate-600'));
            btn.classList.remove('bg-slate-100', 'text-slate-600');
            btn.classList.add('bg-cyan-600', 'text-white');
            applyFilters();
        });
    });

    searchInput.addEventListener('input', applyFilters);
    </script>
</x-admin>