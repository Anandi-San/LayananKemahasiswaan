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
        Schema::create('tbl_lpj_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proposal_kegiatan');
            $table->string('SPJ_kegiatan');
            $table->string('sampul_depan');
            $table->string('judul_LPJ');
            $table->text('pendahuluan_LPJ');
            $table->text('tujuan_LPJ');
            $table->string('nama_dan_tema_kegiatan');
            $table->text('sasaran_kegiatan');
            $table->text('laporan_kegiatan');
            $table->text('realisasi_pencapaian');
            $table->text('evaluasi_kegiatan');
            $table->text('susunan_acara');
            $table->text('kepanitiaan');
            $table->text('dokumentasi_kegiatan');
            $table->text('penangung_jawab_kegiatan');
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
        Schema::dropIfExists('tbl_lpj_kegiatan');
    }
};
