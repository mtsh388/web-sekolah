<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdbs', function (Blueprint $table) {

            // ============================================================
            // IDENTITAS PPDB
            // ============================================================

            $table->id();

            $table->string('nomor_pendaftaran')->unique();

            $table->string('tahun_pendaftaran');

            // ============================================================
            // A. DATA CALON SISWA
            // ============================================================

            $table->string('nama_lengkap');

            $table->string('tempat_lahir')->nullable();

            $table->date('tanggal_lahir')->nullable();

            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan'
            ])->nullable();

            $table->text('alamat')->nullable();

            $table->string('kondisi_fisik')->nullable();

            $table->string('nik', 16)->nullable();

            $table->string('nomor_akta_kelahiran')->nullable();

            $table->string('no_hp_wa')->nullable();

            // ============================================================
            // B. DATA PENDIDIKAN
            // ============================================================

            $table->string('sekolah_asal')->nullable();

            $table->text('alamat_sekolah_asal')->nullable();

            $table->string('nisn', 10)->nullable();

            $table->string('mendaftar_sebagai')->nullable();

            $table->string('nomor_ijazah')->nullable();

            // ============================================================
            // C. DATA ORANG TUA / WALI
            // ============================================================

            // ------------------------------------------------------------
            // AYAH
            // ------------------------------------------------------------

            $table->string('nama_ayah')->nullable();

            $table->string('nik_ayah', 16)->nullable();

            $table->string('no_hp_wa_ayah')->nullable();

            $table->string('pekerjaan_ayah')->nullable();

            $table->string('pendidikan_ayah')->nullable();

            $table->text('alamat_tinggal_ayah')->nullable();

            // ------------------------------------------------------------
            // IBU
            // ------------------------------------------------------------

            $table->string('nama_ibu')->nullable();

            $table->string('nik_ibu', 16)->nullable();

            $table->string('no_hp_wa_ibu')->nullable();

            $table->string('pekerjaan_ibu')->nullable();

            $table->string('pendidikan_ibu')->nullable();

            $table->text('alamat_tinggal_ibu')->nullable();

            // ------------------------------------------------------------
            // WALI
            // ------------------------------------------------------------

            $table->string('nama_wali')->nullable();

            $table->string('nik_wali', 16)->nullable();

            $table->string('no_hp_wa_wali')->nullable();

            $table->string('pekerjaan_wali')->nullable();

            $table->string('pendidikan_wali')->nullable();

            $table->text('alamat_tinggal_wali')->nullable();

            // ============================================================
            // STATUS PPDB
            // ============================================================

            $table->enum('status', [
                'menunggu',
                'diverifikasi',
                'diterima',
                'ditolak'
            ])->default('menunggu');

            // Catatan dari pihak sekolah
            $table->text('catatan')->nullable();

            $table->timestamps();

            // ============================================================
            // INDEX
            // ============================================================

            $table->index('tahun_pendaftaran');
            $table->index('nama_lengkap');
            $table->index('nik');
            $table->index('nisn');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
