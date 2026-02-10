<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'kk');
        $translation = $this->getTranslation($locale);

        return [
            'id' => $this->id,
            'name' => $translation ? $translation->name : null,
            'description' => $translation ? $translation->description : null,
            'image_path' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'base_price' => $this->base_price,
            'weight' => $this->weight,
            'restaurant_price' => $this->when(isset($this->restaurant_price), $this->restaurant_price),
            'is_available' => $this->when(isset($this->is_available), $this->is_available),
        ];
    }
}
