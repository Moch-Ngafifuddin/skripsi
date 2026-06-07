<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Get;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Master Balita';
    protected static ?string $pluralModelLabel = 'Data Master Balita';
    protected static ?string $navigationGroup = 'Master Data';

    // Form ini hanya muncul saat melakukan EDIT data
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Utama Balita')->schema([
                    Forms\Components\TextInput::make('nama')->required(),
                    Forms\Components\Radio::make('jenis_kelamin')->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->inline()->required(),
                    Forms\Components\DatePicker::make('tgl_lahir')->required()->native(false),
                    Forms\Components\TextInput::make('nik')->numeric()->maxLength(16),
                    Forms\Components\TextInput::make('no_kk')->numeric()->maxLength(16),
                ])->columns(2),

                Forms\Components\Section::make('Data Kelahiran')->schema([
                    Forms\Components\TextInput::make('berat_lahir')->label('Berat Lahir (Kg)')->numeric(),
                    Forms\Components\TextInput::make('panjang_lahir')->label('Panjang Lahir (Cm)')->numeric(),
                    Forms\Components\TextInput::make('usia_kehamilan')->label('Usia Kehamilan (Minggu)')->numeric(),
                    Forms\Components\Toggle::make('imd')->label('IMD'),
                ])->columns(3),
                
                Forms\Components\Section::make('Orang Tua & Alamat')->schema([
                    Forms\Components\TextInput::make('nama_ibu'),
                    Forms\Components\TextInput::make('nama_ayah'),
                    Forms\Components\Textarea::make('alamat')->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')->label('NIK')->searchable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Balita')->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')->label('L/P'),
                Tables\Columns\TextColumn::make('tgl_lahir')->label('Tanggal Lahir')->date('d M Y'),
                Tables\Columns\TextColumn::make('nama_ibu')->label('Nama Ibu')->searchable(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\PendaftaranBalitaKustom::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}