<?php

namespace App\Repositories;

use App\Models\RestaurantMenuItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class RestaurantMenuItemRepository
{
    public function getAllByRestaurant(int $restaurantId): Collection
    {
        return RestaurantMenuItem::where('restaurant_id', $restaurantId)
            ->with(['menuItem.menuSection.translations', 'menuItem.translations'])
            ->latest()
            ->get();
    }

    public function paginate(int $restaurantId, int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        $query = RestaurantMenuItem::where('restaurant_id', $restaurantId)
            ->with(['menuItem.menuSection.translations', 'menuItem.translations']);

        if ($search) {
            $query->whereHas('menuItem.translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function findById(int $id): ?RestaurantMenuItem
    {
        return RestaurantMenuItem::with(['restaurant', 'menuItem.menuSection.translations', 'menuItem.translations'])->find($id);
    }

    public function findByRestaurantAndMenuItem(int $restaurantId, int $menuItemId): ?RestaurantMenuItem
    {
        return RestaurantMenuItem::where('restaurant_id', $restaurantId)
            ->where('menu_item_id', $menuItemId)
            ->first();
    }

    public function create(array $data): RestaurantMenuItem
    {
        return DB::transaction(function () use ($data) {
            return RestaurantMenuItem::create([
                'restaurant_id' => $data['restaurant_id'],
                'menu_item_id' => $data['menu_item_id'],
                'price' => $data['price'],
                'is_available' => $data['is_available'] ?? true,
            ]);
        });
    }

    public function update(RestaurantMenuItem $restaurantMenuItem, array $data): RestaurantMenuItem
    {
        return DB::transaction(function () use ($restaurantMenuItem, $data) {
            $restaurantMenuItem->update([
                'price' => $data['price'] ?? $restaurantMenuItem->price,
                'is_available' => $data['is_available'] ?? $restaurantMenuItem->is_available,
            ]);

            return $restaurantMenuItem->fresh();
        });
    }

    public function delete(RestaurantMenuItem $restaurantMenuItem): bool
    {
        return DB::transaction(function () use ($restaurantMenuItem) {
            return $restaurantMenuItem->delete();
        });
    }

    public function getAvailableMenuItems(int $brandId, int $restaurantId): Collection
    {
        return \App\Models\MenuItem::query()
            ->select('menu_items.*')
            ->join('menu_sections', 'menu_items.menu_section_id', '=', 'menu_sections.id')
            ->leftJoin('restaurant_menu_items', function ($join) use ($restaurantId) {
                $join->on('menu_items.id', '=', 'restaurant_menu_items.menu_item_id')
                    ->where('restaurant_menu_items.restaurant_id', '=', $restaurantId);
            })
            ->where('menu_sections.brand_id', $brandId)
            ->whereNull('restaurant_menu_items.id')
            ->with(['menuSection.translations', 'translations'])
            ->get();
    }
}
