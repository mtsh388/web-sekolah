<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FasilitasAdminController extends Controller
{
    /**
     * Halaman utama
     */
    public function index()
    {
        return view('admin.akademik.fasilitas.index');
    }

    /**
     * Data untuk Tabulator
     */
    public function data()
    {
        $data = Fasilitas::orderBy('urutan', 'asc')
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
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lokasi'      => 'nullable|string|max:255',
            'jumlah'      => 'nullable|string|max:100',
            'is_active'   => 'nullable|boolean',
        ]);

        /*
         * Urutan otomatis:
         * data terakhir + 1
         */
        $urutan = ((int) Fasilitas::max('urutan')) + 1;

        $validated['urutan'] = $urutan;

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

        $fasilitas =
            Fasilitas::create($validated);

        return response()->json([
            'status' => true,
            'msg'    => 'Fasilitas berhasil ditambahkan.',
            'data'   => $fasilitas
        ]);
    }

    /**
     * Ambil data untuk edit
     */
    public function edit(Fasilitas $fasilitas)
    {
        return response()->json([
            'status' => true,
            'data'   => $fasilitas
        ]);
    }

    /**
     * Update data
     *
     * URUTAN TIDAK DIUBAH
     */
    public function update(
        Request $request,
        Fasilitas $fasilitas
    ) {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lokasi'      => 'nullable|string|max:255',
            'jumlah'      => 'nullable|string|max:100',
            'is_active'   => 'nullable|boolean',
        ]);

        /*
         * Jangan menerima / mengubah urutan dari form edit.
         *
         * Urutan tetap menggunakan nilai lama.
         */
        $validated['urutan'] =
            $fasilitas->urutan;

        $validated['is_active'] =
            $request->boolean('is_active');

        /*
         * Jika upload foto baru,
         * hapus foto lama.
         */
        if ($request->hasFile('foto')) {

            $this->deleteFoto(
                $fasilitas->foto
            );

            $validated['foto'] =
                $this->uploadFoto(
                    $request->file('foto')
                );
        }

        $fasilitas->update($validated);

        return response()->json([
            'status' => true,
            'msg'    => 'Fasilitas berhasil diperbarui.',
            'data'   => $fasilitas->fresh()
        ]);
    }

    /**
     * Hapus data
     */
    public function destroy(Fasilitas $fasilitas)
    {
        $this->deleteFoto(
            $fasilitas->foto
        );

        $fasilitas->delete();

        /*
         * Rapikan kembali urutan
         *
         * Contoh:
         * 1,2,3,4
         * hapus nomor 2
         *
         * menjadi:
         * 1,2,3
         */
        $this->reorder();

        return response()->json([
            'status' => true,
            'msg'    => 'Fasilitas berhasil dihapus.'
        ]);
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(
        Fasilitas $fasilitas
    ) {
        $fasilitas->update([
            'is_active' =>
                !$fasilitas->is_active
        ]);

        return response()->json([
            'status' => true,
            'msg' => $fasilitas->is_active
                ? 'Fasilitas berhasil diaktifkan.'
                : 'Fasilitas berhasil dinonaktifkan.',
            'data' => $fasilitas
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

                Fasilitas::where(
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
            'msg'    => 'Urutan fasilitas berhasil diperbarui.'
        ]);
    }

    /**
     * Rapikan urutan menjadi:
     *
     * 1, 2, 3, 4, 5, ...
     */
    private function reorder()
    {
        $items = Fasilitas::orderBy(
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
            public_path('images/fasilitas');

        if (!File::exists($folder)) {

            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }

        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );

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
                'images/fasilitas/' . $filename
            );

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
