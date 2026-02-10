<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapRestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'kk');

        return [
            'id' => $this->id,
            'name' => $this->branch_name,
            'brand_name' => $this->brand?->getTranslatedName($locale) ?? null,
            'latitude' => (float) ($this->lat_coord ?? 0),
            'longitude' => (float) ($this->lng_coord ?? 0),
            'average_rating' => round($this->reviews_avg_rating ?? 0, 1),
        ];
    }
}
