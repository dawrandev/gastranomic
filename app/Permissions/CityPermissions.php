<?php

namespace App\Permissions;

class CityPermissions
{
    public const VIEW_ANY = 'view_any_city';
    public const VIEW = 'view_city';
    public const CREATE = 'create_city';
    public const UPDATE = 'update_city';
    public const DELETE = 'delete_city';

    public static function all(): array
    {
        return [
            self::VIEW_ANY,
            self::VIEW,
            self::CREATE,
            self::UPDATE,
            self::DELETE
        ];
    }
}
