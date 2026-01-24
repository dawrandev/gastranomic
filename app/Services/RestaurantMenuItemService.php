<?php

namespace App\Services;

use App\Models\RestaurantMenuItem;
use App\Repositories\RestaurantMenuItemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RestaurantMenuItemService
{
    public function __construct(
        protected RestaurantMenuItemRepository $repository
    ) {}

    public function getAllByRestaurant(int $restaurantId): Collection
    {
        return $this->repository->getAllByRestaurant($restaurantId);
    }

    public function getRestaurantMenuItems(int $restaurantId, ?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($restaurantId, $perPage, $search);
    }

    public function findRestaurantMenuItem(int $id): ?RestaurantMenuItem
    {
        return $this->repository->findById($id);
    }

    public function createRestaurantMenuItem(array $data): RestaurantMenuItem
    {
        $existing = $this->repository->findByRestaurantAndMenuItem(
            $data['restaurant_id'],
            $data['menu_item_id']
        );

        if ($existing) {
            throw new \Exception('Bu taom allaqachon restoranga qo\'shilgan.');
        }

        return $this->repository->create($data);
    }

    public function updateRestaurantMenuItem(RestaurantMenuItem $restaurantMenuItem, array $data): RestaurantMenuItem
    {
        return $this->repository->update($restaurantMenuItem, $data);
    }

    public function deleteRestaurantMenuItem(RestaurantMenuItem $restaurantMenuItem): bool
    {
        return $this->repository->delete($restaurantMenuItem);
    }

    public function getAvailableMenuItems(int $brandId, int $restaurantId): Collection
    {
        return $this->repository->getAvailableMenuItems($brandId, $restaurantId);
    }
}
