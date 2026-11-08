<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProgramUnggulanAdminController extends Controller
{
    /**
     * Folder penyimpanan foto.
     *
     * Hasil:
     * public/images/program-unggulan/
     */
    private string $uploadPath = 'images/program-unggulan';


    /**
     * ============================================================
     * INDEX
     * ============================================================
     *
     * Menampilkan halaman Program Unggulan.
     */
    public function index()
    {
        $programUnggulans = ProgramUnggulan::query()
            ->orderBy('urutan')
            ->get();
        return view(
            'admin.akademik.program-unggulan.index',
            compact('programUnggulans')
        );
    }


    /**
     * ============================================================
     * DATA
     * ============================================================
     *
     * Data untuk Tabulator.
     */
    public function data(Request $request)
    {
        $programUnggulans = ProgramUnggulan::query()
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => $programUnggulans,
        ]);
    }


    /**
     * ============================================================
     * CREATE
     * ============================================================
     *
     * Form tambah jika sewaktu-waktu menggunakan halaman create.
     */
    public function create()
    {
        $nextUrutan = (ProgramUnggulan::max('urutan') ?? 0) + 1;

        return view(
            'admin.akademik.program-unggulan.create',
            compact('nextUrutan')
        );
    }


    /**
     * ============================================================
     * STORE
     * ============================================================
     *
     * Simpan program unggulan baru.
     *
     * Urutan dibuat otomatis.
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

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'judul.required' =>
                'Judul program unggulan wajib diisi.',

            'judul.max' =>
                'Judul maksimal 255 karakter.',

            'foto.image' =>
                'File harus berupa gambar.',

            'foto.mimes' =>
                'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',
        ]);


        /**
         * ========================================================
         * URUTAN OTOMATIS
         * ========================================================
         *
         * Contoh:
         *
         * Data terakhir = 5
         * Data baru     = 6
         */
        $urutan = (ProgramUnggulan::max('urutan') ?? 0) + 1;


        /**
         * Data yang akan disimpan.
         */
        $data = [
            'judul' =>
                $validated['judul'],

            'deskripsi' =>
                $validated['deskripsi'] ?? null,

            'urutan' =>
                $urutan,

            'is_active' =>
                $request->boolean('is_active'),
        ];


        /**
         * ========================================================
         * UPLOAD FOTO
         * ========================================================
         */
        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');

            $namaFile = Str::slug($validated['judul'])
                . '-' . time()
                . '.' . $foto->getClientOriginalExtension();


            /**
             * Pastikan folder tersedia.
             */
            $folder = public_path($this->uploadPath);

            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }


            /**
             * Pindahkan file.
             */
            $foto->move(
                $folder,
                $namaFile
            );


            $data['foto'] = $namaFile;
        }


        /**
         * Simpan database.
         */
        $programUnggulan =
            ProgramUnggulan::create($data);


        /**
         * Karena Blade menggunakan fetch(),
         * response harus JSON.
         */
        return response()->json([
            'success' => true,

            'message' =>
                'Program unggulan berhasil ditambahkan.',

            'data' =>
                $programUnggulan,
        ]);
    }


    /**
     * ============================================================
     * EDIT
     * ============================================================
     *
     * Form edit jika sewaktu-waktu menggunakan halaman edit.
     */
    public function edit(
        ProgramUnggulan $programUnggulan
    ) {
        return view(
            'admin.akademik.program-unggulan.edit',
            compact('programUnggulan')
        );
    }


    /**
     * ============================================================
     * UPDATE
     * ============================================================
     *
     * Update program unggulan.
     *
     * Urutan TIDAK diubah.
     */
    public function update(
        Request $request,
        ProgramUnggulan $programUnggulan
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

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'judul.required' =>
                'Judul program unggulan wajib diisi.',

            'judul.max' =>
                'Judul maksimal 255 karakter.',

            'foto.image' =>
                'File harus berupa gambar.',

            'foto.mimes' =>
                'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',
        ]);


        /**
         * Data update.
         *
         * Urutan sengaja tidak dimasukkan.
         * Nilai urutan lama tetap dipertahankan.
         */
        $data = [
            'judul' =>
                $validated['judul'],

            'deskripsi' =>
                $validated['deskripsi'] ?? null,

            'is_active' =>
                $request->boolean('is_active'),
        ];


        /**
         * ========================================================
         * UPLOAD FOTO BARU
         * ========================================================
         */
        if ($request->hasFile('foto')) {

            /**
             * Hapus foto lama.
             */
            $this->deleteFoto(
                $programUnggulan->foto
            );


            $foto = $request->file('foto');


            $namaFile = Str::slug($validated['judul'])
                . '-' . time()
                . '.' . $foto->getClientOriginalExtension();


            /**
             * Pastikan folder tersedia.
             */
            $folder = public_path($this->uploadPath);

            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }


            /**
             * Simpan foto baru.
             */
            $foto->move(
                $folder,
                $namaFile
            );


            $data['foto'] = $namaFile;
        }


        /**
         * Update database.
         */
        $programUnggulan->update($data);


        /**
         * Response JSON untuk fetch().
         */
        return response()->json([
            'success' => true,

            'message' =>
                'Program unggulan berhasil diperbarui.',

            'data' =>
                $programUnggulan->fresh(),
        ]);
    }


    /**
     * ============================================================
     * DESTROY
     * ============================================================
     *
     * Hapus program unggulan.
     */
    public function destroy(
        ProgramUnggulan $programUnggulan
    ) {
        /**
         * Hapus file foto.
         */
        $this->deleteFoto(
            $programUnggulan->foto
        );


        /**
         * Hapus database.
         */
        $programUnggulan->delete();


        /**
         * Response JSON untuk fetch().
         */
        return response()->json([
            'success' => true,

            'message' =>
                'Program unggulan berhasil dihapus.',
        ]);
    }


    /**
     * ============================================================
     * ORDER
     * ============================================================
     *
     * Menyimpan urutan setelah drag & drop Tabulator.
     */
    public function order(Request $request)
    {
        $validated = $request->validate([
            'orders' => [
                'required',
                'array',
            ],

            'orders.*.id' => [
                'required',
                'integer',
                'exists:program_unggulans,id',
            ],

            'orders.*.urutan' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        /**
         * Update urutan berdasarkan hasil drag & drop.
         */
        foreach ($validated['orders'] as $order) {

            ProgramUnggulan::where(
                'id',
                $order['id']
            )->update([
                'urutan' =>
                    $order['urutan'],
            ]);
        }


        return response()->json([
            'success' => true,

            'message' =>
                'Urutan program unggulan berhasil disimpan.',
        ]);
    }


    /**
     * ============================================================
     * TOGGLE STATUS
     * ============================================================
     *
     * Mengubah status aktif/nonaktif.
     */
    public function toggleStatus(
        ProgramUnggulan $programUnggulan
    ) {
        $programUnggulan->update([
            'is_active' =>
                !$programUnggulan->is_active,
        ]);


        return response()->json([
            'success' => true,

            'message' =>
                'Status program unggulan berhasil diperbarui.',

            'data' => [
                'id' =>
                    $programUnggulan->id,

                'is_active' =>
                    $programUnggulan->is_active,
            ],
        ]);
    }


    /**
     * ============================================================
     * DELETE FOTO
     * ============================================================
     *
     * Menghapus file foto dari public.
     */
    private function deleteFoto(
        ?string $filename
    ): void {
        if (!$filename) {
            return;
        }


        $path = public_path(
            $this->uploadPath . '/' . $filename
        );


        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
