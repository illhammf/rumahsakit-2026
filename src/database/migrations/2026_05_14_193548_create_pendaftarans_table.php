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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')
                ->constrained('pasiens')
                ->cascadeOnDelete();

            $table->foreignId('jadwal_dokter_id')
                ->constrained('jadwal_dokters')
                ->cascadeOnDelete();

            $table->date('tanggal_daftar');

            $table->text('keluhan');

            $table->enum('status', [
                'Menunggu',
                'Diproses',
                'Selesai'
            ])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
