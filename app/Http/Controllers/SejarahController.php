<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\SejarahSekolah;
use App\Models\Visi;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = SejarahSekolah::where('is_active', true)
        ->first();
        // ============================================================
        // VIEW
        // ============================================================

        return view('sejarah.index', compact(
            'sejarah',
        ));
    }
}
