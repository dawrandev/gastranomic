<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\DashboardRepository;

class DashboardService
{
    public function __construct(
        protected DashboardRepository $dashboardRepository
    ) {}

    /**
     * Get all statistics for superadmin dashboard
     */
    public function getSuperadminDashboardData(string $locale = 'uz'): array
    {
        $topRestaurant = $this->dashboardRepository->getTopRatedRestaurant();

        return [
            'cards' => [
                'total_restaurants' => $this->dashboardRepository->getTotalRestaurants(),
                'guest_reviews' => $this->dashboardRepository->getGuestReviewsCount(),
                'total_reviews' => $this->dashboardRepository->getTotalReviews(),
                'average_rating' => $this->dashboardRepository->getAverageRating(),
                'total_brands' => $this->dashboardRepository->getTotalBrands(),
                'total_categories' => $this->dashboardRepository->getTotalCategories(),
                'top_restaurant' => $topRestaurant,
                'total_admins' => $this->dashboardRepository->getTotalAdmins(),
            ],
            'charts' => [
                'reviews_trend' => $this->dashboardRepository->getReviewsTrend(30),
                'rating_distribution' => $this->dashboardRepository->getRatingDistribution(),
                'restaurants_by_category' => $this->dashboardRepository->getRestaurantsByCategory($locale),
                'top_5_restaurants' => $this->dashboardRepository->getTop5Restaurants(),
            ],
        ];
    }

    /**
     * Get all statistics for admin dashboard
     */
    public function getAdminDashboardData(User $user): array
    {
        $restaurantIds = $this->dashboardRepository->getAdminRestaurantIds($user);

        if (empty($restaurantIds)) {
            return [
                'cards' => [
                    'my_restaurants' => 0,
                    'total_reviews' => 0,
                    'average_rating' => 0,
                    'guest_reviews' => 0,
                    'today_reviews' => 0,
                    'five_star' => 0,
                    'top_restaurant' => null,
                    'worst_restaurant' => null,
                ],
                'charts' => [
                    'reviews_trend' => ['labels' => [], 'data' => []],
                    'monthly_reviews' => ['labels' => [], 'data' => []],
                    'rating_distribution' => ['labels' => [], 'data' => []],
                    'guest_vs_registered' => ['labels' => [], 'data' => []],
                ],
            ];
        }

        $statistics = $this->dashboardRepository->getAdminStatistics($restaurantIds);

        return [
            'cards' => $statistics,
            'charts' => [
                'reviews_trend' => $this->dashboardRepository->getAdminReviewsTrend($restaurantIds, 30),
                'monthly_reviews' => $this->dashboardRepository->getAdminMonthlyReviews($restaurantIds),
                'rating_distribution' => $this->dashboardRepository->getAdminRatingDistribution($restaurantIds),
                'guest_vs_registered' => $this->dashboardRepository->getAdminGuestVsRegistered($restaurantIds),
            ],
        ];
    }
}
