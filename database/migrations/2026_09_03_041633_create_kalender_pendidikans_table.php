<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender_pendidikans', function (Blueprint $table) {
            $table->id();

            // Tahun ajaran
            $table->string('tahun_ajaran', 20);

            // Informasi kegiatan
            $table->string('judul');
            $table->text('deskripsi')->nullable();

            // Periode kegiatan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();

            // Kategori kegiatan
            $table->string('kategori')->nullable();

            // Warna badge / kalender
            $table->string('warna', 20)->nullable();

            // Pengaturan tampilan
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Index
            $table->index('tahun_ajaran');
            $table->index('tanggal_mulai');
            $table->index('tanggal_selesai');
            $table->index('kategori');
            $table->index('urutan');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_pendidikans');
    }
};
