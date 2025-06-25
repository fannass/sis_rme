<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    
    protected $fillable = [
        'no_rekam_medis',
        'nama',
        'tanggal_lahir',
        'umur',
        'jenis_kelamin',
        'no_telpon',
        'alamat'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'pasien_no_rekam_medis', 'no_rekam_medis');
    }

    public static function generateNoRekamMedis()
    {
        $lastPatient = self::orderBy('no_rekam_medis', 'desc')->first();
        
        if (!$lastPatient) {
            return '00001A';
        }

        $lastNumber = intval(substr($lastPatient->no_rekam_medis, 0, 5));
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        
        return $newNumber . 'A';
    }

    public function calculateAge()
    {
        return $this->tanggal_lahir->age;
    }
} 