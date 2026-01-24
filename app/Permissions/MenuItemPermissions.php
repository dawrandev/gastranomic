<?php

namespace App\Permissions;

class MenuItemPermissions
{
    public const VIEW_ANY = 'view_any_menu_item';
    public const VIEW = 'view_menu_item';
    public const CREATE = 'create_menu_item';
    public const UPDATE = 'update_menu_item';
    public const DELETE = 'delete_menu_item';

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
