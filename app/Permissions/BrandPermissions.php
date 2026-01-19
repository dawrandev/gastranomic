<?php

namespace App\Permissions;


class BrandPermissions
{
    public const VIEW_ANY = 'brand-view';
    public const CREATE = 'brand-create';
    public const UPDATE = 'brand-update';
    public const DELETE = 'brand-delete';
    public const VIEW = 'view';

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
