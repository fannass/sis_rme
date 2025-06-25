<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaans';
    
    protected $fillable = [
        'tanggal_kunjungan',
        'berat_badan',
        'tinggi_badan',
        'tekanan_darah',
        'detak_jantung',
        'suhu_tubuh',
        'riwayat_penyakit',
        'keluhan',
        'diagnosis',
        'resep_obat',
        'nadi',
        'saturasi_oksigen',
        'respiratory_rate',
        'tindakan',
        'dokter_id',
        'pasien_no_rekam_medis'
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'suhu_tubuh' => 'decimal:1'
    ];

    protected $dates = ['tanggal_kunjungan'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_no_rekam_medis', 'no_rekam_medis');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
} 