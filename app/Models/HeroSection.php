<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge_text', 'title', 'description',
        'btn_primary_text', 'btn_primary_url',
        'btn_secondary_text', 'btn_secondary_url',
        'hero_image', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
