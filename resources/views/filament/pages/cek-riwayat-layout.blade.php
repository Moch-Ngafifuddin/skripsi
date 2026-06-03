<div class="space-y-4">
    {{-- Memanggil file cek-riwayat dengan melemparkan data riwayat pemeriksaan milik pasien ini secara berurutan --}}
    @include('filament.pages.cek-riwayat', [
        'pemeriksaan' => $getRecord()?->pemeriksaanBayi()->orderBy('id', 'desc')->get()
    ])
</div>