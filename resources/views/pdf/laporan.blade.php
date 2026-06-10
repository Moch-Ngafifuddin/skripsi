<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekam Medis & Grafik Tumbuh Kembang</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f3f4f6; font-weight: bold; }
        .grafik-container { text-align: center; margin-top: 25px; page-break-inside: avoid; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Rekam Medis & Grafik Tumbuh Kembang Balita</h2>
        <p style="font-size: 13px; margin: 5px 0;">
            <strong>Nama Balita:</strong> {{ $pasien->nama }} ({{ $pasien->jenis_kelamin }})
        </p>
    </div>

    <h3>Riwayat Lengkap Pemeriksaan</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal Periksa</th>
                <th>Usia (Bln)</th>
                <th>BB (Kg)</th>
                <th>TB (Cm)</th>
                <th>Status Gizi (BB/U)</th>
                <th>Status Stunting (TB/U)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemeriksaan as $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->translatedFormat('d-m-Y') }}</td>
                <td>{{ $item->usia_bulan }} Bulan</td>
                <td>{{ $item->berat_badan }} Kg</td>
                <td>{{ $item->tinggi_badan }} Cm</td>
                <td><strong>{{ $item->status_gizi }}</strong></td>
                <td><strong>{{ $item->status_stunting }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @php
        // Konfigurasi dasar kanvas SVG grafik
        $width = 520;
        $height = 200;
        $padding = 40;
        $chartWidth = $width - ($padding * 2);
        $chartHeight = $height - ($padding * 2);

        $totalData = $pemeriksaan->count();

        // Daftar blueprint grafik yang ingin dicetak ke PDF
        $daftarGrafik = [
            [
                'judul' => '1. Grafik Perkembangan Berat Badan menurut Umur (BB/U)',
                'kolom_y' => 'berat_badan',
                'satuan' => 'kg',
                'warna_garis' => '#3b82f6', // Biru
                'warna_titik' => '#1d4ed8'
            ],
            [
                'judul' => '2. Grafik Perkembangan Tinggi Badan menurut Umur (TB/U)',
                'kolom_y' => 'tinggi_badan',
                'satuan' => 'cm',
                'warna_garis' => '#10b981', // Hijau
                'warna_titik' => '#047857'
            ],
            [
                'judul' => '3. Grafik Tren Nilai Antropometri Z-Score (BB/U)',
                'kolom_y' => 'zscore_bbu',
                'satuan' => 'SD',
                'warna_garis' => '#f59e0b', // Jingga
                'warna_titik' => '#b45309'
            ]
        ];
    @endphp

    @if($totalData > 0)
        @foreach($daftarGrafik as $grafik)
            <div class="grafik-container">
                <h3 style="font-size: 12px; margin-bottom: 10px; color: #1e3a8a;">{{ $grafik['judul'] }}</h3>

                @php
                    // Ambil rentang nilai Y secara dinamis sesuai kolom data
                    $nilaiY = $pemeriksaan->pluck($grafik['kolom_y'])->map(fn($v) => (float)$v);
                    $maxVal = $nilaiY->max() > 0 ? $nilaiY->max() : 10;
                    $minVal = $nilaiY->min() < 0 ? $nilaiY->min() : 0;
                    
                    // Skala batas atas & bawah grafik agar tidak mentok bingkai
                    $yMax = $grafik['kolom_y'] == 'zscore_bbu' ? ceil($maxVal + 1) : ceil($maxVal + 2);
                    $yMin = $grafik['kolom_y'] == 'zscore_bbu' ? floor($minVal - 1) : 0;
                    $yValueRange = ($yMax - $yMin) > 0 ? ($yMax - $yMin) : 1;
                @endphp

                <svg width="{{ $width }}" height="{{ $height }}" style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; font-family: sans-serif;">
                    
                    @for($i = 0; $i <= 4; $i++)
                        @php
                            $gridY = $padding + ($chartHeight * (4 - $i) / 4);
                            $valY = $yMin + ($yValueRange * $i / 4);
                        @endphp
                        <line x1="{{ $padding }}" y1="{{ $gridY }}" x2="{{ $width - $padding }}" y2="{{ $gridY }}" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,4" />
                        <text x="{{ $padding - 8 }}" y="{{ $gridY + 4 }}" font-size="9" fill="#64748b" text-anchor="end">{{ number_format($valY, 1) }}{{ $grafik['satuan'] }}</text>
                    @endfor

                    <line x1="{{ $padding }}" y1="{{ $padding }}" x2="{{ $padding }}" y2="{{ $height - $padding }}" stroke="#475569" stroke-width="2" />
                    <line x1="{{ $padding }}" y1="{{ $height - $padding }}" x2="{{ $width - $padding }}" y2="{{ $height - $padding }}" stroke="#475569" stroke-width="2" />

                    @php
                        $points = [];
                        foreach($pemeriksaan as $index => $item) {
                            $currentVal = (float) $item->{$grafik['kolom_y']};
                            $x = $padding + ($totalData > 1 ? ($chartWidth * $index / ($totalData - 1)) : ($chartWidth / 2));
                            $y = $height - $padding - (($currentVal - $yMin) / $yValueRange * $chartHeight);
                            $points[] = "$x,$y";
                        }
                        $polylineCoordinates = implode(' ', $points);
                    @endphp

                    @if($totalData > 1)
                        <polyline points="{{ $polylineCoordinates }}" fill="none" stroke="{{ $grafik['warna_garis'] }}" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    @endif

                    @foreach($pemeriksaan as $index => $item)
                        @php
                            $coord = explode(',', $points[$index]);
                            $cx = $coord[0];
                            $cy = $coord[1];
                            $currentVal = (float) $item->{$grafik['kolom_y']};
                        @endphp
                        
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="3.5" fill="{{ $grafik['warna_titik'] }}" stroke="#ffffff" stroke-width="1.5" />
                        <text x="{{ $cx }}" y="{{ $cy - 8 }}" font-size="8.5" font-weight="bold" fill="#0f172a" text-anchor="middle">{{ number_format($currentVal, 1) }}</text>
                        
                        <text x="{{ $cx }}" y="{{ $height - $padding + 14 }}" font-size="8" fill="#475569" text-anchor="middle" transform="rotate(15, {{ $cx }}, {{ $height - $padding + 14 }})">
                            {{ $item->usia_bulan }} Bln
                        </text>
                    @endforeach
                </svg>
            </div>
        @endforeach
    @else
        <p style="color: #64748b; font-style: italic; text-align: center; margin-top: 20px;">Belum ada riwayat data pemeriksaan bulanan untuk memetakan grafik.</p>
    @endif
</body>
</html>