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
        Schema::create('running_texts', function (Blueprint $table) {
            $table->id();

            // Isi running text
            $table->text('teks');

            // Urutan tampil
            $table->integer('urutan')->default(0)->index();

            // Status tampil
            $table->boolean('is_active')->default(true)->index();

            // Warna background
            $table->string('warna_background', 20)
                ->nullable()
                ->default('#0083b4');

            // Warna teks
            $table->string('warna_text', 20)
                ->nullable()
                ->default('#ffffff');

            // Kecepatan animasi dalam detik
            $table->integer('kecepatan')->default(25);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('running_texts');
    }
};
