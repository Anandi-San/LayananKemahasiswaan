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
        Schema::create('tbl_register', function (Blueprint $table) {
            $table->id();
            $table->string('email_pengguna');
            $table->string('nama_ormawa');
            $table->enum('jenis_ormawa', ['Eksekutif', 'Legislatif', 'UKM']);
            $table->string('nama_dosen_pembina');
            $table->string('nomor_telopen_PIC');
            $table->string('jurusan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_register');
    }
};
