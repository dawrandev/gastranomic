<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionOptionTranslation extends Model
{
    protected $table = 'questions_options_translations';

    protected $fillable = [
        'questions_option_id',
        'lang_code',
        'text',
    ];

    /**
     * Get the question option that owns this translation.
     */
    public function questionOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'questions_option_id');
    }
}
