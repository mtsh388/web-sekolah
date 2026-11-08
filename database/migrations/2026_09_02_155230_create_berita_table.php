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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();

            // Informasi utama
            $table->string('title');
            $table->string('youtube_url')->nullable();
            $table->string('slug')->unique();
            $table->longText('content');

            // Kategori berita
            $table->string('category')->nullable();

            // Gambar utama
            $table->string('image')->nullable();

            // Status publikasi
            $table->enum('status', [
                'draft',
                'published',
                'archived'
            ])->default('draft');

            // Tanggal publikasi
            $table->timestamp('published_at')->nullable();

            // Berita unggulan
            $table->boolean('is_featured')->default(false);

            // Statistik
            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();

            // Index
            $table->index('category');
            $table->index('status');
            $table->index('published_at');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
