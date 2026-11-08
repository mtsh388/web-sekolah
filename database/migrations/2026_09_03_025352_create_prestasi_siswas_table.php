<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi_siswas', function (Blueprint $table) {
            $table->id();

            // Data Prestasi
            $table->string('judul');
            $table->string('nama_siswa');
            $table->string('kelas')->nullable();

            // Informasi Kejuaraan
            $table->string('bidang')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('peringkat')->nullable();
            $table->string('penyelenggara')->nullable();

            // Waktu
            $table->date('tanggal')->nullable();

            // Konten
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();

            // Pengaturan
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('nama_siswa');
            $table->index('tingkat');
            $table->index('bidang');
            $table->index('tanggal');
            $table->index('urutan');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswas');
    }
};
