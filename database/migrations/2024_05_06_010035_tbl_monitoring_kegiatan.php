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
        Schema::create('tbl_monitoring_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ormawa')->nullable();
            $table->foreignId('id_proposal_kegiatan')->nullable();
            $table->string('jumlah_dana')->nullable();
            $table->string('saldo')->nullable();
            $table->enum('parameter_keberhasilan', ['tidak berhasil', 'berhasil'])->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_monitoring_kegiatan');
    }
};
