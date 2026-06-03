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
        'keterangan_umur',
        'usia_bulan',
        'berat_badan',
        'tinggi_badan',
        'cara_ukur',
        'lila',
        'lingkar_lengan',
        'lingkar_kepala',
        'status_gizi',
        'status_stunting',
        'zscore_bbu',
        'zscore_tbu',
        'kenaikan_bb',
        'keterangan_bb',
        'pitting_edema',
        'vitamin_a',
        'obat_cacing',
        'jenis_imunisasi',
        'asi_eksklusif',
        'pmba',
        'sdidtk',
        'rambu_gizi',
        'titik_pertumbuhan',
        'deteksi_tbc',
        'kie',
        'rujuk',
        'kelas_ibu',
        'menerima_mbg',
        'catatan',
    ];
    public function pasien(): BelongsTo {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}