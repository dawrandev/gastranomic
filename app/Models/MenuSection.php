<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
    protected $fillable = [
        'brand_id',
        'sort_order',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function translations()
    {
        return $this->hasMany(MenuSectionTranslation::class);
    }

    public function getTranslation(?string $langCode = null)
    {
        $langCode = $langCode ?? \App\Helpers\LanguageHelper::getCurrentLang();
        return $this->translations()->where('lang_code', $langCode)->first();
    }

    public function getNameAttribute()
    {
        $translation = $this->getTranslation();
        return $translation ? $translation->name : null;
    }
}
