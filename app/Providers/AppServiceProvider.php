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
            if ($user->hasRole('superadmin')) {
                $isRestaurantAbility = false;
                foreach ($models as $model) {
                    if ($model instanceof \App\Models\Restaurant) {
                        $isRestaurantAbility = true;
                        break;
                    }
                }

                if ($isRestaurantAbility && in_array($ability, ['update', 'delete'])) {
                    return null; // Let the policy decide
                }

                return true;
            }

            return null;
        });

        Paginator::useBootstrapFive();
    }
}
