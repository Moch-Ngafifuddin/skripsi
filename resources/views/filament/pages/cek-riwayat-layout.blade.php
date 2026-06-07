<div class="space-y-4">
    @php
        $pasienId = $getRecord()?->id;
    @endphp

    @if($pasienId)
        {{-- Memanggil Livewire Widget dengan parameter pasienId yang dinamis --}}
        @livewire('filament.resources.pasien-resource.widgets.grafik-kms-personal', [
            'pasienId' => $pasienId
        ])
    @else
        <div class="p-4 text-sm text-gray-500 bg-gray-50 rounded-lg">
            Data balita tidak ditemukan, grafik tidak dapat dimuat.
        </div>
    @endif
</div>