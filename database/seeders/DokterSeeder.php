<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi@dokter.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
            ],
            [
                'name' => 'Dr. Siti Rahayu',
                'email' => 'siti@dokter.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
            ],
            [
                'name' => 'Dr. Ahmad Hidayat',
                'email' => 'ahmad@dokter.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
            ]
        ];

        foreach ($dokters as $dokter) {
            User::create($dokter);
        }
    }
} 