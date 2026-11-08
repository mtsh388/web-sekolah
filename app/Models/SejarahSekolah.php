<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahSekolah extends Model
{
    protected $table = 'sejarah_sekolahs';

    protected $fillable = [
        'judul',
        'deskripsi',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
