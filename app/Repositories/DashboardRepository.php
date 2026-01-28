<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    /**
     * Get total restaurants count
     */
    public function getTotalRestaurants(): int
    {
        return Restaurant::count();
    }

    /**
     * Get guest reviews count (client_id is null)
     */
    public function getGuestReviewsCount(): int
    {
        return Review::whereNull('client_id')->count();
    }

    /**
     * Get total reviews count
     */
    public function getTotalReviews(): int
    {
        return Review::count();
    }

    /**
     * Get overall average rating
     */
    public function getAverageRating(): float
    {
        return round(Review::avg('rating') ?? 0, 1);
    }

    /**
     * Get total brands count
     */
    public function getTotalBrands(): int
    {
        return Brand::count();
    }

    /**
     * Get total categories count
     */
    public function getTotalCategories(): int
    {
        return Category::count();
    }

    /**
     * Get top rated restaurant with avg rating
     */
    public function getTopRatedRestaurant(): ?array
    {
        $topRestaurant = Restaurant::select('restaurants.id', 'restaurants.branch_name')
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id', 'restaurants.branch_name')
            ->selectRaw('AVG(reviews.rating) as avg_rating, COUNT(reviews.id) as review_count')
            ->having('review_count', '>', 0)
            ->orderByDesc('avg_rating')
            ->first();

        if (!$topRestaurant) {
            return null;
        }

        return [
            'name' => $topRestaurant->branch_name,
            'avg_rating' => round($topRestaurant->avg_rating, 1),
            'review_count' => $topRestaurant->review_count,
        ];
    }

    /**
     * Get total admins count
     */
    public function getTotalAdmins(): int
    {
        return User::role('admin')->count();
    }

    /**
     * Get reviews trend data (last 30 days)
     */
    public function getReviewsTrend(int $days = 30): array
    {
        $trend = Review::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        foreach ($trend as $item) {
            $labels[] = date('d M', strtotime($item->date));
            $data[] = $item->count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get rating distribution (1-5 stars)
     */
    public function getRatingDistribution(): array
    {
        $distribution = Review::select('rating', DB::raw('COUNT(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            $labels[] = $i . ' ⭐';
            $data[] = $distribution[$i] ?? 0;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get restaurants by category
     */
    public function getRestaurantsByCategory(string $locale = 'uz'): array
    {
        $categories = DB::table('categories')
            ->select('category_translations.name', DB::raw('COUNT(restaurant_category.restaurant_id) as restaurant_count'))
            ->leftJoin('category_translations', function ($join) use ($locale) {
                $join->on('categories.id', '=', 'category_translations.category_id')
                    ->where('category_translations.code', '=', $locale);
            })
            ->leftJoin('restaurant_category', 'categories.id', '=', 'restaurant_category.category_id')
            ->groupBy('categories.id', 'category_translations.name')
            ->orderByDesc('restaurant_count')
            ->get();

        $labels = [];
        $data = [];

        foreach ($categories as $category) {
            $labels[] = $category->name ?? 'N/A';
            $data[] = $category->restaurant_count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get top 5 restaurants by rating
     */
    public function getTop5Restaurants(): array
    {
        $topRestaurants = Restaurant::select('restaurants.branch_name')
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id', 'restaurants.branch_name')
            ->selectRaw('AVG(reviews.rating) as avg_rating, COUNT(reviews.id) as review_count')
            ->having('review_count', '>', 0)
            ->orderByDesc('avg_rating')
            ->limit(5)
            ->get();

        $labels = [];
        $data = [];

        foreach ($topRestaurants as $restaurant) {
            $labels[] = $restaurant->branch_name;
            $data[] = round($restaurant->avg_rating, 1);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get admin-specific restaurant IDs
     */
    public function getAdminRestaurantIds(User $user): array
    {
        return $user->restaurants->pluck('id')->toArray();
    }

    /**
     * Get statistics for admin's restaurants
     */
    public function getAdminStatistics(array $restaurantIds): array
    {
        $today = now()->startOfDay();

        $stats = Review::whereIn('restaurant_id', $restaurantIds)
            ->selectRaw('
                COUNT(*) as total_reviews,
                AVG(rating) as average_rating,
                SUM(CASE WHEN client_id IS NULL THEN 1 ELSE 0 END) as guest_reviews,
                SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as today_reviews
            ', [$today])
            ->first();

        // Get top and worst restaurants
        $topRestaurant = Restaurant::select('restaurants.id', 'restaurants.branch_name')
            ->whereIn('restaurants.id', $restaurantIds)
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id', 'restaurants.branch_name')
            ->selectRaw('AVG(reviews.rating) as avg_rating, COUNT(reviews.id) as review_count')
            ->having('review_count', '>', 0)
            ->orderByDesc('avg_rating')
            ->first();

        $worstRestaurant = Restaurant::select('restaurants.id', 'restaurants.branch_name')
            ->whereIn('restaurants.id', $restaurantIds)
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id', 'restaurants.branch_name')
            ->selectRaw('AVG(reviews.rating) as avg_rating, COUNT(reviews.id) as review_count')
            ->having('review_count', '>', 0)
            ->orderBy('avg_rating')
            ->first();

        return [
            'my_restaurants' => count($restaurantIds),
            'total_reviews' => $stats->total_reviews ?? 0,
            'average_rating' => round($stats->average_rating ?? 0, 1),
            'guest_reviews' => $stats->guest_reviews ?? 0,
            'today_reviews' => $stats->today_reviews ?? 0,
            'five_star' => $stats->five_star ?? 0,
            'top_restaurant' => $topRestaurant ? [
                'name' => $topRestaurant->branch_name,
                'avg_rating' => round($topRestaurant->avg_rating, 1),
                'review_count' => $topRestaurant->review_count,
            ] : null,
            'worst_restaurant' => $worstRestaurant ? [
                'name' => $worstRestaurant->branch_name,
                'avg_rating' => round($worstRestaurant->avg_rating, 1),
                'review_count' => $worstRestaurant->review_count,
            ] : null,
        ];
    }

    /**
     * Get reviews trend for admin's restaurants
     */
    public function getAdminReviewsTrend(array $restaurantIds, int $days = 30): array
    {
        $trend = Review::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereIn('restaurant_id', $restaurantIds)
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        foreach ($trend as $item) {
            $labels[] = date('d M', strtotime($item->date));
            $data[] = $item->count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get rating distribution for admin's restaurants
     */
    public function getAdminRatingDistribution(array $restaurantIds): array
    {
        $distribution = Review::select('rating', DB::raw('COUNT(*) as count'))
            ->whereIn('restaurant_id', $restaurantIds)
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            $labels[] = $i . ' ⭐';
            $data[] = $distribution[$i] ?? 0;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get reviews count by restaurant (for admin)
     */
    public function getReviewsByRestaurant(array $restaurantIds): array
    {
        $restaurants = Restaurant::select('restaurants.branch_name')
            ->whereIn('restaurants.id', $restaurantIds)
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id', 'restaurants.branch_name')
            ->selectRaw('COUNT(reviews.id) as review_count')
            ->orderByDesc('review_count')
            ->get();

        $labels = [];
        $data = [];

        foreach ($restaurants as $restaurant) {
            $labels[] = $restaurant->branch_name;
            $data[] = $restaurant->review_count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get average ratings by restaurant (for admin)
     */
    public function getRatingsByRestaurant(array $restaurantIds): array
    {
        $restaurants = Restaurant::select('restaurants.branch_name')
            ->whereIn('restaurants.id', $restaurantIds)
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id', 'restaurants.branch_name')
            ->selectRaw('AVG(reviews.rating) as avg_rating, COUNT(reviews.id) as review_count')
            ->having('review_count', '>', 0)
            ->orderByDesc('avg_rating')
            ->get();

        $labels = [];
        $data = [];

        foreach ($restaurants as $restaurant) {
            $labels[] = $restaurant->branch_name;
            $data[] = round($restaurant->avg_rating, 1);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get monthly reviews for admin's restaurants (12 months)
     */
    public function getAdminMonthlyReviews(array $restaurantIds): array
    {
        $monthlyData = Review::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
            ->whereIn('restaurant_id', $restaurantIds)
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($monthlyData as $item) {
            $labels[] = date('M Y', strtotime($item->month . '-01'));
            $data[] = $item->count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get guest vs registered reviews for admin's restaurants
     */
    public function getAdminGuestVsRegistered(array $restaurantIds): array
    {
        $stats = Review::whereIn('restaurant_id', $restaurantIds)
            ->selectRaw('
                SUM(CASE WHEN client_id IS NULL THEN 1 ELSE 0 END) as guest_count,
                SUM(CASE WHEN client_id IS NOT NULL THEN 1 ELSE 0 END) as registered_count
            ')
            ->first();

        return [
            'labels' => ['Гостевые', 'Зарегистрированные'],
            'data' => [
                $stats->guest_count ?? 0,
                $stats->registered_count ?? 0
            ],
        ];
    }
}
