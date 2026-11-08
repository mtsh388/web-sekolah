<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RunningText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RunningTextAdminController extends Controller
{
    /**
     * Menampilkan halaman daftar running text.
     */
    public function index()
    {
        return view('admin.beranda.running-text.index');
    }

    /**
     * Mengambil data running text untuk Tabulator.
     */
    public function data()
    {
        $runningTexts = RunningText::query()
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'data' => $runningTexts,
        ]);
    }

    /**
     * Form tambah running text.
     *
     * Tidak digunakan oleh Blade karena tambah
     * menggunakan modal, tetapi route tetap dapat dipertahankan.
     */
    public function create()
    {
        return view('admin.beranda.running-text.create');
    }

    /**
     * Simpan running text baru.
     */
    /**
     * Simpan running text baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teks' => [
                'required',
                'string',
                'max:1000',
            ],

            'link' => [
                'nullable',
                'string',
                'url',
                'max:500',
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

            'warna_background' => [
                'nullable',
                'string',
                'max:20',
            ],

            'warna_text' => [
                'nullable',
                'string',
                'max:20',
            ],

            'kecepatan' => [
                'required',
                'integer',
                'min:5',
                'max:120',
            ],
        ]);

        /*
         * Jika urutan kosong atau 0,
         * otomatis menggunakan urutan terakhir + 1.
         */
        if (
            empty($validated['urutan']) ||
            (int) $validated['urutan'] === 0
        ) {
            $validated['urutan'] =
                ((int) RunningText::max('urutan')) + 1;
        }

        /*
         * Checkbox is_active.
         */
        $validated['is_active'] =
            $request->boolean('is_active');

        /*
         * Default warna background.
         */
        $validated['warna_background'] =
            $validated['warna_background']
            ?? '#0083b4';

        /*
         * Default warna text.
         */
        $validated['warna_text'] =
            $validated['warna_text']
            ?? '#ffffff';

        /*
         * Jika link kosong, simpan sebagai null.
         */
        $validated['link'] =
            $validated['link']
            ?? null;

        /*
         * Simpan data.
         */
        $runningText =
            RunningText::create($validated);

        return response()->json([
            'success' => true,
            'message' =>
                'Running text berhasil ditambahkan.',
            'data' => $runningText,
        ], 201);
    }

    /**
     * Mengambil data running text untuk modal edit.
     *
     * Blade menggunakan fetch() dan mengharapkan JSON.
     */
    public function edit(RunningText $runningText)
    {
        return response()->json([
            'success' => true,
            'data' => $runningText,
        ]);
    }

    /**
     * Update running text.
     */
    public function update(
        Request $request,
        RunningText $runningText
    ) {
        $validated = $request->validate([
            'teks' => [
                'required',
                'string',
                'max:1000',
            ],

            'link' => [
                'nullable',
                'string',
                'url',
                'max:500',
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

            'warna_background' => [
                'nullable',
                'string',
                'max:20',
            ],

            'warna_text' => [
                'nullable',
                'string',
                'max:20',
            ],

            'kecepatan' => [
                'required',
                'integer',
                'min:5',
                'max:120',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $validated['warna_background'] =
            $validated['warna_background'] ?? '#0083b4';

        $validated['warna_text'] =
            $validated['warna_text'] ?? '#ffffff';

        $validated['link'] =
            $validated['link'] ?? null;

        $runningText->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Running text berhasil diperbarui.',
            'data' => $runningText->fresh(),
        ]);
    }

    /**
     * Menyimpan perubahan urutan running text.
     *
     * Blade mengirim:
     *
     * {
     *     items: [
     *         {
     *             id: 1,
     *             urutan: 1
     *         }
     *     ]
     * }
     */
    public function order(Request $request)
    {
        $validated = $request->validate([
            'items' => [
                'required',
                'array',
            ],

            'items.*.id' => [
                'required',
                'integer',
                'exists:running_texts,id',
            ],

            'items.*.urutan' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            foreach ($validated['items'] as $item) {

                RunningText::where(
                    'id',
                    $item['id']
                )->update([
                    'urutan' => $item['urutan'],
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Urutan running text berhasil diperbarui.',
        ]);
    }

    /**
     * Menghapus running text.
     */
    public function destroy(RunningText $runningText)
    {
        $runningText->delete();

        return response()->json([
            'success' => true,
            'message' => 'Running text berhasil dihapus.',
        ]);
    }

    /**
     * Toggle status aktif/nonaktif.
     */
    public function toggleStatus(RunningText $runningText)
    {
        $runningText->update([
            'is_active' => !$runningText->is_active,
        ]);

        return response()->json([
            'success' => true,

            'is_active' =>
                $runningText->is_active,

            'message' =>
                $runningText->is_active
                    ? 'Running text berhasil diaktifkan.'
                    : 'Running text berhasil dinonaktifkan.',
        ]);
    }
}
