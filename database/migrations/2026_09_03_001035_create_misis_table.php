<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('misis', function (Blueprint $table) {
            $table->id();

            $table->text('deskripsi');

            $table->unsignedInteger('urutan')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('urutan');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('misis');
    }
};
