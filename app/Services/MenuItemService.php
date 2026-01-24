<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Repositories\MenuItemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MenuItemService
{
    public function __construct(
        protected MenuItemRepository $repository
    ) {}

    public function getAllByBrand(int $brandId): Collection
    {
        return $this->repository->getAllByBrand($brandId);
    }

    public function getMenuItems(int $brandId, ?string $search = null, ?int $sectionId = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($brandId, $perPage, $search, $sectionId);
    }

    public function findMenuItem(int $id): ?MenuItem
    {
        return $this->repository->findById($id);
    }

    public function createMenuItem(array $data): MenuItem
    {
        if (isset($data['image']) && $data['image']) {
            $data['image_path'] = $this->uploadImage($data['image']);
            unset($data['image']);
        }

        $menuItem = $this->repository->create($data);

        // Automatically add to all brand restaurants
        $this->addToAllBrandRestaurants($menuItem);

        return $menuItem;
    }

    private function addToAllBrandRestaurants(MenuItem $menuItem): void
    {
        $brandId = $menuItem->menuSection->brand_id;

        // Get all active restaurants of this brand
        $restaurants = \App\Models\Restaurant::where('brand_id', $brandId)
            ->where('is_active', true)
            ->get();

        foreach ($restaurants as $restaurant) {
            // Check if already exists
            $exists = \App\Models\RestaurantMenuItem::where('restaurant_id', $restaurant->id)
                ->where('menu_item_id', $menuItem->id)
                ->exists();

            if (!$exists) {
                \App\Models\RestaurantMenuItem::create([
                    'restaurant_id' => $restaurant->id,
                    'menu_item_id' => $menuItem->id,
                    'price' => $menuItem->base_price ?? 0,
                    'is_available' => true,
                ]);
            }
        }
    }

    public function updateMenuItem(MenuItem $menuItem, array $data): MenuItem
    {
        if (isset($data['image']) && $data['image']) {
            if ($menuItem->image_path) {
                Storage::disk('public')->delete($menuItem->image_path);
            }
            $data['image_path'] = $this->uploadImage($data['image']);
        }

        unset($data['image']);

        return $this->repository->update($menuItem, $data);
    }

    public function deleteMenuItem(MenuItem $menuItem): bool
    {
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }

        return $this->repository->delete($menuItem);
    }

    private function uploadImage($file): string
    {
        return $file->store('menu-items', 'public');
    }
}
