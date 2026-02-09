<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description'
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function menuSections()
    {
        return $this->hasMany(MenuSection::class);
    }

    public function translations()
    {
        return $this->hasMany(BrandTranslation::class);
    }

    /**
     * Get translated name based on current locale
     */
    public function getTranslatedName($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        // Use loaded translations to avoid N+1 query
        $translation = $this->translations->firstWhere('code', $locale);

        return $translation ? $translation->name : $this->name;
    }

    /**
     * Get translated description based on current locale
     */
    public function getTranslatedDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        // Use loaded translations to avoid N+1 query
        $translation = $this->translations->firstWhere('code', $locale);

        return $translation ? $translation->description : $this->description;
    }
}
