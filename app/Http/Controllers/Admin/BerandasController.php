<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Keunggulan;
use App\Models\Sambutan;
use App\Models\Videotron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandasController extends Controller
{
    public function videotron(){
        $videotron = Videotron::first();
        return view('admin.beranda.videotron.index', compact('videotron'));
    }

    public function updateVideotron(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:500',
            ],

            'description' => [
                'required',
                'string',
            ],

            'link' => [
                'required',
                'url',
                'max:1000',
            ],
        ], [
            'title.required' => 'Judul videotron wajib diisi.',
            'description.required' => 'Deskripsi videotron wajib diisi.',
            'link.required' => 'Link video YouTube wajib diisi.',
            'link.url' => 'Link video harus berupa URL yang valid.',
        ]);


        // Ambil data pertama
        $videotron = Videotron::first();


        // Jika belum ada data, buat baru
        if (!$videotron) {
            $videotron = new Videotron();
        }


        $videotron->title = $validated['title'];
        $videotron->description = $validated['description'];
        $videotron->link = $validated['link'];

        $videotron->save();


        return redirect()
            ->route('admin.berandas.videotron')
            ->with(
                'success',
                'Pengaturan videotron berhasil diperbarui.'
            );
    }
    /**
     * Halaman pengaturan sambutan
     */
    public function sambutan()
    {
        $sambutan = Sambutan::first();

        return view('admin.beranda.sambutan.index', compact('sambutan'));
    }

    /**
     * Update sambutan
     */
    public function sambutanUpdate(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'title' => [
                'required',
                'string',
                'max:500',
            ],

            'description' => [
                'required',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'title.required' => 'Judul sambutan wajib diisi.',
            'description.required' => 'Isi sambutan wajib diisi.',

            'image.image' => 'File yang dipilih harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $sambutan = Sambutan::first();

        // Jika belum ada data
        if (!$sambutan) {
            $sambutan = new Sambutan();
        }

        $sambutan->nama = $validated['nama'];
        $sambutan->title = $validated['title'];
        $sambutan->description = $validated['description'];


        /**
         * ============================================================
         * UPLOAD GAMBAR
         * ============================================================
         */
        if ($request->hasFile('image')) {

            /*
             * Folder tujuan:
             * public/images/sambutan/
             */
            $destinationPath = public_path('images/sambutan');


            /*
             * Buat folder jika belum ada
             */
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }


            /*
             * Hapus gambar lama
             */
            if (!empty($sambutan->image)) {

                $oldImage = $destinationPath . '/' . $sambutan->image;

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }


            /*
             * Ambil file upload
             */
            $file = $request->file('image');


            /*
             * Buat nama file unik
             */
            $filename = time() . '_' .
                uniqid() . '.' .
                $file->getClientOriginalExtension();


            /*
             * Pindahkan file ke:
             *
             * public/images/sambutan/
             */
            $file->move(
                $destinationPath,
                $filename
            );


            /*
             * Simpan nama file ke database
             */
            $sambutan->image = $filename;
        }


        $sambutan->save();


        return redirect()
            ->route('admin.berandas.sambutan')
            ->with(
                'success',
                'Sambutan berhasil diperbarui.'
            );
    }

    /**
     * ============================================================
     * KEUNGGULAN
     * ============================================================
     */

    /**
     * Menampilkan daftar keunggulan
     */
    public function keunggulan()
    {
        $keunggulans = Keunggulan::orderBy('urutan')
            ->get();

        return view(
            'admin.beranda.keunggulan.index',
            compact('keunggulans')
        );
    }


    /**
     * Form tambah keunggulan
     */
    public function keunggulanCreate()
    {
        return view('admin.beranda.keunggulan.create');
    }


    /**
     * Simpan keunggulan baru
     */
    public function keunggulanStore(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'title.required' => 'Judul keunggulan wajib diisi.',
            'description.required' => 'Deskripsi keunggulan wajib diisi.',
            'icon.max' => 'Icon maksimal 100 karakter.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 0.',
        ]);

        Keunggulan::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.berandas.keunggulan')
            ->with(
                'success',
                'Keunggulan berhasil ditambahkan.'
            );
    }


    /**
     * Form edit keunggulan
     */
    public function keunggulanEdit($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);

        return view(
            'admin.beranda.keunggulan.edit',
            compact('keunggulan')
        );
    }


    /**
     * Update keunggulan
     */
    public function keunggulanUpdate(
        Request $request,
                $id
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'title.required' => 'Judul keunggulan wajib diisi.',
            'description.required' => 'Deskripsi keunggulan wajib diisi.',
            'icon.max' => 'Icon maksimal 100 karakter.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 0.',
        ]);

        $keunggulan = Keunggulan::findOrFail($id);

        $keunggulan->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.berandas.keunggulan')
            ->with(
                'success',
                'Keunggulan berhasil diperbarui.'
            );
    }


    /**
     * Hapus keunggulan
     */
    public function keunggulanDestroy($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);

        $keunggulan->delete();

        return redirect()
            ->route('admin.berandas.keunggulan')
            ->with(
                'success',
                'Keunggulan berhasil dihapus.'
            );
    }

    public function updateUrutanKeunggulan(Request $request)
    {
        $data = $request->input('data', []);

        if (!is_array($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Format data tidak valid.'
            ], 422);
        }

        foreach ($data as $item) {

            if (
                !isset($item['id']) ||
                !isset($item['urutan'])
            ) {
                continue;
            }

            Keunggulan::where('id', $item['id'])
                ->update([
                    'urutan' => (int) $item['urutan']
                ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan berhasil diperbarui.'
        ]);
    }


    /**
     * ============================================================
     * BERITA - INDEX
     * ============================================================
     */
    public function beritaIndex()
    {
        $beritas = Berita::latest()->get();

        return view('admin.beranda.berita.index', compact(
            'beritas',
        ));
    }


    /**
     * ============================================================
     * BERITA - CREATE
     * ============================================================
     */
    public function beritaCreate()
    {
        $categories = Berita::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.beranda.berita.create', compact('categories'));
    }


    /**
     * ============================================================
     * BERITA - STORE
     * ============================================================
     */
    public function beritaStore(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'in:draft,published',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],
        ]);

        // Generate slug
        $validated['slug'] = Berita::generateUniqueSlug(
            $validated['title']
        );

        // Featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Published At
        if ($validated['status'] === 'published') {
            $validated['published_at'] =
                $validated['published_at'] ?? now();
        } else {
            $validated['published_at'] = null;
        }

        // Upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('berita', 'public');
        }

        // Default views
        $validated['views'] = 0;

        Berita::create($validated);

        return redirect()
            ->route('admin.berandas.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    /**
     * ============================================================
     * BERITA - SHOW
     * ============================================================
     */
    public function beritaShow(Berita $berita)
    {
        return view('admin.beranda.berita.show', compact('berita'));
    }


    /**
     * ============================================================
     * BERITA - EDIT
     * ============================================================
     */
    public function beritaEdit(Berita $berita)
    {
        $categories = Berita::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.beranda.berita.edit', compact(
            'berita',
            'categories'
        ));
    }


    /**
     * ============================================================
     * BERITA - UPDATE
     * ============================================================
     */
    public function beritaUpdate(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'in:draft,published',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],
        ]);

        // Generate slug
        $validated['slug'] = Berita::generateUniqueSlug(
            $validated['title'],
            $berita->id
        );

        // Featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Published At
        if ($validated['status'] === 'published') {
            $validated['published_at'] =
                $validated['published_at']
                ?? $berita->published_at
                ?? now();
        } else {
            $validated['published_at'] = null;
        }

        // Upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if (
                $berita->image &&
                Storage::disk('public')->exists($berita->image)
            ) {
                Storage::disk('public')->delete(
                    $berita->image
                );
            }

            // Simpan gambar baru
            $validated['image'] = $request
                ->file('image')
                ->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()
            ->route('admin.berandas.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }


    /**
     * ============================================================
     * BERITA - DESTROY
     * ============================================================
     */
    public function beritaDestroy(Berita $berita)
    {
        // Hapus gambar
        if (
            $berita->image &&
            Storage::disk('public')->exists($berita->image)
        ) {
            Storage::disk('public')->delete(
                $berita->image
            );
        }

        $berita->delete();

        return redirect()
            ->route('admin.berandas.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
