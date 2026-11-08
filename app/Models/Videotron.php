<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videotron extends Model
{
    protected $table = 'videotron';

    protected $fillable = [
        'title',
        'description',
        'link',
    ];
}
