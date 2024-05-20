<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_ormawa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna');
            $table->string('nama_ormawa')->unique();
            $table->enum('jenis_ormawa', ['Eksekutif', 'Legislatif', 'UKM']);
            $table->string('singkatan')->nullable();
            $table->text('logo_ormawa')->nullable();
            $table->string('jurusan')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('tbl_ormawa');
    }
};
