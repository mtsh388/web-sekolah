<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KurikulumAdminController extends Controller
{
    /**
     * ============================================================
     * INDEX
     * ============================================================
     */
    public function index()
    {
        return view('admin.akademik.kurikulum.index');
    }


    /**
     * ============================================================
     * DATA
     * ============================================================
     *
     * Digunakan oleh Tabulator / AJAX.
     */
    public function data(Request $request)
    {
        $kurikulums = Kurikulum::query()
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => $kurikulums,
        ]);
    }


    /**
     * ============================================================
     * STORE
     * ============================================================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /**
         * ========================================================
         * TENTUKAN URUTAN OTOMATIS
         * ========================================================
         */
        if (
            !isset($validated['urutan']) ||
            $validated['urutan'] == 0
        ) {
            $validated['urutan'] =
                ((int) Kurikulum::max('urutan')) + 1;
        }


        /**
         * ========================================================
         * STATUS AKTIF
         * ========================================================
         */
        $validated['is_active'] =
            $request->boolean('is_active');


        /**
         * ========================================================
         * UPLOAD FOTO
         * ========================================================
         *
         * Disimpan ke:
         *
         * public/images/kurikulum/
         *
         * Database:
         *
         * foto = nama_file.jpg
         */
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $directory =
                public_path('images/kurikulum');

            /**
             * Pastikan folder tersedia.
             */
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            /**
             * Generate nama file unik.
             */
            $filename =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();

            /**
             * Pindahkan file ke public.
             */
            $file->move(
                $directory,
                $filename
            );

            /**
             * Simpan nama file ke database.
             */
            $validated['foto'] = $filename;
        }


        /**
         * ========================================================
         * SIMPAN DATA
         * ========================================================
         */
        $kurikulum = Kurikulum::create($validated);


        return redirect()
            ->route('admin.akademik.kurikulum.index')
            ->with(
                'success',
                'Kurikulum berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * UPDATE
     * ============================================================
     */
    public function update(
        Request $request,
        Kurikulum $kurikulum
    ) {
        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'urutan' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /**
         * ========================================================
         * STATUS AKTIF
         * ========================================================
         */
        $validated['is_active'] =
            $request->boolean('is_active');


        /**
         * ========================================================
         * UPLOAD FOTO BARU
         * ========================================================
         */
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $directory =
                public_path('images/kurikulum');


            /**
             * Pastikan folder tersedia.
             */
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }


            /**
             * Hapus foto lama.
             */
            if ($kurikulum->foto) {

                $oldFile =
                    $directory .
                    DIRECTORY_SEPARATOR .
                    $kurikulum->foto;

                if (is_file($oldFile)) {
                    unlink($oldFile);
                }
            }


            /**
             * Generate nama file baru.
             */
            $filename =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();


            /**
             * Pindahkan foto baru.
             */
            $file->move(
                $directory,
                $filename
            );


            /**
             * Simpan nama file ke database.
             */
            $validated['foto'] = $filename;
        }


        /**
         * ========================================================
         * UPDATE DATA
         * ========================================================
         */
        $kurikulum->update($validated);


        return redirect()
            ->route('admin.akademik.kurikulum.index')
            ->with(
                'success',
                'Kurikulum berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * DESTROY
     * ============================================================
     */
    public function destroy(Kurikulum $kurikulum)
    {
        /**
         * ========================================================
         * HAPUS FOTO
         * ========================================================
         */
        if ($kurikulum->foto) {

            $file =
                public_path(
                    'images/kurikulum/' .
                    $kurikulum->foto
                );

            if (is_file($file)) {
                unlink($file);
            }
        }


        /**
         * ========================================================
         * HAPUS DATA
         * ========================================================
         */
        $kurikulum->delete();


        return response()->json([
            'success' => true,
            'message' => 'Kurikulum berhasil dihapus.',
        ]);
    }


    /**
     * ============================================================
     * UPDATE ORDER
     * ============================================================
     *
     * Digunakan untuk drag & drop Tabulator.
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'orders' => [
                'required',
                'array',
            ],

            'orders.*.id' => [
                'required',
                'integer',
                'exists:kurikulums,id',
            ],

            'orders.*.urutan' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        DB::transaction(function () use ($validated) {

            foreach ($validated['orders'] as $order) {

                Kurikulum::where(
                    'id',
                    $order['id']
                )->update([
                    'urutan' => $order['urutan'],
                ]);
            }
        });


        return response()->json([
            'success' => true,
            'message' => 'Urutan kurikulum berhasil diperbarui.',
        ]);
    }


    /**
     * ============================================================
     * TOGGLE STATUS
     * ============================================================
     */
    public function toggleStatus(
        Kurikulum $kurikulum
    ) {
        $kurikulum->update([
            'is_active' => !$kurikulum->is_active,
        ]);


        return response()->json([
            'success' => true,
            'message' =>
                $kurikulum->is_active
                    ? 'Kurikulum berhasil diaktifkan.'
                    : 'Kurikulum berhasil dinonaktifkan.',
            'is_active' => $kurikulum->is_active,
        ]);
    }
}
