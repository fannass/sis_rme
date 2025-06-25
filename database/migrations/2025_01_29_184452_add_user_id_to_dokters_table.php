<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dokters', function (Blueprint $table) {
            // Hapus kolom yang redundan karena sudah ada di tabel users
            $table->dropColumn(['email', 'password']);
            
            // Tambah kolom user_id setelah kolom id
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->string('password');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};