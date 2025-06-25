<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pemeriksaan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemeriksaanPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Pemeriksaan $pemeriksaan)
    {
        return $user->id === $pemeriksaan->dokter_id;
    }

    public function update(User $user, Pemeriksaan $pemeriksaan)
    {
        return $user->id === $pemeriksaan->dokter_id;
    }

    public function delete(User $user, Pemeriksaan $pemeriksaan)
    {
        return $user->id === $pemeriksaan->dokter_id;
    }
} 