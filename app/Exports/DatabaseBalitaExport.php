<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DatabaseBalitaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $records;
    protected $rowNumber = 0;

    // Menerima data terfilter dari Filament agar bebas N+1 Query
    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    // 1. MEMBUAT HEADINGS (JUDUL KOLOM) YANG RAPI
    public function headings(): array
    {
        return [
            'No',
            'NIK Balita',
            'Nama Lengkap',
            'JK',
            'Tanggal Lahir',
            'Nama Ortu (Ibu)',
            'Provinsi',
            'Kab/Kota',
            'Kecamatan',
            'Puskesmas',
            'Desa/Kel',
            'Posyandu'
        ];
    }

    // 2. MEMETAKAN DATA SESUAI SUSUNAN KOLOM
    public function map($row): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $row->pasien?->nik ? "'" . $row->pasien->nik : '-', // Trik tanda kutip (') agar NIK tidak rusak di Excel
            $row->pasien?->nama ?? '-',
            $row->pasien?->jenis_kelamin ?? '-',
            $row->pasien?->tgl_lahir ? \Carbon\Carbon::parse($row->pasien->tgl_lahir)->format('d-m-Y') : '-',
            $row->pasien?->nama_ibu ?? '-',
            auth()->user()?->provinsi ?? '-',
            auth()->user()?->kabupaten_kota ?? '-',
            auth()->user()?->kecamatan ?? '-',
            auth()->user()?->nama_puskesmas ?? '-',
            auth()->user()?->desa_kelurahan ?? '-',
            auth()->user()?->nama_posyandu ?? '-',
        ];
    }

    // 3. MEMBERI STYLE (Menebalkan Header Otomatis)
    public function styles(Worksheet $sheet)
    {
        return [
            // Baris nomor 1 (Header) akan otomatis Bold/Tebal
            1 => ['font' => ['bold' => true]],
        ];
    }
}