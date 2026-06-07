<x-filament-panels::page>
    <form wire:submit.prevent="simpanPendaftaran" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end gap-3">
            <a href="{{ \App\Filament\Resources\PasienResource::getUrl('index') }}" class="fi-btn fi-btn-color-gray bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium border text-gray-700 hover:bg-gray-200">
                Batal
            </a>
            <button type="submit" class="fi-btn fi-btn-color-primary bg-primary-600 px-4 py-2 rounded-lg text-sm font-medium text-white hover:bg-primary-500 shadow-sm">
                Simpan Pendaftaran Meja 1
            </button>
        </div>
    </form>
</x-filament-panels::page>