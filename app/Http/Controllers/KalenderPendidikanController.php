<?php

namespace App\Http\Controllers;

use App\Models\KalenderPendidikan;

class KalenderPendidikanController extends Controller
{
    public function index()
    {
        $kalenderPendidikans = KalenderPendidikan::where('is_active', true)
            ->orderBy('tanggal_mulai', 'asc')
            ->orderBy('urutan', 'asc')
            ->get();

        $tahunAjarans = KalenderPendidikan::where('is_active', true)
            ->whereNotNull('tahun_ajaran')
            ->select('tahun_ajaran')
            ->distinct()
            ->orderByDesc('tahun_ajaran')
            ->pluck('tahun_ajaran');

        return view(
            'kalender-pendidikan.index',
            compact(
                'kalenderPendidikans',
                'tahunAjarans'
            )
        );
    }
}
