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
        Schema::create('tbl_SK_legalitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan_legalitas');
            $table->string('nomor_SK')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_berlaku_mulai')->nullable();
            $table->date('tanggal_berlaku_selesai')->nullable();
            $table->string('file_SK')->nullable();
            $table->enum('status', ['Tidak Aktif', 'Aktif'])->default('Tidak Aktif')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_SK_legalitas');
    }
};
