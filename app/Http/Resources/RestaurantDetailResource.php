<?php

namespace App\Http\Resources;

use App\Models\MenuSection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'kk');

        return [
            'id' => $this->id,
            'branch_name' => $this->branch_name,
            'phone' => $this->phone,
            'description' => $this->description,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_active' => $this->is_active,
            'qr_code' => $this->qr_code ? asset('storage/' . $this->qr_code) : null,

            // Brand info
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->getTranslatedName($locale),
                'logo' => $this->brand->logo ? asset('storage/' . $this->brand->logo) : null,
                'image' => $this->brand->logo ? asset('storage/' . $this->brand->logo) : null,
                'description' => $this->brand->getTranslatedDescription($locale),
            ],

            // City
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->getTranslatedName($locale),
            ],

            // Categories
            'categories' => $this->categories->map(function ($category) use ($locale) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslatedName($locale),
                    'icon' => $category->icon ? asset('storage/' . $category->icon) : null,
                ];
            }),

            // Images
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image_path' => asset('storage/' . $image->image_path),
                    'is_cover' => $image->is_cover,
                ];
            }),

            // Operating hours
            'operating_hours' => $this->operatingHours->map(function ($hour) {
                return [
                    'day_of_week' => $hour->day_of_week,
                    'opening_time' => $hour->opening_time,
                    'closing_time' => $hour->closing_time,
                    'is_closed' => $hour->is_closed,
                ];
            }),

            // Rating info
            'average_rating' => round($this->reviews_avg_rating ?? 0, 1),
            'reviews_count' => $this->reviews_count ?? 0,

            // Favorite status (if client is authenticated)
            'is_favorited' => $this->when(isset($this->is_favorited), $this->is_favorited),

            // Menu categories (sections)
            'menu_categories' => $this->getMenuCategories($locale),

            // Menu items
            'menus' => $this->getMenuItems($locale),

            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Get menu categories (sections) for this restaurant.
     */
    private function getMenuCategories(string $locale): array
    {
        if (!$this->brand_id) {
            return [];
        }

        $restaurantId = $this->id;

        return MenuSection::where('brand_id', $this->brand_id)
            ->with(['translations'])
            ->whereHas('menuItems.restaurantMenuItems', function ($query) use ($restaurantId) {
                $query->where('restaurant_id', $restaurantId)
                    ->where('is_available', true);
            })
            ->orderBy('sort_order')
            ->get()
            ->map(function ($section) use ($locale) {
                $translation = $section->translations->firstWhere('lang_code', $locale)
                    ?? $section->translations->first();

                return [
                    'id' => $section->id,
                    'name' => $translation?->name,
                    'sort_order' => $section->sort_order,
                ];
            })
            ->toArray();
    }

    /**
     * Get menu items for this restaurant.
     */
    private function getMenuItems(string $locale): array
    {
        if (!$this->brand_id) {
            return [];
        }

        $restaurantId = $this->id;

        return MenuSection::where('brand_id', $this->brand_id)
            ->with([
                'menuItems.translations',
                'menuItems.restaurantMenuItems' => function ($query) use ($restaurantId) {
                    $query->where('restaurant_id', $restaurantId)
                        ->where('is_available', true);
                },
            ])
            ->orderBy('sort_order')
            ->get()
            ->flatMap(function ($section) use ($locale) {
                return $section->menuItems
                    ->filter(fn($item) => $item->restaurantMenuItems->isNotEmpty())
                    ->map(function ($item) use ($locale, $section) {
                        $restaurantItem = $item->restaurantMenuItems->first();
                        $translation = $item->translations->firstWhere('lang_code', $locale)
                            ?? $item->translations->first();

                        return [
                            'id' => $item->id,
                            'name' => $translation?->name,
                            'description' => $translation?->description,
                            'image' => $item->image_path ? asset('storage/' . $item->image_path) : null,
                            'price' => $restaurantItem->price ?? $item->base_price,
                            'weight' => $item->weight,
                            'category_id' => $section->id,
                        ];
                    });
            })
            ->toArray();
    }

}
