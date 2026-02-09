<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    protected $fillable = [
        'brand_id',
        'code',
        'name',
        'description',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'code', 'code');
    }
}
