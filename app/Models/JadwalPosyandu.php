<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel secara mutlak di database.
     *
     * @var string
     */
    protected $table = 'jadwal_posyandu';

    /**
     * Mendaftarkan kolom-kolom yang diizinkan untuk memproses pengisian massal (Mass Assignment).
     * Semua field disesuaikan secara presisi dengan kebutuhan skema form Filament.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul_agenda',
        'tanggal_acara',
        'jam_kirim_pesan',
        'kategori_target',
        'isi_pesan',
        'is_aktif',
        'waktu_acara',
        'tempat_acara',
    ];

    /**
     * Memetakan konversi tipe data kolom (Casting) secara otomatis.
     * Sangat penting agar nilai sakelar Toggle dibaca sebagai Boolean (true/false) oleh Laravel,
     * dan tanggal dikonversi menjadi objek Carbon secara otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_acara' => 'date',
        'is_aktif' => 'boolean',
    ];
}