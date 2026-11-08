<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KalenderPendidikanAdminController extends Controller
{
    /**
     * ============================================================
     * INDEX
     * ============================================================
     */
    public function index()
    {
        $tahunAjaran = KalenderPendidikan::query()
            ->select('tahun_ajaran')
            ->distinct()
            ->orderByDesc('tahun_ajaran')
            ->pluck('tahun_ajaran');

        return view('admin.akademik.kalender-pendidikan.index', compact(
            'tahunAjaran'
        ));
    }

    /**
     * ============================================================
     * DATA
     * ============================================================
     */
    public function data(Request $request)
    {
        $query = KalenderPendidikan::query()
            ->orderBy('urutan', 'asc')
            ->orderBy('tanggal_mulai', 'asc')
            ->orderBy('id', 'asc');

        /*
        |--------------------------------------------------------------------------
        | Filter Tahun Ajaran
        |--------------------------------------------------------------------------
        */
        if ($request->filled('tahun_ajaran')) {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        /*
        |--------------------------------------------------------------------------
        | Filter Kategori
        |--------------------------------------------------------------------------
        */
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        return response()->json([
            'data' => $query->get(),
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
            'tahun_ajaran' => [
                'required',
                'string',
                'max:20',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'kategori' => [
                'nullable',
                'string',
                'max:255',
            ],

            'warna' => [
                'nullable',
                'string',
                'max:20',
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

        /*
        |--------------------------------------------------------------------------
        | Default Urutan
        |--------------------------------------------------------------------------
        */
        if (
            !isset($validated['urutan']) ||
            $validated['urutan'] === null
        ) {
            $validated['urutan'] =
                ((int) KalenderPendidikan::max('urutan')) + 1;
        }

        $validated['is_active'] =
            $request->boolean('is_active');

        $kalender = KalenderPendidikan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kalender pendidikan berhasil ditambahkan.',
            'data' => $kalender,
        ]);
    }

    /**
     * ============================================================
     * UPDATE
     * ============================================================
     */
    public function update(
        Request $request,
        KalenderPendidikan $kalenderPendidikan
    ) {
        $validated = $request->validate([
            'tahun_ajaran' => [
                'required',
                'string',
                'max:20',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'kategori' => [
                'nullable',
                'string',
                'max:255',
            ],

            'warna' => [
                'nullable',
                'string',
                'max:20',
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

        $validated['is_active'] =
            $request->boolean('is_active');

        $kalenderPendidikan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kalender pendidikan berhasil diperbarui.',
            'data' => $kalenderPendidikan->fresh(),
        ]);
    }

    /**
     * ============================================================
     * DESTROY
     * ============================================================
     */
    public function destroy(
        KalenderPendidikan $kalenderPendidikan
    ) {
        $kalenderPendidikan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kalender pendidikan berhasil dihapus.',
        ]);
    }

    /**
     * ============================================================
     * TOGGLE STATUS
     * ============================================================
     */
    public function toggleStatus(
        KalenderPendidikan $kalenderPendidikan
    ) {
        $kalenderPendidikan->update([
            'is_active' => !$kalenderPendidikan->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => $kalenderPendidikan->is_active
                ? 'Kalender pendidikan berhasil diaktifkan.'
                : 'Kalender pendidikan berhasil dinonaktifkan.',
            'is_active' => $kalenderPendidikan->is_active,
        ]);
    }

    /**
     * ============================================================
     * UPDATE ORDER
     * ============================================================
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
                'exists:kalender_pendidikans,id',
            ],

            'orders.*.urutan' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            foreach ($validated['orders'] as $order) {
                KalenderPendidikan::where(
                    'id',
                    $order['id']
                )->update([
                    'urutan' => $order['urutan'],
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Urutan kalender pendidikan berhasil disimpan.',
        ]);
    }
}

