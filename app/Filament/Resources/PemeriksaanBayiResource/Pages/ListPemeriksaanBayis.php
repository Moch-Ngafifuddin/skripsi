<?php

namespace App\Filament\Resources\PemeriksaanBayiResource\Pages;

use App\Filament\Resources\PemeriksaanBayiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ListPemeriksaanBayis extends ListRecords
{
    protected static string $resource = PemeriksaanBayiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Pendaftaran Baru (Zona A)'),
        ];
    }

    // 🟢 TAMPILAN ANTREAN REAL-TIME BERDASARKAN MEJA TUGAS
    protected function modifyFormActions(array $actions): array
    {
        return $actions;
    }

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery()->with(['pasien']);
        $meja = Auth::user()?->meja_tugas;

        // Jika dia petugas Timbang (Zona B), hanya munculkan balita yang berat_badannya belum diisi hari ini
        if (in_array($meja, ['meja_2', 'meja_4'])) {
            return $query->whereNull('berat_badan')->whereDate('tgl_periksa', now()->toDateString());
        }

        // Jika dia Bidan (Zona C), hanya munculkan balita yang SUDAH ditimbang Zona B tapi BELUM diberi evaluasi catatan
        if ($meja === 'meja_5') {
            return $query->whereNotNull('berat_badan')->whereNull('catatan')->whereDate('tgl_periksa', now()->toDateString());
        }

        // Superadmin melihat seluruh database historis
        return $query;
    }
}