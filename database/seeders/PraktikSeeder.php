<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PraktikSeeder extends Seeder
{
    public function run()
    {
        DB::table('praktiks')->insert([
            'nama_praktik' => 'Klinik potrowangsan sehat sejahtera',
            'alamat' => 'potrowangsan sidoarum godean sleman',
            'telepon' => '08123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 