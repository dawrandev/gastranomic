<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'device_id',
        'ip_address',
        'phone',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Get the restaurant that owns the review.
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Get the question options selected for this review.
     */
    public function selectedOptions(): BelongsToMany
    {
        return $this->belongsToMany(
            QuestionOption::class,
            'review_answers',
            'review_id',
            'questions_option_id'
        );
    }
}
