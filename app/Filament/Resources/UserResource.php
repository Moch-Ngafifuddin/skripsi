<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    
    // Kita buat Group Menu baru bernama "Pengaturan" agar terpisah dari data Posyandu
    protected static ?string $navigationGroup = 'Pengaturan';
    
    protected static ?string $navigationLabel = 'Manajemen Akun';
    protected static ?string $pluralModelLabel = 'Manajemen Akun';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('email')->email()->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                    ])->columns(2),

                Forms\Components\Select::make('meja_tugas')
                            ->label('Posisi / Meja Tugas')
                            ->options([
                                'superadmin' => '⭐ Super Admin (Akses Penuh)',
                                'meja_1' => 'Meja 1 (Pendaftaran)',
                                'meja_2' => 'Meja 2 (Tinggi Badan / Fisik)',
                                'meja_3' => 'Meja 3 (Lingkar Kepala / LILA)',
                                'meja_4' => 'Meja 4 (Berat Badan)',
                                'meja_5' => 'Meja 5 (Pelayanan, KIE & Evaluasi)',
                            ])
                            ->required(),

                // --- BAGIAN BARU: PENGATURAN HAK AKSES ---
                Forms\Components\Section::make('Hak Akses Menu')
                    ->description('Centang menu yang boleh diakses petugas ini')
                    ->schema([
                        Forms\Components\CheckboxList::make('akses_menu')
                        ->options([
                            'pasien' => 'Data Balita',    // Kuncinya: pasien
                            'bayi'   => 'Posyandu Balita', // Kuncinya: bayi
                            'remaja' => 'Posyandu Remaja', // Kuncinya: remaja
                            'lansia' => 'Posyandu Lansia', // Kuncinya: lansia
                            'user'   => 'Manajemen Akun',  // Kuncinya: user
                            ])
                            ->columns(2) // Tampil 2 kolom biar rapi
                            ->gridDirection('row'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Sejak')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Tombol Hapus Akun
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        if (Auth::user()?->email === 'admin@posyandu.com' || Auth::user()?->meja_tugas === 'superadmin') {
            return true;
        }
        $akses = Auth::user()?->akses_menu ?? [];
        return in_array('pasien', $akses); // Harus sama dengan kunci di UserResource
    }
}