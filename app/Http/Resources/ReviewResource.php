<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        $selectedAnswers = [];
        if ($this->relationLoaded('selectedOptions')) {
            $selectedAnswers = $this->selectedOptions->map(function ($option) use ($locale) {
                return [
                    'id' => $option->id,
                    'key' => $option->key,
                    'text' => $option->getTranslatedText($locale),
                ];
            })->toArray();
        }

        // Process comments with question context
        $commentsWithQuestions = [];
        if (!empty($this->comments) && is_array($this->comments)) {
            foreach ($this->comments as $comment) {
                $questionId = $comment['question_id'] ?? null;
                $text = $comment['text'] ?? null;

                if ($questionId && $text) {
                    $question = \App\Models\QuestionCategory::find($questionId);
                    $commentsWithQuestions[] = [
                        'question_id' => $questionId,
                        'question_title' => $question ? $question->getTranslatedTitle($locale) : null,
                        'text' => $text,
                    ];
                }
            }
        }

        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'comments' => $commentsWithQuestions,
            'selected_answers' => $selectedAnswers,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
