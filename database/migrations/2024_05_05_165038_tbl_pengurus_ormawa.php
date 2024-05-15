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
        Schema::create('tbl_pengurus_ormawa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ormawa');
            $table->string('nama_kabinet');
            $table->string('ketua_ormawa');
            $table->string('visi');
            $table->text('misi');
            $table->date('kabinet_masa_mulai')->nullable();
            $table->date('kabinet_masa_selesai')->nullable();
            $table->text('logo_kabinet')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengurus_ormawa');
    }
};
