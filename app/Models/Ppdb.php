<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    use HasFactory;

    protected $table = 'ppdbs';

    protected $fillable = [

        // Identitas PPDB
        'nomor_pendaftaran',
        'tahun_pendaftaran',

        // A. Data Calon Siswa
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kondisi_fisik',
        'nik',
        'nomor_akta_kelahiran',
        'no_hp_wa',

        // B. Data Pendidikan
        'sekolah_asal',
        'alamat_sekolah_asal',
        'nisn',
        'mendaftar_sebagai',
        'nomor_ijazah',

        // C. Data Ayah
        'nama_ayah',
        'nik_ayah',
        'no_hp_wa_ayah',
        'pekerjaan_ayah',
        'pendidikan_ayah',
        'alamat_tinggal_ayah',

        // Data Ibu
        'nama_ibu',
        'nik_ibu',
        'no_hp_wa_ibu',
        'pekerjaan_ibu',
        'pendidikan_ibu',
        'alamat_tinggal_ibu',

        // Data Wali
        'nama_wali',
        'nik_wali',
        'no_hp_wa_wali',
        'pekerjaan_wali',
        'pendidikan_wali',
        'alamat_tinggal_wali',

        // Status
        'status',
        'sudah_download',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tahun_pendaftaran' => 'integer',
            'sudah_download' => 'boolean',
        ];
    }
}
