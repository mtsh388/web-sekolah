<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekstrakurikulers', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();

            $table->string('pembina')->nullable();
            $table->string('jadwal')->nullable();

            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('urutan');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikulers');
    }
};
