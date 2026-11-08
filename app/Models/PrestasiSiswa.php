<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'prestasi_siswas';

    protected $fillable = [
        'judul',
        'nama_siswa',
        'kelas',
        'bidang',
        'tingkat',
        'peringkat',
        'penyelenggara',
        'tanggal',
        'deskripsi',
        'foto',
        'urutan',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'urutan' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
