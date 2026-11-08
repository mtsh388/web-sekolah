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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();

            // Informasi Fasilitas
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();

            // Informasi Tambahan
            $table->string('lokasi')->nullable();
            $table->string('jumlah')->nullable();

            // Pengaturan
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Index
            $table->index('urutan');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
