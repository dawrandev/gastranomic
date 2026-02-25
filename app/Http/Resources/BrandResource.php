<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'logo' => $this->logo ? asset('storage/' . $this->logo) : null,
            'avg_rating' => $this->avg_rating ? round((float) $this->avg_rating, 1) : null,
        ];
    }
}
