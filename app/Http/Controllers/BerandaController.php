<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Keunggulan;
use App\Models\Kurikulum;
use App\Models\PrestasiSiswa;
use App\Models\ProgramUnggulan;
use App\Models\Sambutan;
use App\Models\Videotron;

class BerandaController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */
        $videotron = Videotron::first();

        /*
        |--------------------------------------------------------------------------
        | SAMBUTAN KEPALA SEKOLAH
        |--------------------------------------------------------------------------
        */
        $sambutan = Sambutan::first();

        /*
        |--------------------------------------------------------------------------
        | KEUNGGULAN
        |--------------------------------------------------------------------------
        */
        $keunggulans = Keunggulan::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SEKILAS AKADEMIK
        |--------------------------------------------------------------------------
        */

        // Kurikulum
        $kurikulums = Kurikulum::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->take(3)
            ->get();

        // Program Unggulan
        $programUnggulans = ProgramUnggulan::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->take(4)
            ->get();

        // Ekstrakurikuler
        $ekstrakurikulers = Ekstrakurikuler::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->take(4)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PRESTASI SISWA
        |--------------------------------------------------------------------------
        */
        $prestasiSiswas = PrestasiSiswa::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderByDesc('tanggal')
            ->take(3)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | FASILITAS
        |--------------------------------------------------------------------------
        */
        $fasilitas = Fasilitas::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc')
            ->take(4)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */
        $beritas = Berita::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */
        return view('beranda.index', compact(
            'videotron',
            'sambutan',
            'keunggulans',

            // Akademik
            'kurikulums',
            'programUnggulans',
            'ekstrakurikulers',

            // Lainnya
            'prestasiSiswas',
            'fasilitas',
            'beritas'
        ));
    }
}
