<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('pasien_no_rekam_medis');
            $table->foreign('pasien_no_rekam_medis')->references('no_rekam_medis')->on('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->decimal('berat_badan', 5, 2)->comment('kg');
            $table->decimal('tinggi_badan', 5, 2)->comment('cm');
            $table->string('tekanan_darah')->comment('systolic/diastolic');
            $table->integer('detak_jantung')->comment('bpm');
            $table->decimal('suhu_tubuh', 4, 1)->comment('°C');
            $table->text('riwayat_penyakit')->nullable();
            $table->text('keluhan');
            $table->text('diagnosis');
            $table->text('resep_obat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
