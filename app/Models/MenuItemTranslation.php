<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslation extends Model
{
    protected $fillable = [
        'menu_item_id',
        'lang_code',
        'name',
        'description',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_code', 'code');
    }
}
