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
        Schema::create('tbl_keterangan_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_monitoring_kegiatan')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->decimal('jumlah_pembayaran', 15, 2)->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_keterangan_pembayaran');
    }
};
