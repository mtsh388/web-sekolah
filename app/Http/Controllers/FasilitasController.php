<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    /**
     * Menampilkan daftar fasilitas sekolah.
     */
    public function index()
    {
        $fasilitas = Fasilitas::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'fasilitas.index',
            compact('fasilitas')
        );
    }
}
