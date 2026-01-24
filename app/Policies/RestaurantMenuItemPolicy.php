<?php

namespace App\Policies;

use App\Models\RestaurantMenuItem;
use App\Models\User;
use App\Permissions\RestaurantMenuItemPermissions;

class RestaurantMenuItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(RestaurantMenuItemPermissions::VIEW_ANY);
    }

    public function view(User $user, RestaurantMenuItem $restaurantMenuItem): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can(RestaurantMenuItemPermissions::VIEW) &&
            $user->id === $restaurantMenuItem->restaurant->user_id;
    }

    public function create(User $user): bool
    {
        return $user->can(RestaurantMenuItemPermissions::CREATE);
    }

    public function update(User $user, RestaurantMenuItem $restaurantMenuItem): bool
    {
        if ($user->isSuperAdmin()) {
            return false;
        }

        return $user->can(RestaurantMenuItemPermissions::UPDATE) &&
            $user->id === $restaurantMenuItem->restaurant->user_id;
    }

    public function delete(User $user, RestaurantMenuItem $restaurantMenuItem): bool
    {
        if ($user->isSuperAdmin()) {
            return false;
        }

        return $user->can(RestaurantMenuItemPermissions::DELETE) &&
            $user->id === $restaurantMenuItem->restaurant->user_id;
    }
}
