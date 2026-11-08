<?php

namespace App\Http\Controllers;

use App\Models\ProgramUnggulan;

class ProgramUnggulanController extends Controller
{
    public function index()
    {
        $programUnggulans = ProgramUnggulan::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('judul', 'asc')
            ->get();

        return view(
            'program-unggulan.index',
            compact('programUnggulans')
        );
    }
}
