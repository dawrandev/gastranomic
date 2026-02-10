<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'kk');

        return [
            'id' => $this->id,
            'restaurant' => $this->branch_name,
            'branch_name' => $this->branch_name,
            'address' => $this->address,
            'phone' => $this->phone,

            // Brand info
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->getTranslatedName($locale),
                'logo' => $this->brand->logo ? asset('storage/' . $this->brand->logo) : null,
            ],

            // City
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->getTranslatedName($locale),
            ],

            // Cover image
            'cover_image' => $this->coverImage
                ? asset('storage/' . $this->coverImage->image_path)
                : null,

            // Categories
            'categories' => $this->categories->map(function ($category) use ($locale) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslatedName($locale),
                ];
            }),

            // Primary category name (for UI display)
            'category_name' => $this->categories->first()?->getTranslatedName($locale) ?? null,

            // Rating info
            'average_rating' => round($this->reviews_avg_rating ?? 0, 1),
            'reviews_count' => $this->reviews_count ?? 0,

            // Operating hours (if loaded)
            'operating_hours' => $this->when(
                $this->relationLoaded('operatingHours'),
                $this->operatingHours->map(function ($hour) {
                    return [
                        'day_of_week' => $hour->day_of_week,
                        'opening_time' => $hour->opening_time,
                        'closing_time' => $hour->closing_time,
                        'is_closed' => $hour->is_closed,
                    ];
                })
            ),

            // Distance (if available from nearby search)
            'distance' => $this->when(isset($this->distance), round($this->distance, 2)),
        ];
    }
}
