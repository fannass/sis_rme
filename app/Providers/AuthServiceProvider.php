<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Pemeriksaan;
use App\Policies\PemeriksaanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Pemeriksaan::class => PemeriksaanPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
} 