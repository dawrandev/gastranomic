<?php

namespace App\Permissions;

class RestaurantMenuItemPermissions
{
    public const VIEW_ANY = 'view_any_restaurant_menu_item';
    public const VIEW = 'view_restaurant_menu_item';
    public const CREATE = 'create_restaurant_menu_item';
    public const UPDATE = 'update_restaurant_menu_item';
    public const DELETE = 'delete_restaurant_menu_item';

    public static function all(): array
    {
        return [
            self::VIEW_ANY,
            self::VIEW,
            self::CREATE,
            self::UPDATE,
            self::DELETE,
        ];
    }
}
