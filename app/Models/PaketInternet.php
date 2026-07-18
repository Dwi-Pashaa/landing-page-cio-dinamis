<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketInternet extends Model
{
    protected $fillable = [
        'tipe', 'nama', 'sub_judul', 'harga', 'periode',
        'highlight_text', 'sub_highlight',
        'fitur', 'keuntungan_tambahan',
        'wa_number', 'wa_message',
        'is_featured', 'is_rekomendasi', 'urutan', 'is_active',
    ];

    protected $casts = [
        'fitur' => 'array',
        'keuntungan_tambahan' => 'array',
        'is_featured' => 'boolean',
        'is_rekomendasi' => 'boolean',
        'is_active' => 'boolean',
    ];

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
}
