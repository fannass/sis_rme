<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Praktik extends Model
{
    protected $table = 'praktiks';
    
    protected $fillable = [
        'nama_praktik',
        'alamat',
        'telepon',
        'kota'
    ];

    public function dokter()
    {
        return $this->hasMany(User::class, 'praktik_id');
    }
} 