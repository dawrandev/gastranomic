<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuestionOption extends Model
{
    protected $table = 'questions_options';

    protected $fillable = [
        'questions_category_id',
        'key',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the question category that owns this option.
     */
    public function questionCategory(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class);
    }

    /**
     * Get translations for this option.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(QuestionOptionTranslation::class, 'questions_option_id');
    }

    /**
     * Get reviews that selected this option.
     */
    public function reviewAnswers(): BelongsToMany
    {
        return $this->belongsToMany(
            Review::class,
            'review_answers',
            'questions_option_id',
            'review_id'
        );
    }

    /**
     * Get translated text for a specific language.
     */
    public function getTranslatedText(?string $langCode = null): ?string
    {
        $langCode = $langCode ?? app()->getLocale();
        $translation = $this->translations()
            ->where('lang_code', $langCode)
            ->first();

        return $translation ? $translation->text : null;
    }
}
