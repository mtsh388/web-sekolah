<?php

namespace App\Http\Controllers;

use App\Models\PrestasiSiswa;

class PrestasiSiswaController extends Controller
{
    public function index()
    {
        $prestasiSiswas = PrestasiSiswa::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderByDesc('tanggal')
            ->get();

        return view(
            'prestasi-siswa.index',
            compact('prestasiSiswas')
        );
    }
}
