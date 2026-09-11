<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangKamiSection extends Model
{
    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_description',
        'about_title',
        'about_lead',
        'about_description',
        'about_image',
        'visi_title',
        'visi_text',
        'misi_title',
        'misi_items',
        'is_active',
    ];

    protected $casts = [
        'misi_items' => 'array',
        'is_active' => 'boolean',
    ];
}
