<div class="min-h-screen flex items-center justify-center bg-gray-100 font-['Poppins'] p-4 sm:p-8">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        .bg-dinamis { 
            background-color: {{ $warna_tema ?? '#10b981' }}; /* Default warna hijau mirip referensi */
        }
        /* Kustomisasi gaya input form Filament agar lebih membaur */
        .fi-btn-primary {
            background-color: {{ $warna_tema ?? '#10b981' }} !important;
        }
    </style>

    <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden min-h-[550px]">

        <div class="md:w-5/12 bg-dinamis p-10 lg:p-12 flex flex-col items-center justify-center text-center text-white relative">
            
            <div class="absolute inset-0 bg-black/5 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col items-center">
                
                @if($logo)
                    <div class="bg-white/10 p-3 rounded-full backdrop-blur-md mb-6 shadow-sm border border-white/20">
                        <img src="{{ $logo }}" alt="Logo" class="h-16 w-16 lg:h-20 lg:w-20 object-contain drop-shadow-md">
                    </div>
                @endif

                <h1 class="text-3xl lg:text-4xl font-bold mb-4 leading-snug tracking-wide">
                    {{ $teks_login }}
                </h1>

                <div class="w-12 h-1 bg-white/60 rounded-full mb-6"></div>

                <p class="text-sm text-white/90 font-light leading-relaxed mb-10">
                    Untuk tetap terhubung dengan kami, silakan masuk menggunakan kredensial petugas yang valid untuk mengakses sistem pemantauan terpadu.
                </p>

                <div class="px-8 py-2.5 rounded-full border border-white/80 text-white font-medium tracking-wider text-sm transition-all hover:bg-white/10">
                    {{ $nama_puskesmas }}
                </div>
                
            </div>
        </div>

        <div class="md:w-7/12 p-8 sm:p-12 lg:p-16 flex flex-col justify-center bg-white relative">
            
            <div class="w-full max-w-md mx-auto">
                
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Masuk Akun</h2>
                    <p class="text-sm text-gray-500 font-medium">Gunakan email anda untuk otentikasi</p>
                </div>

                <x-filament-panels::form wire:submit="authenticate">
                    {{ $this->form }}

                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="$this->hasFullWidthFormActions()"
                        class="mt-8"
                    />
                </x-filament-panels::form>
                
            </div>
        </div>

    </div>
</div>