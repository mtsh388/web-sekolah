<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenaga_pendidiks', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();

            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenaga_pendidiks');
    }
};
