<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BeritaAdminController extends Controller
{
    /**
     * =========================================================
     * INDEX
     * =========================================================
     */
    public function index()
    {
        return view('admin.berita.index');
    }


    /**
     * =========================================================
     * DATA
     * =========================================================
     */
    public function data()
    {
        $data = Berita::orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }


    /**
     * =========================================================
     * CREATE
     * =========================================================
     */
    public function create()
    {
        return response()->json([
            'status' => true
        ]);
    }


    /**
     * =========================================================
     * STORE
     * =========================================================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => [
                'nullable',
                'url',
                'max:255'
            ],
            'content' => 'required|string',

            'category' => 'nullable|string|max:255',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'status' => [
                'required',
                'in:draft,published,archived'
            ],

            'published_at' => [
                'nullable',
                'date'
            ],

            'is_featured' => [
                'nullable',
                'boolean'
            ],
        ]);


        /*
         * =====================================================
         * SLUG
         * =====================================================
         */
        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );


        /*
         * =====================================================
         * FEATURED
         * =====================================================
         */
        $validated['is_featured'] =
            $request->boolean('is_featured');


        /*
         * =====================================================
         * VIEWS
         * =====================================================
         */
        $validated['views'] = 0;


        /*
         * =====================================================
         * PUBLISHED AT
         *
         * Kalau status published dan tanggal kosong,
         * otomatis gunakan waktu sekarang.
         * =====================================================
         */
        if (
            $validated['status'] === 'published'
            && empty($validated['published_at'])
        ) {
            $validated['published_at'] = now();
        }


        /*
         * Kalau bukan published,
         * tanggal publikasi dikosongkan.
         */
        if ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }


        /*
         * =====================================================
         * UPLOAD IMAGE
         * =====================================================
         */
        if ($request->hasFile('image')) {
            $validated['image'] =
                $this->uploadImage(
                    $request->file('image')
                );
        }


        /*
         * =====================================================
         * SIMPAN
         * =====================================================
         */
        $berita = Berita::create($validated);


        return response()->json([
            'status' => true,
            'msg' => 'Berita berhasil ditambahkan.',
            'data' => $berita
        ]);
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     */
    public function edit(Berita $berita)
    {
        return response()->json([
            'status' => true,
            'data' => $berita
        ]);
    }


    /**
     * =========================================================
     * UPDATE
     * =========================================================
     */
    public function update(
        Request $request,
        Berita $berita
    ) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => [
                'nullable',
                'url',
                'max:255'
            ],
            'content' => 'required|string',

            'category' => 'nullable|string|max:255',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'status' => [
                'required',
                'in:draft,published,archived'
            ],

            'published_at' => [
                'nullable',
                'date'
            ],

            'is_featured' => [
                'nullable',
                'boolean'
            ],
        ]);


        /*
         * =====================================================
         * SLUG
         *
         * Generate ulang jika title berubah.
         * =====================================================
         */
        if ($berita->title !== $validated['title']) {

            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $berita->id
                );
        }


        /*
         * =====================================================
         * FEATURED
         * =====================================================
         */
        $validated['is_featured'] =
            $request->boolean('is_featured');


        /*
         * =====================================================
         * PUBLISHED AT
         * =====================================================
         */
        if (
            $validated['status'] === 'published'
            && empty($validated['published_at'])
        ) {
            $validated['published_at'] =
                $berita->published_at ?? now();
        }


        if ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }


        /*
         * =====================================================
         * UPLOAD IMAGE BARU
         * =====================================================
         */
        if ($request->hasFile('image')) {

            /*
             * Hapus gambar lama
             */
            $this->deleteImage(
                $berita->image
            );


            /*
             * Upload gambar baru
             */
            $validated['image'] =
                $this->uploadImage(
                    $request->file('image')
                );
        }


        /*
         * =====================================================
         * UPDATE
         * =====================================================
         */
        $berita->update($validated);


        return response()->json([
            'status' => true,
            'msg' => 'Berita berhasil diperbarui.',
            'data' => $berita->fresh()
        ]);
    }


    /**
     * =========================================================
     * DESTROY
     * =========================================================
     */
    public function destroy(Berita $berita)
    {
        /*
         * Hapus gambar
         */
        $this->deleteImage(
            $berita->image
        );


        /*
         * Hapus data
         */
        $berita->delete();


        return response()->json([
            'status' => true,
            'msg' => 'Berita berhasil dihapus.'
        ]);
    }


    /**
     * =========================================================
     * TOGGLE FEATURED
     * =========================================================
     */
    public function toggleFeatured(Berita $berita)
    {
        $berita->update([
            'is_featured' => !$berita->is_featured
        ]);


        return response()->json([
            'status' => true,

            'msg' => $berita->is_featured
                ? 'Berita berhasil dijadikan unggulan.'
                : 'Berita tidak lagi menjadi berita unggulan.',

            'data' => $berita->fresh()
        ]);
    }


    /**
     * =========================================================
     * TOGGLE STATUS
     * =========================================================
     */
    public function toggleStatus(Berita $berita)
    {
        /*
         * Jika published -> draft
         * selain published -> published
         */
        if ($berita->status === 'published') {

            $berita->update([
                'status' => 'draft',
                'published_at' => null
            ]);

        } else {

            $berita->update([
                'status' => 'published',
                'published_at' =>
                    $berita->published_at ?? now()
            ]);
        }


        return response()->json([
            'status' => true,

            'msg' => $berita->status === 'published'
                ? 'Berita berhasil dipublikasikan.'
                : 'Berita berhasil dikembalikan ke draft.',

            'data' => $berita->fresh()
        ]);
    }


    /**
     * =========================================================
     * GENERATE UNIQUE SLUG
     * =========================================================
     */
    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($title);

        /*
         * Jika title kosong setelah slug,
         * gunakan timestamp.
         */
        if (empty($slug)) {
            $slug = 'berita-' . time();
        }


        $originalSlug = $slug;

        $counter = 1;


        while (true) {

            $query = Berita::where(
                'slug',
                $slug
            );


            if ($ignoreId) {
                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                );
            }


            if (!$query->exists()) {
                break;
            }


            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }


        return $slug;
    }


    /**
     * =========================================================
     * UPLOAD IMAGE
     * =========================================================
     */
    private function uploadImage($file)
    {
        $folder =
            public_path('images/berita');


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


        $filename .=
            '-' .
            time() .
            '-' .
            Str::random(6) .
            '.' .
            $extension;


        $file->move(
            $folder,
            $filename
        );


        return $filename;
    }


    /**
     * =========================================================
     * DELETE IMAGE
     * =========================================================
     */
    private function deleteImage(
        ?string $filename
    ) {

        if (!$filename) {
            return;
        }


        $path =
            public_path(
                'images/berita/' . $filename
            );


        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public function uploadSummernoteImage(Request $request)
    {
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
        ]);

        $image = $request->file('image');

        $directory = public_path('images/berita/content');

        // Buat folder jika belum ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Nama file unik
        $filename = time() . '_' . Str::random(10) . '.' .
            $image->getClientOriginalExtension();

        // Simpan file
        $image->move($directory, $filename);

        // URL yang akan diberikan ke Summernote
        $url = asset('images/berita/content/' . $filename);

        return response()->json([
            'success' => true,
            'url' => $url,
            'filename' => $filename,
        ]);
    }
}
