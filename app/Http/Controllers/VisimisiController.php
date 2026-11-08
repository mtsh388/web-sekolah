<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Visi;
use Illuminate\Http\Request;

class VisimisiController extends Controller
{
    public function index()
    {
        // ============================================================
        // VISI SEKOLAH
        // ============================================================

        $visi = Visi::where('is_active', true)
            ->first();

        // ============================================================
        // MISI SEKOLAH
        // ============================================================

        $misinya = Misi::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();

        // ============================================================
        // VIEW
        // ============================================================

        return view('visi-misi.index', compact(
            'visi',
            'misinya'
        ));
    }
}
