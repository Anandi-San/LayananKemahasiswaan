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
        Schema::create('tbl_kemahasiswaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna');
            $table->foreignId('id_superadmin');
            $table->string('ketua_kemahasiswaan');
            $table->date('jabatan_mulai')->nullable();
            $table->date('jabatan_selesai')->nullable();
            $table->enum('status', ['Aktif', 'tidak aktif']);
            $table->text('logo_kemahasiswaan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kemahasiswaan');
    }
};
