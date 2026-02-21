<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionCategory extends Model
{
    protected $table = 'questions_categories';

    protected $fillable = [
        'key',
        'sort_order',
        'is_required',
        'is_active',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get translations for this question category.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(QuestionCategoryTranslation::class, 'questions_category_id');
    }

    /**
     * Get options for this question category.
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class, 'questions_category_id');
    }

    /**
     * Get translated title for a specific language.
     */
    public function getTranslatedTitle(?string $langCode = null): ?string
    {
        $langCode = $langCode ?? app()->getLocale();
        $translation = $this->translations()
            ->where('lang_code', $langCode)
            ->first();

        return $translation ? $translation->title : null;
    }

    /**
     * Get translated description for a specific language.
     */
    public function getTranslatedDescription(?string $langCode = null): ?string
    {
        $langCode = $langCode ?? app()->getLocale();
        $translation = $this->translations()
            ->where('lang_code', $langCode)
            ->first();

        return $translation ? $translation->description : null;
    }
}
