<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    public function index()
    {
        $kurikulums = Kurikulum::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('judul', 'asc')
            ->get();

        return view('kurikulum.index', compact('kurikulums'));
    }
}
