<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasien'; // Wajib
    protected $guarded = []; // Agar bisa save massal

    public function pemeriksaanBayi(): HasMany {
        return $this->hasMany(PemeriksaanBayi::class, 'pasien_id');
    }
    // ... relasi lain bisa ditambahkan nanti
}