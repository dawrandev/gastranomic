<?php

namespace App\Permissions;


class BrandPermissions
{
    public const VIEW_ANY = 'view_any_brand';
    public const VIEW = 'view_brand';
    public const CREATE = 'create_brand';
    public const UPDATE = 'update_brand';
    public const DELETE = 'delete_brand';

    public static function all(): array
    {
        return [
            self::VIEW_ANY,
            self::CREATE,
            self::UPDATE,
            self::DELETE,
            self::VIEW
        ];
    }
}
