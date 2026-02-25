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

        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'selected_answers' => $selectedAnswers,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
