<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\MasterSekolah;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    // Menampilkan halaman dashboard utama admin
    public function index()
    {
        $sekolah = MasterSekolah::first();
        return view('admin.dashboard.index', compact('sekolah'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'instagram' => 'nullable|string|max:100',
            'youtube' => 'nullable|string|max:100',
            'tiktok' => 'nullable|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'link_gmap' => 'nullable|string',
            'warna_utama' => 'required|string|max:7',
            'warna_kedua' => 'required|string|max:7',
        ]);

        $sekolah = MasterSekolah::first();

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'tiktok' => $request->tiktok,
            'whatsapp' => $request->whatsapp,
            'link_gmap' => $request->link_gmap,
            'warna_utama' => $request->warna_utama,
            'warna_kedua' => $request->warna_kedua,
        ];

        // Pakai cara save() atau update() pada object, bukan method static update()
        if ($sekolah) {
            $sekolah->update($data);
        } else {
            MasterSekolah::create($data);
        }

        return redirect()->back()->with('success', 'Data profil sekolah berhasil diperbarui!');
    }
}
