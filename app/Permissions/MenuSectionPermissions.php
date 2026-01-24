<?php

namespace App\Permissions;

class MenuSectionPermissions
{
    public const VIEW_ANY = 'view_any_menu_section';
    public const VIEW = 'view_menu_section';
    public const CREATE = 'create_menu_section';
    public const UPDATE = 'update_menu_section';
    public const DELETE = 'delete_menu_section';

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
