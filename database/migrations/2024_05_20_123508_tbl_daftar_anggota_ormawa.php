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
        Schema::create('tbl_anggota_ormawa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan_legalitas')->nullable();
            $table->string('nama_anggota')->nullable();
            $table->string('nim')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
