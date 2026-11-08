<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Misi;
use App\Models\Visi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiMisiAdminController extends Controller
{
    /**
     * ============================================================
     * INDEX
     * ============================================================
     * Menampilkan Visi dan seluruh Misi dalam satu halaman.
     */
    public function index()
    {
        $visi = Visi::latest()->first();

        $misis = Misi::orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view(
            'admin.profile.visi-misi.index',
            compact('visi', 'misis')
        );
    }


    /**
     * ============================================================
     * STORE VISI
     * ============================================================
     */
    public function storeVisi(Request $request)
    {
        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'judul.required' => 'Judul visi wajib diisi.',
            'deskripsi.required' => 'Deskripsi visi wajib diisi.',
        ]);


        $validated['is_active'] =
            $request->boolean('is_active');


        /*
         * Karena Visi hanya boleh satu data,
         * jika sudah ada maka jangan membuat record baru.
         */
        $visi = Visi::first();


        if ($visi) {

            $visi->update($validated);

            $message = 'Visi sekolah berhasil diperbarui.';

        } else {

            Visi::create($validated);

            $message = 'Visi sekolah berhasil ditambahkan.';

        }


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with('success', $message);
    }


    /**
     * ============================================================
     * UPDATE VISI
     * ============================================================
     */
    public function updateVisi(Request $request, Visi $visi)
    {
        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'judul.required' => 'Judul visi wajib diisi.',
            'deskripsi.required' => 'Deskripsi visi wajib diisi.',
        ]);


        $validated['is_active'] =
            $request->boolean('is_active');


        $visi->update($validated);


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with('success', 'Visi sekolah berhasil diperbarui.');
    }


    /**
     * ============================================================
     * DESTROY VISI
     * ============================================================
     */
    public function destroyVisi(Visi $visi)
    {
        $visi->delete();


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with('success', 'Visi sekolah berhasil dihapus.');
    }


    /**
     * ============================================================
     * STORE MISI
     * ============================================================
     */
    public function storeMisi(Request $request)
    {
        $validated = $request->validate([
            'deskripsi' => [
                'required',
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
        ], [
            'deskripsi.required' => 'Deskripsi misi wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal adalah 0.',
        ]);


        $validated['urutan'] =
            $request->input('urutan', 0);


        $validated['is_active'] =
            $request->boolean('is_active');


        Misi::create($validated);


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with('success', 'Misi sekolah berhasil ditambahkan.');
    }


    /**
     * ============================================================
     * UPDATE MISI
     * ============================================================
     */
    public function updateMisi(Request $request, Misi $misi)
    {
        $validated = $request->validate([
            'deskripsi' => [
                'required',
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
        ], [
            'deskripsi.required' => 'Deskripsi misi wajib diisi.',
            'urutan.required' => 'Urutan misi wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal adalah 0.',
        ]);


        $validated['is_active'] =
            $request->boolean('is_active');


        $misi->update($validated);


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with('success', 'Misi sekolah berhasil diperbarui.');
    }


    /**
     * ============================================================
     * DESTROY MISI
     * ============================================================
     */
    public function destroyMisi(Misi $misi)
    {
        $misi->delete();


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with('success', 'Misi sekolah berhasil dihapus.');
    }


    /**
     * ============================================================
     * UPDATE STATUS MISI
     * ============================================================
     * Opsional jika nantinya ingin mengaktifkan/nonaktifkan
     * misi melalui tombol tanpa membuka form edit.
     */
    public function toggleMisi(Misi $misi)
    {
        $misi->update([
            'is_active' => !$misi->is_active,
        ]);


        return redirect()
            ->route('admin.profile.visi-misi.index')
            ->with(
                'success',
                'Status misi berhasil diperbarui.'
            );
    }

    public function updateMisiOrder(Request $request)
    {
        $orders = $request->input('orders', []);

        if (!is_array($orders) || empty($orders)) {
            return response()->json([
                'success' => false,
                'message' => 'Data urutan tidak valid.'
            ], 422);
        }

        DB::transaction(function () use ($orders) {

            foreach ($orders as $item) {

                if (
                    !isset($item['id']) ||
                    !isset($item['urutan'])
                ) {
                    continue;
                }

                Misi::where('id', $item['id'])
                    ->update([
                        'urutan' => (int) $item['urutan']
                    ]);
            }

        });

        return response()->json([
            'success' => true,
            'message' => 'Urutan misi berhasil diperbarui.'
        ]);
    }
}
