<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RunningText extends Model
{
    protected $table = 'running_texts';

    protected $fillable = [
        'teks',
        'urutan',
        'is_active',
        'warna_background',
        'warna_text',
        'kecepatan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'kecepatan' => 'integer',
    ];

    /**
     * Scope untuk mengambil running text aktif.
     */
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('urutan')
            ->orderBy('id');
    }
}
