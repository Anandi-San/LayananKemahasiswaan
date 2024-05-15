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
        Schema::create('tbl_legalitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_register');
            $table->binary('proposal_legalitas');
            $table->binary('AD/ART');
            $table->binary('surat_permohonan_pengajuan_legalitas');
            $table->binary('biodata_pembina');
            $table->binary('struktur_organisasi');
            $table->binary('daftar_sarana_prasarana');
            $table->binary('GBHK');
            $table->binary('bukti_pelakasanaan_musyawarah');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_legalitas');
    }
};
