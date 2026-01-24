<?php

namespace App\Policies;

use App\Models\MenuSection;
use App\Models\User;
use App\Permissions\MenuSectionPermissions;

class MenuSectionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(MenuSectionPermissions::VIEW_ANY);
    }

    public function view(User $user, MenuSection $menuSection): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can(MenuSectionPermissions::VIEW) &&
            $user->brand_id === $menuSection->brand_id;
    }

    public function create(User $user): bool
    {
        return $user->can(MenuSectionPermissions::CREATE);
    }

    public function update(User $user, MenuSection $menuSection): bool
    {
        if ($user->isSuperAdmin()) {
            return false;
        }

        return $user->can(MenuSectionPermissions::UPDATE) &&
            $user->brand_id === $menuSection->brand_id;
    }

    public function delete(User $user, MenuSection $menuSection): bool
    {
        if ($user->isSuperAdmin()) {
            return false;
        }

        return $user->can(MenuSectionPermissions::DELETE) &&
            $user->brand_id === $menuSection->brand_id;
    }
}
