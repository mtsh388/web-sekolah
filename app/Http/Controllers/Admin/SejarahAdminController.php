<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SejarahSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SejarahAdminController extends Controller
{
    /**
     * ============================================================
     * INDEX
     * ============================================================
     */
    public function index()
    {
        $sejarah = SejarahSekolah::first();

        return view(
            'admin.profile.sejarah.index',
            compact('sejarah')
        );
    }


    /**
     * ============================================================
     * CREATE
     * ============================================================
     */
    public function create()
    {
        return view('admin.profile.sejarah.create');
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
                'required',
                'string',
            ],

            'image' => [
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
            'judul.required' => 'Judul sejarah wajib diisi.',
            'deskripsi.required' => 'Deskripsi sejarah wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | STATUS AKTIF
        |--------------------------------------------------------------------------
        */
        $validated['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | UPLOAD IMAGE
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            $folder = public_path('images/sejarah');

            // Buat folder jika belum ada
            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }

            $file = $request->file('image');

            $fileName = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $file->move(
                $folder,
                $fileName
            );

            // Simpan path relatif ke database
            $validated['image'] =
                'images/sejarah/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */
        SejarahSekolah::create($validated);


        return redirect()
            ->route('admin.profile.sejarah.index')
            ->with(
                'success',
                'Sejarah sekolah berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * SHOW
     * ============================================================
     */
    public function show(SejarahSekolah $sejarah)
    {
        return view(
            'admin.profile.sejarah.show',
            compact('sejarah')
        );
    }


    /**
     * ============================================================
     * EDIT
     * ============================================================
     */
    public function edit(SejarahSekolah $sejarah)
    {
        return view(
            'admin.profile.sejarah.edit',
            compact('sejarah')
        );
    }


    /**
     * ============================================================
     * UPDATE
     * ============================================================
     */
    public function update(
        Request $request,
        SejarahSekolah $sejarah
    ) {

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

            'image' => [
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
            'judul.required' => 'Judul sejarah wajib diisi.',
            'deskripsi.required' => 'Deskripsi sejarah wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | STATUS AKTIF
        |--------------------------------------------------------------------------
        */
        $validated['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | UPLOAD IMAGE BARU
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            /*
            | Hapus gambar lama
            */
            if ($sejarah->image) {

                $oldImage = public_path(
                    $sejarah->image
                );

                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }


            /*
            | Pastikan folder tersedia
            */
            $folder = public_path('images/sejarah');

            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }


            /*
            | Simpan gambar baru
            */
            $file = $request->file('image');

            $fileName = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $file->move(
                $folder,
                $fileName
            );


            /*
            | Simpan path ke database
            */
            $validated['image'] =
                'images/sejarah/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */
        $sejarah->update($validated);


        return redirect()
            ->route('admin.profile.sejarah.index')
            ->with(
                'success',
                'Sejarah sekolah berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * DESTROY
     * ============================================================
     */
    public function destroy(SejarahSekolah $sejarah)
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE GAMBAR
        |--------------------------------------------------------------------------
        */
        if ($sejarah->image) {

            $imagePath = public_path(
                $sejarah->image
            );

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA
        |--------------------------------------------------------------------------
        */
        $sejarah->delete();


        return redirect()
            ->route('admin.profile.sejarah.index')
            ->with(
                'success',
                'Sejarah sekolah berhasil dihapus.'
            );
    }
}
