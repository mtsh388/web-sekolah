<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'ekstrakurikuler.index',
            compact('ekstrakurikulers')
        );
    }
}
