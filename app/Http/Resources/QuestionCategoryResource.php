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

        return [
            'id' => $this->id,
            'key' => $this->key,
            'title' => $this->getTranslatedTitle($locale),
            'description' => $this->getTranslatedDescription($locale),
            'is_required' => $this->is_required,
            'sort_order' => $this->sort_order,
            'options' => QuestionOptionResource::collection($this->whenLoaded('options')),
        ];
    }
}
