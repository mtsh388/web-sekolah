<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keunggulan extends Model
{
    protected $fillable = ['title','description','icon','is_active', 'urutan'];
    protected $casts = [
        'urutan' => 'integer',
    ];
}
