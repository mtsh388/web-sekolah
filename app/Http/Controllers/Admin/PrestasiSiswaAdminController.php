<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrestasiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PrestasiSiswaAdminController extends Controller
{
    /**
     * Halaman utama
     */
    public function index()
    {
        return view('admin.akademik.prestasi-siswa.index');
    }

    /**
     * Data untuk Tabulator
     */
    public function data()
    {
        $data = PrestasiSiswa::orderBy('urutan', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Form create
     */
    public function create()
    {
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Simpan data
     *
     * URUTAN OTOMATIS
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'nama_siswa'    => 'required|string|max:255',
            'kelas'         => 'nullable|string|max:100',
            'bidang'        => 'nullable|string|max:255',
            'tingkat'       => 'nullable|string|max:255',
            'peringkat'     => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'tanggal'       => 'nullable|date',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'     => 'nullable|boolean',
        ]);

        /*
         * =====================================================
         * URUTAN OTOMATIS
         * =====================================================
         *
         * Data terakhir + 1
         *
         * Contoh:
         * 1
         * 2
         * 3
         *
         * Tambah data baru => 4
         */
        $urutan = ((int) PrestasiSiswa::max('urutan')) + 1;

        $validated['urutan'] = $urutan;

        /*
         * Checkbox aktif
         */
        $validated['is_active'] =
            $request->boolean('is_active');

        /*
         * Upload foto
         */
        if ($request->hasFile('foto')) {

            $validated['foto'] =
                $this->uploadFoto(
                    $request->file('foto')
                );
        }

        /*
         * Simpan
         */
        $prestasi =
            PrestasiSiswa::create($validated);

        return response()->json([
            'status' => true,
            'msg'    => 'Data prestasi siswa berhasil ditambahkan.',
            'data'   => $prestasi
        ]);
    }

    /**
     * Ambil data untuk edit
     */
    public function edit(PrestasiSiswa $prestasiSiswa)
    {
        return response()->json([
            'status' => true,
            'data'   => $prestasiSiswa
        ]);
    }

    /**
     * Update data
     *
     * URUTAN TIDAK DIUBAH
     */
    public function update(
        Request $request,
        PrestasiSiswa $prestasiSiswa
    ) {
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'nama_siswa'    => 'required|string|max:255',
            'kelas'         => 'nullable|string|max:100',
            'bidang'        => 'nullable|string|max:255',
            'tingkat'       => 'nullable|string|max:255',
            'peringkat'     => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'tanggal'       => 'nullable|date',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'     => 'nullable|boolean',
        ]);

        /*
         * =====================================================
         * PERTAHANKAN URUTAN LAMA
         * =====================================================
         *
         * Urutan tidak berasal dari form edit.
         */
        $validated['urutan'] =
            $prestasiSiswa->urutan;

        /*
         * Checkbox aktif
         */
        $validated['is_active'] =
            $request->boolean('is_active');

        /*
         * =====================================================
         * FOTO
         * =====================================================
         *
         * Jika ada foto baru:
         * 1. Hapus foto lama
         * 2. Upload foto baru
         */
        if ($request->hasFile('foto')) {

            $this->deleteFoto(
                $prestasiSiswa->foto
            );

            $validated['foto'] =
                $this->uploadFoto(
                    $request->file('foto')
                );
        }

        /*
         * Update
         */
        $prestasiSiswa->update($validated);

        return response()->json([
            'status' => true,
            'msg'    => 'Data prestasi siswa berhasil diperbarui.',
            'data'   => $prestasiSiswa->fresh()
        ]);
    }

    /**
     * Hapus data
     */
    public function destroy(
        PrestasiSiswa $prestasiSiswa
    ) {
        /*
         * Hapus foto
         */
        $this->deleteFoto(
            $prestasiSiswa->foto
        );

        /*
         * Hapus data
         */
        $prestasiSiswa->delete();

        /*
         * Rapikan urutan
         */
        $this->reorder();

        return response()->json([
            'status' => true,
            'msg'    => 'Data prestasi siswa berhasil dihapus.'
        ]);
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(
        PrestasiSiswa $prestasiSiswa
    ) {
        $prestasiSiswa->update([
            'is_active' =>
                !$prestasiSiswa->is_active
        ]);

        return response()->json([
            'status' => true,
            'msg' => $prestasiSiswa->is_active
                ? 'Prestasi berhasil diaktifkan.'
                : 'Prestasi berhasil dinonaktifkan.',
            'data' => $prestasiSiswa
        ]);
    }

    /**
     * Update urutan melalui drag & drop
     */
    public function order(Request $request)
    {
        $validated = $request->validate([
            'items'          => 'required|array',
            'items.*.id'     => 'required|integer',
            'items.*.urutan' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {

            foreach ($validated['items'] as $item) {

                PrestasiSiswa::where(
                    'id',
                    $item['id']
                )->update([
                    'urutan' =>
                        $item['urutan']
                ]);
            }
        });

        return response()->json([
            'status' => true,
            'msg'    => 'Urutan prestasi berhasil diperbarui.'
        ]);
    }

    /**
     * Rapikan urutan
     *
     * Hasil:
     *
     * 1
     * 2
     * 3
     * 4
     * ...
     */
    private function reorder()
    {
        $items = PrestasiSiswa::orderBy(
            'urutan',
            'asc'
        )
            ->orderBy(
                'id',
                'asc'
            )
            ->get();

        foreach ($items as $index => $item) {

            $item->update([
                'urutan' => $index + 1
            ]);
        }
    }

    /**
     * Upload foto
     */
    private function uploadFoto($file)
    {
        $folder =
            public_path(
                'images/prestasi-siswa'
            );

        /*
         * Buat folder jika belum ada
         */
        if (!File::exists($folder)) {

            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }

        /*
         * Extension
         */
        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );

        /*
         * Nama file
         */
        $filename =
            Str::slug(
                pathinfo(
                    $file->getClientOriginalName(),
                    PATHINFO_FILENAME
                )
            );

        $filename .= '-'
            . time()
            . '-'
            . Str::random(6)
            . '.'
            . $extension;

        /*
         * Simpan file
         */
        $file->move(
            $folder,
            $filename
        );

        return $filename;
    }

    /**
     * Hapus foto
     */
    private function deleteFoto(
        ?string $filename
    ) {
        if (!$filename) {
            return;
        }

        $path =
            public_path(
                'images/prestasi-siswa/' . $filename
            );

        if (File::exists($path)) {

            File::delete($path);
        }
    }
}
