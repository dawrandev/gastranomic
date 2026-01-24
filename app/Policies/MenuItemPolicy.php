<?php

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\User;
use App\Permissions\MenuItemPermissions;

class MenuItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(MenuItemPermissions::VIEW_ANY);
    }

    public function view(User $user, MenuItem $menuItem): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can(MenuItemPermissions::VIEW) &&
            $user->brand_id === $menuItem->menuSection->brand_id;
    }

    public function create(User $user): bool
    {
        return $user->can(MenuItemPermissions::CREATE);
    }

    public function update(User $user, MenuItem $menuItem): bool
    {
        if ($user->isSuperAdmin()) {
            return false;
        }

        return $user->can(MenuItemPermissions::UPDATE) &&
            $user->brand_id === $menuItem->menuSection->brand_id;
    }

    public function delete(User $user, MenuItem $menuItem): bool
    {
        if ($user->isSuperAdmin()) {
            return false;
        }

        return $user->can(MenuItemPermissions::DELETE) &&
            $user->brand_id === $menuItem->menuSection->brand_id;
    }
}
