<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\RestaurantPermissions;
use App\Permissions\BrandPermissions;
use App\Permissions\CategoryPermissions;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $allPermissionsList = array_merge(
            RestaurantPermissions::all(),
            BrandPermissions::all(),
            CategoryPermissions::all()
        );

        foreach ($allPermissionsList as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdminPermissions = array_merge(
            [
                RestaurantPermissions::VIEW,
                RestaurantPermissions::VIEW_ANY,
            ],
            BrandPermissions::all(),
            CategoryPermissions::all()
        );

        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $superadmin->syncPermissions($superAdminPermissions);

        // 4. Admin uchun ruxsatlar (Siz yozgan mantiq bo'yicha)
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $adminPermissions = [
            RestaurantPermissions::VIEW,
            RestaurantPermissions::UPDATE,
            RestaurantPermissions::EDIT,
            RestaurantPermissions::CREATE,
            RestaurantPermissions::DELETE,
            BrandPermissions::VIEW,
            BrandPermissions::VIEW_ANY,
            CategoryPermissions::VIEW,
            CategoryPermissions::VIEW_ANY
        ];

        $admin->syncPermissions($adminPermissions);
    }
}
