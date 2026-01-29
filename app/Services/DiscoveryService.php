<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Repositories\DiscoveryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DiscoveryService
{
    public function __construct(
        protected DiscoveryRepository $discoveryRepository
    ) {}

    /**
     * Get all restaurants with filters.
     */
    public function getAllRestaurants(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->discoveryRepository->getAllRestaurants($filters, $perPage);
    }

    /**
     * Get nearby restaurants based on coordinates.
     */
    public function getNearbyRestaurants(
        float $latitude,
        float $longitude,
        ?float $radiusInKm = null,
        int $perPage = 15
    ): LengthAwarePaginator {
        $radius = $radiusInKm ?? 5; // Default 5km
        return $this->discoveryRepository->getNearbyRestaurants($latitude, $longitude, $radius, $perPage);
    }

    /**
     * Get all restaurants for map display.
     */
    public function getRestaurantsForMap(array $filters = []): array
    {
        return $this->discoveryRepository->getRestaurantsForMap($filters);
    }

    /**
     * Get restaurant by ID with full details.
     */
    public function getRestaurantById(int $id, ?int $clientId = null): ?Restaurant
    {
        return $this->discoveryRepository->getRestaurantById($id, $clientId);
    }

    /**
     * Search restaurants and menu items.
     */
    public function search(string $query, int $perPage = 15): array
    {
        // Search restaurants
        $restaurants = $this->discoveryRepository->searchRestaurants($query, $perPage);

        return [
            'restaurants' => $restaurants,
        ];
    }

    /**
     * Get top restaurants by category.
     */
    public function getTopRestaurantsByCategory(int $categoryId, int $limit = 10)
    {
        return $this->discoveryRepository->getTopRestaurantsByCategory($categoryId, $limit);
    }

    /**
     * Get nearest 5 restaurants.
     */
    public function getNearestRestaurants(float $latitude, float $longitude, int $limit = 5)
    {
        return $this->discoveryRepository->getNearestRestaurants($latitude, $longitude, $limit);
    }
}
