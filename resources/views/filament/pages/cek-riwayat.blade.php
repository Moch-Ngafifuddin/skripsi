<div class="space-y-4">
    
    @php
        $punyaDataBalita = isset($pemeriksaan) && $pemeriksaan->count() > 0;
    @endphp

    @if(!$punyaDataBalita)
        <div class="text-center py-8 bg-gray-50 dark:bg-gray-900/40 rounded-xl border border-dashed border-gray-200 dark:border-gray-800">
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada riwayat pemeriksaan bulanan yang tercatat.</p>
        </div>
    @endif

    @if($punyaDataBalita)
        <div class="space-y-2">
            <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-2">
                <h4 class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Arsip Rekam Medis Bulanan (1 Halaman Penuh)
                </h4>
                <span class="text-xs bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 px-2 py-0.5 rounded-md font-mono">
                    {{ $pemeriksaan->count() }} Baris
                </span>
            </div>
            
            <div class="w-full rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse text-[10px] font-sans leading-tight tracking-tight break-words font-normal">
                    <thead>
                        <tr class="bg-gray-200/60 dark:bg-gray-900 text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700 text-center font-normal">
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 w-6 font-normal">No</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">Tgl<br>Periksa</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">BB<br>(Kg)</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">TB<br>(Cm)</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">Cara<br>Ukur</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">BB/U</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">ZS<br>BB/U</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">TB/U</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">ZS<br>TB/U</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">Naik<br>BB</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 w-16 font-normal">Ket.<br>Naik</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">LILA</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal">LK</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal" title="Pitting Edema">Edema</th>
                            <th class="p-1 border-r border-gray-300 dark:border-gray-700 font-normal" title="Kelas Ibu">Kls<br>Ibu</th>
                            <th class="p-1 font-normal" title="Menerima MBG">MBG</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($pemeriksaan as $index => $item)
                            @php
                                $gizi = strtolower($item->status_gizi ?? '');
                                $stunting = strtolower($item->status_stunting ?? '');
                                $naik = strtolower($item->kenaikan_bb ?? '');
                                $isBermasalah = str_contains($gizi, 'buruk') || str_contains($gizi, 'kurang') || str_contains($stunting, 'pendek');
                            @endphp
                            <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors {{ $isBermasalah ? 'bg-amber-50/40 dark:bg-amber-900/10' : '' }}">
                                
                                {{-- 1. No --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 text-gray-500">
                                    {{ $index + 1 }}
                                </td>
                                
                                {{-- 2. Tgl (Format Pendek: 14/06/26) --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-gray-800 dark:text-gray-200">
                                    {{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d/m/y') }}
                                </td>
                                
                                {{-- 3. BB --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-blue-600 dark:text-blue-400">
                                    {{ $item->berat_badan ? number_format($item->berat_badan, 1) : '-' }}
                                </td>
                                
                                {{-- 4. TB --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-emerald-600 dark:text-emerald-400">
                                    {{ $item->tinggi_badan ? number_format($item->tinggi_badan, 1) : '-' }}
                                </td>

                                {{-- 5. Cara Ukur --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400">
                                    {{ $item->cara_ukur ?? '-' }}
                                </td>
                                
                                {{-- 6. BB/U --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800">
                                    <span class="{{ str_contains($gizi, 'normal') ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->status_gizi ?? '-' }}
                                    </span>
                                </td>

                                {{-- 7. ZS BB/U --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400">
                                    {{ $item->zscore_bbu ?? '-' }}
                                </td>
                                
                                {{-- 8. TB/U --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800">
                                    <span class="{{ str_contains($stunting, 'normal') ? 'text-green-600' : 'text-amber-600' }}">
                                        {{ $item->status_stunting ?? '-' }}
                                    </span>
                                </td>

                                {{-- 9. ZS TB/U --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400">
                                    {{ $item->zscore_tbu ?? '-' }}
                                </td>

                                {{-- 10. Naik BB --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800
                                    {{ $naik === 'naik' ? 'text-green-600' : ($naik === 'tidak naik' ? 'text-red-500' : 'text-gray-500') }}">
                                    {{ strtoupper($item->kenaikan_bb ?? '-') }}
                                </td>

                                {{-- 11. Ket. Naik BB --}}
                                <td class="p-1 border-r border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400">
                                    {{ $item->keterangan_bb ?? '-' }}
                                </td>
                                
                                {{-- 12. LILA --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300">
                                    {{ $item->lila ? number_format($item->lila, 1) : '-' }}
                                </td>
                                
                                {{-- 13. LK --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300">
                                    {{ $item->lingkar_kepala ? number_format($item->lingkar_kepala, 1) : '-' }}
                                </td>

                                {{-- 14. Edema (Y/T) --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800">
                                    {!! ($item->pitting_edema ?? false) ? '<span class="text-red-600">Y</span>' : '<span class="text-gray-400">T</span>' !!}
                                </td>

                                {{-- 15. Kelas Ibu (Y/T) --}}
                                <td class="p-1 text-center border-r border-gray-200 dark:border-gray-800">
                                    {!! ($item->kelas_ibu ?? false) ? '<span class="text-green-600">Y</span>' : '<span class="text-gray-400">T</span>' !!}
                                </td>

                                {{-- 16. MBG (Y/T) --}}
                                <td class="p-1 text-center">
                                    {!! ($item->menerima_mbg ?? false) ? '<span class="text-blue-600">Y</span>' : '<span class="text-gray-400">T</span>' !!}
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>