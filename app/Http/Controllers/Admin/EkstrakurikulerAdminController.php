<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EkstrakurikulerAdminController extends Controller
{
    /**
     * Folder upload foto.
     */
    private string $uploadPath = 'images/ekstrakurikuler';


    /**
     * Halaman index.
     */
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::query()
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view(
            'admin.akademik.ekstrakurikuler.index',
            compact('ekstrakurikulers')
        );
    }


    /**
     * Data untuk Tabulator.
     */
    public function data(Request $request)
    {
        $ekstrakurikulers = Ekstrakurikuler::query()
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => $ekstrakurikulers,
        ]);
    }


    /**
     * Halaman create.
     */
    public function create()
    {
        $nextUrutan = (Ekstrakurikuler::max('urutan') ?? 0) + 1;

        return view(
            'admin.akademik.ekstrakurikuler.create',
            compact('nextUrutan')
        );
    }


    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
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

            'pembina' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jadwal' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'nama.required' =>
                'Nama ekstrakurikuler wajib diisi.',

            'nama.max' =>
                'Nama ekstrakurikuler maksimal 255 karakter.',

            'foto.image' =>
                'File harus berupa gambar.',

            'foto.mimes' =>
                'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Tentukan urutan otomatis
        |--------------------------------------------------------------------------
        */

        $urutan =
            (Ekstrakurikuler::max('urutan') ?? 0) + 1;


        $data = [
            'nama' =>
                $validated['nama'],

            'deskripsi' =>
                $validated['deskripsi'] ?? null,

            'pembina' =>
                $validated['pembina'] ?? null,

            'jadwal' =>
                $validated['jadwal'] ?? null,

            'urutan' =>
                $urutan,

            'is_active' =>
                $request->boolean('is_active'),
        ];


        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $foto =
                $request->file('foto');


            $namaFile =
                Str::slug($validated['nama'])
                . '-'
                . time()
                . '.'
                . $foto->getClientOriginalExtension();


            $folder =
                public_path($this->uploadPath);


            if (!File::exists($folder)) {

                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );

            }


            $foto->move(
                $folder,
                $namaFile
            );


            $data['foto'] =
                $namaFile;
        }


        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        $ekstrakurikuler =
            Ekstrakurikuler::create($data);


        return response()->json([
            'success' => true,

            'message' =>
                'Ekstrakurikuler berhasil ditambahkan.',

            'data' =>
                $ekstrakurikuler,
        ]);
    }


    /**
     * Halaman edit.
     */
    public function edit(
        Ekstrakurikuler $ekstrakurikuler
    ) {
        return view(
            'admin.akademik.ekstrakurikuler.edit',
            compact('ekstrakurikuler')
        );
    }


    /**
     * Update data.
     */
    public function update(
        Request $request,
        Ekstrakurikuler $ekstrakurikuler
    ) {
        $validated = $request->validate([
            'nama' => [
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

            'pembina' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jadwal' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'nama.required' =>
                'Nama ekstrakurikuler wajib diisi.',

            'nama.max' =>
                'Nama ekstrakurikuler maksimal 255 karakter.',

            'foto.image' =>
                'File harus berupa gambar.',

            'foto.mimes' =>
                'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',
        ]);


        $data = [
            'nama' =>
                $validated['nama'],

            'deskripsi' =>
                $validated['deskripsi'] ?? null,

            'pembina' =>
                $validated['pembina'] ?? null,

            'jadwal' =>
                $validated['jadwal'] ?? null,

            'is_active' =>
                $request->boolean('is_active'),
        ];


        /*
        |--------------------------------------------------------------------------
        | Upload Foto Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            /*
             * Hapus foto lama
             */
            $this->deleteFoto(
                $ekstrakurikuler->foto
            );


            $foto =
                $request->file('foto');


            $namaFile =
                Str::slug($validated['nama'])
                . '-'
                . time()
                . '.'
                . $foto->getClientOriginalExtension();


            $folder =
                public_path($this->uploadPath);


            if (!File::exists($folder)) {

                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );

            }


            $foto->move(
                $folder,
                $namaFile
            );


            $data['foto'] =
                $namaFile;
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $ekstrakurikuler->update($data);


        return response()->json([
            'success' => true,

            'message' =>
                'Ekstrakurikuler berhasil diperbarui.',

            'data' =>
                $ekstrakurikuler->fresh(),
        ]);
    }


    /**
     * Hapus data.
     */
    public function destroy(
        Ekstrakurikuler $ekstrakurikuler
    ) {
        /*
        |--------------------------------------------------------------------------
        | Hapus Foto
        |--------------------------------------------------------------------------
        */

        $this->deleteFoto(
            $ekstrakurikuler->foto
        );


        /*
        |--------------------------------------------------------------------------
        | Hapus Database
        |--------------------------------------------------------------------------
        */

        $ekstrakurikuler->delete();


        return response()->json([
            'success' => true,

            'message' =>
                'Ekstrakurikuler berhasil dihapus.',
        ]);
    }


    /**
     * Simpan urutan drag & drop.
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
                'exists:ekstrakurikulers,id',
            ],

            'orders.*.urutan' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        foreach ($validated['orders'] as $order) {

            Ekstrakurikuler::where(
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
                'Urutan ekstrakurikuler berhasil disimpan.',
        ]);
    }


    /**
     * Toggle status aktif/nonaktif.
     */
    public function toggleStatus(
        Ekstrakurikuler $ekstrakurikuler
    ) {
        $ekstrakurikuler->update([
            'is_active' =>
                !$ekstrakurikuler->is_active,
        ]);


        return response()->json([
            'success' => true,

            'message' =>
                'Status ekstrakurikuler berhasil diperbarui.',

            'data' => [
                'id' =>
                    $ekstrakurikuler->id,

                'is_active' =>
                    $ekstrakurikuler->is_active,
            ],
        ]);
    }


    /**
     * Hapus file foto.
     */
    private function deleteFoto(
        ?string $filename
    ): void {
        if (!$filename) {
            return;
        }


        $path =
            public_path(
                $this->uploadPath
                . '/'
                . $filename
            );


        if (File::exists($path)) {

            File::delete($path);

        }
    }
}
