<?php

namespace App\Permissions;

class CategoryPermissions
{
    public const VIEW_ANY = 'view_any_category';
    public const VIEW = 'view_category';
    public const CREATE = 'create_category';
    public const UPDATE = 'update_category';
    public const DELETE = 'delete_category';

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
