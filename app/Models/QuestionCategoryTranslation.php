<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionCategoryTranslation extends Model
{
    protected $table = 'questions_categories_translations';

    protected $fillable = [
        'questions_category_id',
        'lang_code',
        'title',
        'description',
    ];

    /**
     * Get the question category that owns this translation.
     */
    public function questionCategory(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class, 'questions_category_id');
    }
}
