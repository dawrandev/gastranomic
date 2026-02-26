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
        'comments',
    ];

    protected $casts = [
        'rating' => 'integer',
        'comments' => 'array',
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

    /**
     * Get comments with their associated question titles.
     *
     * @param string|null $locale Language code (e.g., 'ru', 'uz', 'kk', 'en')
     * @return array Array of comments with question context
     */
    public function getCommentsWithQuestions(?string $locale = null): array
    {
        if (empty($this->comments) || !is_array($this->comments)) {
            return [];
        }

        $locale = $locale ?? app()->getLocale();
        $questionIds = array_column($this->comments, 'question_id');

        if (empty($questionIds)) {
            return [];
        }

        $questions = QuestionCategory::whereIn('id', $questionIds)
            ->with('translations')
            ->get()
            ->keyBy('id');

        $result = [];
        foreach ($this->comments as $comment) {
            $questionId = $comment['question_id'] ?? null;
            $text = $comment['text'] ?? null;

            if ($questionId && $text && isset($questions[$questionId])) {
                $result[] = [
                    'question_id' => $questionId,
                    'question_title' => $questions[$questionId]->getTranslatedTitle($locale),
                    'text' => $text,
                ];
            }
        }

        return $result;
    }
}
