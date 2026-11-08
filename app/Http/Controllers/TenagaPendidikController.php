<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidik;
use Illuminate\Http\Request;

class TenagaPendidikController extends Controller
{
    public function index()
    {
        $tenagaPendidiks = TenagaPendidik::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view('tenaga-pendidik.index', compact('tenagaPendidiks'));
    }
}
