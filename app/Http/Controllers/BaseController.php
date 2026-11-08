<?php

namespace App\Http\Controllers;

use App\Models\MasterSekolah;
use App\Models\User;
use Illuminate\Routing\Controller as LaravelController;

abstract class BaseController extends LaravelController
{
    protected ?User $user = null;
    protected ?MasterSekolah $master_sekolah = null;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->master_sekolah = MasterSekolah::first();
    }
}
