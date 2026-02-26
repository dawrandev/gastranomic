<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        $data = [
            'id' => $this->id,
            'title' => $this->getTranslatedTitle($locale),
            'is_required' => $this->is_required,
            'allow_multiple' => $this->allow_multiple,
            'sort_order' => $this->sort_order,
        ];

        // Include options only if this is a parent question (not a sub-question)
        if (!$this->parent_category_id) {
            $data['options'] = QuestionOptionResource::collection($this->whenLoaded('options'));
            $data['sub_questions'] = QuestionCategoryResource::collection($this->whenLoaded('children'));
        } else {
            // For sub-questions, include condition info
            $data['condition'] = $this->condition;
            $data['options'] = QuestionOptionResource::collection($this->whenLoaded('options'));
        }

        return $data;
    }
}
