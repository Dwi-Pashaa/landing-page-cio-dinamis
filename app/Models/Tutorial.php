<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tutorial extends Model
{
    protected $fillable = [
        'kategori', 'icon_class', 'gradient_class',
        'judul', 'slug', 'deskripsi', 'thumbnail', 'konten', 'penulis', 'dilihat',
        'video_path', 'video_url',
        'is_featured', 'urutan', 'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'dilihat' => 'integer',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tutorial_tag');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    protected static function booted()
    {
        static::creating(function ($tutorial) {
            if (empty($tutorial->slug)) {
                $tutorial->slug = Str::slug($tutorial->judul);
            }
        });

        static::updating(function ($tutorial) {
            if ($tutorial->isDirty('judul') && empty($tutorial->slug)) {
                $tutorial->slug = Str::slug($tutorial->judul);
            }
        });
    }
}
