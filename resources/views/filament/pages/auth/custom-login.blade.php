@props([
    'warna_tema' => '#10b981',
    'nama_puskesmas' => 'Puskesmas',
    'pengaturan' => null,
])

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap&display=swap');

    :root {
        --primary: {{ $warna_tema }};
    }

    * {
        font-family: 'Poppins', sans-serif;
    }

    .hide-scroll::-webkit-scrollbar {
        display: none;
    }

    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .login-card {
        backdrop-filter: blur(12px);
        transition: all .25s ease;
    }

    .login-card:hover {
        transform: translateY(-2px);
    }

    .fi-btn-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        border-radius: 14px !important;
        min-height: 50px !important;
        font-weight: 600 !important;
        transition: all .2s ease-in-out;
    }

    .fi-btn-primary:hover {
        filter: brightness(.95);
        transform: translateY(-1px);
    }

    .fi-btn-primary:disabled {
        opacity: .7;
        cursor: not-allowed;
        transform: none;
    }

    .fi-input {
        border-radius: 14px !important;
        min-height: 48px !important;
    }

    .fi-input:focus {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, .15) !important;
    }

    .logo-item img {
        transition: transform .2s ease;
    }

    .logo-item:hover img {
        transform: scale(1.05);
    }

    .loading-spinner {
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255,255,255,.3);
        border-top-color: white;
        border-radius: 9999px;
        animation: spin .8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div
    class="login-card w-full max-w-md bg-white rounded-3xl sm:rounded-[32px] shadow-2xl flex flex-col max-h-full overflow-y-auto hide-scroll p-6 sm:p-8 xl:p-10 border border-slate-100">

    {{-- Logo Partner --}}
    @if(is_array($pengaturan?->logos) && count($pengaturan->logos))
        <div class="mb-6 xl:mb-8 flex flex-wrap items-center justify-center gap-4">
            @foreach($pengaturan->logos as $item)
                @continue(empty($item['path_logo']))

                <div class="logo-item">
                    <img
                        src="{{ Storage::url($item['path_logo']) }}"
                        alt="Logo Instansi"
                        loading="lazy"
                        class="{{ $item['tinggi_logo'] ?? 'h-8' }} w-auto object-contain">
                </div>
            @endforeach
        </div>
    @endif

    {{-- Header --}}
    <div class="text-center mb-6 xl:mb-8">
        <h2 class="text-2xl xl:text-3xl font-extrabold text-slate-900 tracking-tight">
            LOGIN AKUN
        </h2>

        <p class="text-slate-500 text-xs xl:text-sm mt-2">
            Masuk menggunakan kredensial petugas yang valid.
        </p>
    </div>

    {{-- Form Login --}}
    <div class="w-full">

        <x-filament-panels::form wire:submit="authenticate">

            {{ $this->form }}

            <div class="mt-5 xl:mt-6">

                <x-filament-panels::form.actions
                    :actions="$this->getCachedFormActions()"
                    :full-width="true"
                />

            </div>

            {{-- Loading State --}}
            <div
                wire:loading.flex
                wire:target="authenticate"
                class="items-center justify-center gap-2 mt-4 text-sm text-slate-500">

                <div class="loading-spinner"></div>

                <span>Memverifikasi akun...</span>

            </div>

        </x-filament-panels::form>

    </div>

    {{-- Footer --}}
    <div class="text-center mt-8 xl:mt-10 pt-5 xl:pt-6 border-t border-slate-100">
        <div class="text-[10px] xl:text-xs text-slate-400 font-medium">
            &copy; {{ now()->year }} {{ $nama_puskesmas }}
        </div>

        <div class="mt-1 text-[10px] text-slate-300">
            Sistem Informasi Posyandu Terintegrasi
        </div>
    </div>

</div>