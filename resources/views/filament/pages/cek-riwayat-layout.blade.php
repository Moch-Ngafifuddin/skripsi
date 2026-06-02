<div class="space-y-4">
    <div>
        @livewire(\App\Filament\Resources\PemeriksaanBayiResource\Pages\ListPemeriksaanBayis::class, [
            'tableFilters' => [
                'pasien_id' => ['value' => $pasien->id]
            ]
        ])
    </div>
</div>