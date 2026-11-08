<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenagaPendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TenagaPendidikAdminController extends Controller
{
    /**
     * ============================================================
     * INDEX
     * ============================================================
     */
    public function index()
    {
        return view('admin.profile.tenaga-pendidik.index');
    }


    /**
     * ============================================================
     * DATA TABULATOR
     * ============================================================
     */
    public function data()
    {
        $data = TenagaPendidik::query()
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'data' => $data->values(),
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
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'jabatan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mata_pelajaran' => [
                'nullable',
                'string',
                'max:255',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'deskripsi' => [
                'nullable',
                'string',
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
         * ============================================================
         * TENTUKAN URUTAN OTOMATIS
         * ============================================================
         */
        if (
            !isset($validated['urutan']) ||
            $validated['urutan'] == 0
        ) {
            $validated['urutan'] =
                ((int) TenagaPendidik::max('urutan')) + 1;
        }

        /**
         * ============================================================
         * STATUS AKTIF
         * ============================================================
         */
        $validated['is_active'] =
            $request->boolean('is_active');

        /**
         * ============================================================
         * UPLOAD FOTO
         * public/images/tenaga-pendidik/
         * ============================================================
         */
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            // Buat nama file unik
            $filename =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();

            // Pastikan folder tersedia
            $directory =
                public_path('images/tenaga-pendidik');

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Pindahkan file
            $file->move(
                $directory,
                $filename
            );

            // Simpan nama file saja ke database
            $validated['foto'] = $filename;
        }

        /**
         * ============================================================
         * SIMPAN DATA
         * ============================================================
         */
        TenagaPendidik::create($validated);

        return redirect()
            ->route('admin.profile.tenaga-pendidik.index')
            ->with(
                'success',
                'Tenaga pendidik berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * UPDATE
     * ============================================================
     */
    public function update(
        Request $request,
        TenagaPendidik $tenagaPendidik
    ) {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'jabatan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mata_pelajaran' => [
                'nullable',
                'string',
                'max:255',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'deskripsi' => [
                'nullable',
                'string',
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
         * ============================================================
         * STATUS AKTIF
         * ============================================================
         */
        $validated['is_active'] =
            $request->boolean('is_active');

        /**
         * ============================================================
         * UPLOAD FOTO BARU
         * ============================================================
         */
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $directory =
                public_path('images/tenaga-pendidik');

            /**
             * Pastikan folder tersedia
             */
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            /**
             * Hapus foto lama
             */
            if (
                $tenagaPendidik->foto
            ) {
                $oldFile =
                    $directory . DIRECTORY_SEPARATOR .
                    $tenagaPendidik->foto;

                if (is_file($oldFile)) {
                    unlink($oldFile);
                }
            }

            /**
             * Buat nama file baru
             */
            $filename =
                time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();

            /**
             * Pindahkan foto baru
             */
            $file->move(
                $directory,
                $filename
            );

            /**
             * Simpan nama file saja ke database
             */
            $validated['foto'] = $filename;
        }

        /**
         * ============================================================
         * UPDATE DATA
         * ============================================================
         */
        $tenagaPendidik->update($validated);

        return redirect()
            ->route('admin.profile.tenaga-pendidik.index')
            ->with(
                'success',
                'Tenaga pendidik berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * DELETE
     * ============================================================
     */
    public function destroy(
        TenagaPendidik $tenagaPendidik
    ) {
        if (
            $tenagaPendidik->foto &&
            Storage::disk('public')
                ->exists($tenagaPendidik->foto)
        ) {
            Storage::disk('public')
                ->delete($tenagaPendidik->foto);
        }


        $tenagaPendidik->delete();


        /**
         * Rapikan kembali nomor urutan.
         */
        $this->reorderAll();


        return redirect()
            ->route('admin.profile.tenaga-pendidik.index')
            ->with(
                'success',
                'Tenaga pendidik berhasil dihapus.'
            );
    }


    /**
     * ============================================================
     * UPDATE URUTAN
     * ============================================================
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => [
                'required',
                'array',
            ],

            'orders.*.id' => [
                'required',
                'integer',
                'exists:tenaga_pendidiks,id',
            ],

            'orders.*.urutan' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        DB::transaction(function () use ($request) {

            foreach ($request->orders as $item) {

                TenagaPendidik::where(
                    'id',
                    $item['id']
                )->update([
                    'urutan' => $item['urutan'],
                ]);
            }
        });


        return response()->json([
            'success' => true,
            'message' =>
                'Urutan tenaga pendidik berhasil diperbarui.',
        ]);
    }


    /**
     * ============================================================
     * TOGGLE STATUS
     * ============================================================
     */
    public function toggleStatus(
        TenagaPendidik $tenagaPendidik
    ) {
        $tenagaPendidik->update([
            'is_active' =>
                !$tenagaPendidik->is_active,
        ]);


        return response()->json([
            'success' => true,
            'is_active' =>
                $tenagaPendidik->is_active,
        ]);
    }


    /**
     * ============================================================
     * REORDER ALL
     * ============================================================
     */
    private function reorderAll(): void
    {
        $items = TenagaPendidik::orderBy('urutan')
            ->orderBy('id')
            ->get();


        foreach ($items as $index => $item) {

            $item->update([
                'urutan' => $index + 1,
            ]);
        }
    }
}
