<?php

namespace App\Repositories;

use App\Models\Restaurant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class DiscoveryRepository
{
    /**
     * Get all active restaurants with pagination and filters.
     */
    public function getAllRestaurants(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Restaurant::query()
            ->where('is_active', true)
            ->with([
                'brand:id,name,logo',
                'city:id',
                'city.translations',
                'coverImage:id,restaurant_id,image_path,is_cover',
                'categories:id,icon',
                'categories.translations',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        // Filter by category
        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['category_id']);
            });
        }

        // Filter by city
        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }

        // Filter by brand
        if (!empty($filters['brand_id'])) {
            $query->where('brand_id', $filters['brand_id']);
        }

        // Filter by menu section
        if (!empty($filters['menu_section_id'])) {
            $query->whereHas('restaurantMenuItems.menuItem.menuSection', function ($q) use ($filters) {
                $q->where('menu_sections.id', $filters['menu_section_id']);
            });
        }

        // Filter by minimum rating
        if (!empty($filters['min_rating'])) {
            $query->having('reviews_avg_rating', '>=', $filters['min_rating']);
        }

        // Filter by maximum rating
        if (!empty($filters['max_rating'])) {
            $query->having('reviews_avg_rating', '<=', $filters['max_rating']);
        }

        // Sort by rating if requested
        if (!empty($filters['sort_by']) && $filters['sort_by'] === 'rating') {
            $query->orderBy('reviews_avg_rating', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate($perPage);
    }

    /**
     * Get nearby restaurants based on coordinates.
     */
    public function getNearbyRestaurants(
        float $latitude,
        float $longitude,
        float $radiusInKm = 5,
        int $perPage = 15
    ): LengthAwarePaginator {
        // Using Haversine formula for distance calculation
        $query = Restaurant::query()
            ->select([
                'restaurants.*',
                DB::raw("
                    (6371 * acos(
                        cos(radians(?)) *
                        cos(radians(ST_Y(location))) *
                        cos(radians(ST_X(location)) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(ST_Y(location)))
                    )) AS distance
                ")
            ])
            ->setBindings([$latitude, $longitude, $latitude])
            ->where('is_active', true)
            ->whereNotNull('location')
            ->having('distance', '<=', $radiusInKm)
            ->with([
                'brand:id,name,logo',
                'city:id',
                'city.translations',
                'coverImage:id,restaurant_id,image_path,is_cover',
                'categories:id,icon',
                'categories.translations',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('distance', 'asc');

        return $query->paginate($perPage);
    }

    /**
     * Get all restaurants for map display.
     */
    public function getRestaurantsForMap(array $filters = []): Collection
    {
        $query = Restaurant::query()
            ->where('is_active', true)
            ->whereNotNull('location')
            ->select([
                'id',
                'branch_name',
                'brand_id',
                'location', // Bu geometry field
                DB::raw('ST_X(location) as lat_coord'), // Nomini o'zgartirdik
                DB::raw('ST_Y(location) as lng_coord'),
            ])
            ->with(['brand:id,name'])
            ->withAvg('reviews', 'rating');

        // Filter by category
        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['category_id']);
            });
        }

        // Filter by city
        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }

        // Filter by minimum rating
        if (!empty($filters['min_rating'])) {
            $query->having('reviews_avg_rating', '>=', $filters['min_rating']);
        }

        // Filter by maximum rating
        if (!empty($filters['max_rating'])) {
            $query->having('reviews_avg_rating', '<=', $filters['max_rating']);
        }

        return $query->get();
    }

    /**
     * Get restaurant by ID with full details.
     */
    public function getRestaurantById(int $id): ?Restaurant
    {
        return Restaurant::query()
            ->where('id', $id)
            ->where('is_active', true)
            ->with([
                'brand:id,name,logo,description',
                'city:id',
                'city.translations',
                'images:id,restaurant_id,image_path,is_cover',
                'categories:id,icon',
                'categories.translations',
                'operatingHours:id,restaurant_id,day_of_week,opening_time,closing_time,is_closed',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->first();
    }

    /**
     * Search restaurants by name or brand.
     */
    public function searchRestaurants(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return Restaurant::query()
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('branch_name', 'like', "%{$query}%")
                    ->orWhereHas('brand', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    });
            })
            ->with([
                'brand:id,name,logo',
                'city:id',
                'city.translations',
                'coverImage:id,restaurant_id,image_path,is_cover',
                'categories:id,icon',
                'categories.translations',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get top restaurants by category (ordered by rating descending).
     */
    public function getTopRestaurantsByCategory(int $categoryId, int $limit = 10)
    {
        return Restaurant::query()
            ->where('is_active', true)
            ->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            })
            ->with([
                'brand:id,name,logo',
                'city:id',
                'city.translations',
                'coverImage:id,restaurant_id,image_path,is_cover',
                'categories:id,icon',
                'categories.translations',
                'operatingHours:id,restaurant_id,day_of_week,opening_time,closing_time,is_closed',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->orderBy('reviews_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get nearest 5 restaurants (no pagination).
     */
    public function getNearestRestaurants(float $latitude, float $longitude, int $limit = 5)
    {
        return Restaurant::query()
            ->select([
                'restaurants.*',
                DB::raw("
                    (6371 * acos(
                        cos(radians(?)) *
                        cos(radians(ST_Y(location))) *
                        cos(radians(ST_X(location)) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(ST_Y(location)))
                    )) AS distance
                ")
            ])
            ->setBindings([$latitude, $longitude, $latitude])
            ->where('is_active', true)
            ->whereNotNull('location')
            ->with([
                'brand:id,name,logo',
                'city:id',
                'city.translations',
                'coverImage:id,restaurant_id,image_path,is_cover',
                'categories:id,icon',
                'categories.translations',
                'operatingHours:id,restaurant_id,day_of_week,opening_time,closing_time,is_closed',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('distance', 'asc')
            ->limit($limit)
            ->get();
    }
}
