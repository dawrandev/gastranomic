<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewAnswer extends Model
{
    protected $table = 'review_answers';

    protected $fillable = [
        'review_id',
        'questions_option_id',
    ];

    /**
     * Get the review that owns this answer.
     */
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    /**
     * Get the question option for this answer.
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'questions_option_id');
    }
}
