<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'page_key', 'page_label',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description',
    ];

    public static function getForPage($pageKey)
    {
        return self::where('page_key', $pageKey)->first();
    }
}
