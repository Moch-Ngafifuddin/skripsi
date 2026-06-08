<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; }
        .grafik-container { text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Rekam Medis & Grafik Tumbuh Kembang</h2>
        <p>Balita: {{ $pasien->nama }} ({{ $pasien->jenis_kelamin }})</p>
    </div>

    <h3>Riwayat Lengkap Pemeriksaan</h3>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Usia (Bln)</th>
            <th>BB (Kg)</th>
            <th>TB (Cm)</th>
            <th>Status Gizi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pasien->pemeriksaanBayi as $item)
        <tr>
            <td>{{ $item->tgl_periksa }}</td>
            <td>{{ $item->usia_bulan }}</td>
            <td>{{ $item->berat_badan }}</td>
            <td>{{ $item->tinggi_badan }}</td>
            <td>{{ $item->status_gizi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="grafik-container">
    <h3>Grafik Perkembangan BB/U</h3>
    <img src="{{ $chartImage }}" style="width: 100%;">
</div>
</body>
</html>