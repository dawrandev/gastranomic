<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability, $models) {
            // Superadmin can do everything EXCEPT update and delete restaurants
            if ($user->hasRole('superadmin')) {
                // Check if the ability is related to Restaurant
                $isRestaurantAbility = false;
                foreach ($models as $model) {
                    if ($model instanceof \App\Models\Restaurant) {
                        $isRestaurantAbility = true;
                        break;
                    }
                }

                // If it's a Restaurant update or delete, don't bypass the policy
                if ($isRestaurantAbility && in_array($ability, ['update', 'delete'])) {
                    return null; // Let the policy decide
                }

                // For all other abilities, superadmin has full access
                return true;
            }

            return null;
        });

        Paginator::useBootstrapFive();
    }
}
