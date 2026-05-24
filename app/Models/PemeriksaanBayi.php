<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemeriksaanBayi extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaan_bayi'; // Sesuaikan nama tabel
    protected $guarded = [];
     protected $fillable = [
        'pasien_id',
        'tgl_periksa',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala',
        'lingkar_lengan',
        'rambu_gizi',
        'titik_pertumbuhan',
        'vitamin_a',
        'obat_cacing',
        'jenis_imunisasi',
        'catatan',
        'deteksi_tbc',
        'kie',
        'rujuk',
        'keterangan_umur',
        'asi_eksklusif',
        'pmba',
        'sdidtk',
    ];

    public function pasien(): BelongsTo {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}