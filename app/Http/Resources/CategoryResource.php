<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'kk');

        return [
            'id' => $this->id,
            'name' => $this->getTranslatedName($locale),
            'description' => $this->getTranslatedDescription($locale),
            'icon' => $this->icon ? asset('storage/' . $this->icon) : null,
        ];
    }
}
