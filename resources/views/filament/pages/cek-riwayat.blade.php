<div class="space-y-6">
    
    @php
        // Menguji langsung keberadaan data pemeriksaan tanpa mengecek kolom kategori
        $punyaDataBalita  = $pasien->pemeriksaanBayi && $pasien->pemeriksaanBayi->count() > 0;
        $punyaDataRemaja  = $pasien->pemeriksaanRemaja && $pasien->pemeriksaanRemaja->count() > 0;
        $punyaDataLansia  = $pasien->pemeriksaanLansia && $pasien->pemeriksaanLansia->count() > 0;
    @endphp

    {{-- JIKA SAMA SEKALI BELUM PERNAH PERIKSA --}}
    @if(!$punyaDataBalita && !$punyaDataRemaja && !$punyaDataLansia)
        <div class="text-center py-6">
            <p class="text-sm text-gray-500">Belum ada riwayat pemeriksaan medis yang tercatat untuk pasien ini.</p>
        </div>
    @endif

    {{-- ================= TAMPILKAN TABEL BALITA (JIKA ADA DATANYA) ================= --}}
    @if($punyaDataBalita)
        <div class="space-y-2">
            <h4 class="text-xs font-bold text-pink-600 uppercase tracking-wider">Riwayat Posyandu Balita</h4>
            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold border-b border-gray-200 dark:border-gray-800">
                            <th class="p-3">Tanggal Periksa</th>
                            <th class="p-3">Berat (kg)</th>
                            <th class="p-3">Tinggi (cm)</th>
                            <th class="p-3">L. Kepala (cm)</th>
                            <th class="p-3">ASI Eksklusif</th>
                            <th class="p-3">Status Gizi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($pasien->pemeriksaanBayi->sortByDesc('created_at') as $item)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30">
                                <td class="p-3 font-medium">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="p-3">{{ $item->berat ?? '-' }}</td>
                                <td class="p-3">{{ $item->tinggi ?? '-' }}</td>
                                <td class="p-3">{{ $item->lingkar_kepala ?? '-' }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded text-xs {{ strtolower($item->asi ?? '') == 'ya' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ strtoupper($item->asi ?? 'TIDAK') }}
                                    </span>
                                </td>
                                <td class="p-3 text-primary-600 font-bold">{{ $item->status_gizi ?? 'Belum dihitung' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <!-- @endif

    {{-- ================= TAMPILKAN TABEL REMAJA (JIKA ADA DATANYA) ================= --}}
    @if($punyaDataRemaja)
        <div class="space-y-2">
            <h4 class="text-xs font-bold text-blue-600 uppercase tracking-wider">Riwayat Posyandu Remaja</h4>
            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold border-b border-gray-200 dark:border-gray-800">
                            <th class="p-3">Tanggal Periksa</th>
                            <th class="p-3">Berat (kg)</th>
                            <th class="p-3">Tinggi (cm)</th>
                            <th class="p-3">Tensi Darah</th>
                            <th class="p-3">L. Lengan (LILA)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($pasien->pemeriksaanRemaja->sortByDesc('created_at') as $item)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30">
                                <td class="p-3 font-medium">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="p-3">{{ $item->berat ?? '-' }}</td>
                                <td class="p-3">{{ $item->tinggi ?? '-' }}</td>
                                <td class="p-3">{{ $item->tensi_darah ?? '-' }}</td>
                                <td class="p-3">{{ $item->lingkar_lengan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- ================= TAMPILKAN TABEL LANSIA (JIKA ADA DATANYA) ================= --}}
    @if($punyaDataLansia)
        <div class="space-y-2">
            <h4 class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Riwayat Posyandu Lansia</h4>
            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold border-b border-gray-200 dark:border-gray-800">
                            <th class="p-3">Tanggal Periksa</th>
                            <th class="p-3">Berat (kg)</th>
                            <th class="p-3">Tensi Darah</th>
                            <th class="p-3">Gula Darah</th>
                            <th class="p-3">Kolesterol</th>
                            <th class="p-3">Asam Urat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($pasien->pemeriksaanLansia->sortByDesc('created_at') as $item)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30">
                                <td class="p-3 font-medium">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="p-3">{{ $item->berat ?? '-' }}</td>
                                <td class="p-3">{{ $item->tensi_darah ?? '-' }}</td>
                                <td class="p-3">{{ $item->gula_darah ?? '-' }}</td>
                                <td class="p-3">{{ $item->kolesterol ?? '-' }}</td>
                                <td class="p-3">{{ $item->asam_urat ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif -->

</div>