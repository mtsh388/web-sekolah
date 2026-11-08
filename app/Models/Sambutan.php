<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    protected $table = 'sambutan';
    protected $fillable = ['title', 'description','nama','image'];
}
