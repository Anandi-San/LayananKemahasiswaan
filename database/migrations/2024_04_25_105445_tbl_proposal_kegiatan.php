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
        Schema::create('tbl_proposal_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_SK_legalitas');
            $table->string('sampul_depan');
            $table->string('judul_kegiatan');
            $table->text('pendahuluan_kegiatan');
            $table->text('tujuan_kegiatan');
            $table->string('nama_kegiatan');
            $table->text('bentuk_kegiatan');
            $table->text('sasaran');
            $table->text('parameter_keberhasilan');
            $table->text('waktu_dan_tempat_kegiatan');
            $table->text('sususan_acara');
            $table->text('rancangan_anggaran_biaya');
            $table->text('kepanitiaan');
            $table->text('penanggung_jawab');
            $table->text('penutup');
            $table->string('lampiran1')->nullable();
            $table->string('lampiran2')->nullable();
            $table->string('lampiran3')->nullable();
            $table->string('sampul_belakang');
            $table->enum('status', ['Belum Unggah','Menunggu', 'Revisi Pembina', 'Telah Direvisi', 'Disetujui Pembina', 'Revisi Kemahasiswaan', 'Telah Direvisi Kemahasiswaan', 'Disetujui'])->default('Belum Unggah')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proposal_kegiatan');
    }
};
