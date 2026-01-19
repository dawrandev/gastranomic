<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $allPermissions = array_merge(
            \App\Permissions\RestaurantPermissions::all(),
            \App\Permissions\BrandPermissions::all(),
            \App\Permissions\CategoryPermissions::all()
        );

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $superadmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);

        $adminPermissions = [
            \App\Permissions\RestaurantPermissions::VIEW,
            \App\Permissions\RestaurantPermissions::UPDATE,
            \App\Permissions\RestaurantPermissions::EDIT,
            \App\Permissions\RestaurantPermissions::CREATE,
            \App\Permissions\RestaurantPermissions::DELETE,
            \App\Permissions\BrandPermissions::VIEW,
            \App\Permissions\BrandPermissions::VIEW_ANY,
            \App\Permissions\CategoryPermissions::VIEW,
            \App\Permissions\CategoryPermissions::VIEW_ANY
        ];

        $admin->syncPermissions($adminPermissions);
    }
}
