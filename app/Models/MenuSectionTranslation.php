<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSectionTranslation extends Model
{
    protected $fillable = [
        'menu_section_id',
        'lang_code',
        'name',
    ];

    public function menuSection()
    {
        return $this->belongsTo(MenuSection::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_code', 'code');
    }
}
