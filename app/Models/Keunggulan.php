<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keunggulan extends Model
{
    protected $table = 'keunggulan';

    protected $fillable = [
        'icon_class', 'gradient_class',
        'judul', 'deskripsi', 'urutan',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
