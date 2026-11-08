<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSekolah extends Model
{
    protected $table = 'master_sekolah';
    protected $fillable = ['nama','alamat','no_telp','email','instagram','youtube','tiktok','facebook','whatsapp','logo','link_gmap','warna_utama','warna_kedua'];
}
