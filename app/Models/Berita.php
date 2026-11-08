<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'beritas';

    /**
     * Field yang boleh diisi menggunakan mass assignment.
     */
    protected $fillable = [
        'title',
        'youtube_url',
        'slug',
        'content',
        'category',
        'image',
        'status',
        'published_at',
        'is_featured',
        'views',
    ];

    /**
     * Casting tipe data.
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'views' => 'integer',
        ];
    }

    /**
     * Scope untuk berita yang sudah dipublikasikan.
     */
    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope untuk berita unggulan.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope berdasarkan kategori.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Tambah jumlah views.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }


}
