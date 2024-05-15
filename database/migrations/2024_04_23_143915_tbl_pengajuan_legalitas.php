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
        Schema::create('tbl_pengajuan_legalitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ormawa_pembina');
            $table->foreignId('id_kemahasiswaan')->nullable();
            $table->string('proposal_legalitas')->nullable();
            $table->string('AD_ART')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->text('daftar_nama_kepengurusan')->nullable();
            $table->string('biodata_pembina')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('daftar_sarana_prasarana')->nullable();
            $table->string('GBHK')->nullable();
            $table->string('LPJ_kepengurusan')->nullable();
            $table->enum('status', ['Belum Unggah', 'Menunggu', 'Revisi Kemahasiswaan', 'Telah Dorevisi', 'Disetujui'])->default('Belum Unggah')->nullable();
            $table->timestamps();
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
