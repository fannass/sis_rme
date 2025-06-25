<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokter extends Model
{
    protected $fillable = [
        'user_id',
        'praktik_id',
        'nama',
        'no_telpon',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function praktik(): BelongsTo
    {
        return $this->belongsTo(Praktik::class);
    }

    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class);
    }
} 