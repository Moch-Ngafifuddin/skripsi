<div class="space-y-4">
    
    @php
        // Mengubah teks kategori menjadi huruf kecil semua agar pencocokan data 100% akurat
        $kategori = strtolower($pasien->kategori_pasien ?? '');
    @endphp

    {{-- ================= TABEL RIWAYAT BALITA ================= --}}
    @if(in_array($kategori, ['balita', 'bayi']))
        @if($pasien->pemeriksaanBayi && $pasien->pemeriksaanBayi->count() > 0)
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
        @else
            <p class="text-sm text-gray-500 text-center py-4">Belum ada riwayat pemeriksaan untuk balita ini.</p>
        @endif

    {{-- ================= TABEL RIWAYAT REMAJA ================= --}}
    @elseif($kategori === 'remaja')
        @if($pasien->pemeriksaanRemaja && $pasien->pemeriksaanRemaja->count() > 0)
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
        @else
            <p class="text-sm text-gray-500 text-center py-4">Belum ada riwayat pemeriksaan untuk remaja ini.</p>
        @endif

    {{-- ================= TABEL RIWAYAT LANSIA ================= --}}
    @elseif($kategori === 'lansia')
        @if($pasien->pemeriksaanLansia && $pasien->pemeriksaanLansia->count() > 0)
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
        @else
            <p class="text-sm text-gray-500 text-center py-4">Belum ada riwayat pemeriksaan untuk lansia ini.</p>
        @endif
    @else
        {{-- fallback jika data kategori_pasien di luar ekspektasi --}}
        <p class="text-sm text-amber-600 text-center py-4 bg-amber-50 rounded-xl border border-amber-200">
            Kategori pasien tidak dikenali: "{{ $pasien->kategori_pasien ?? 'Kosong' }}"
        </p>
    @endif

</div>