<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sejarah_sekolahs', function (Blueprint $table) {
            $table->id();

            $table->string('judul')->default('Sejarah Sekolah');

            $table->longText('deskripsi');

            $table->string('image')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarah_sekolahs');
    }
};
