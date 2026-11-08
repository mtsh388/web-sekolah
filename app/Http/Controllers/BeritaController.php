<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index(Request $request)
    {
        $query = Berita::published()
            ->latest('published_at');

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $beritas = $query->paginate(9)->withQueryString();

        // Daftar kategori yang tersedia
        $categories = Berita::published()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('berita.index', compact(
            'beritas',
            'categories'
        ));
    }

    /**
     * Menampilkan detail berita.
     */
    public function show(string $slug)
    {
        $berita = Berita::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Tambah jumlah views
        $berita->incrementViews();

        // Berita terkait
        $beritaTerkait = Berita::published()
            ->where('id', '!=', $berita->id)
            ->when($berita->category, function ($query) use ($berita) {
                $query->where('category', $berita->category);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('berita.show', compact(
            'berita',
            'beritaTerkait'
        ));
    }
}
