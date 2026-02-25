<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear all sessions when reseeding database
        $sessionPath = storage_path('framework/sessions');
        if (is_dir($sessionPath)) {
            $files = glob($sessionPath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }

        // Clear cache and config
        Artisan::call('cache:clear');
        Artisan::call('config:clear');

        $this->call([
            RolePermissionSeeder::class,
            LanguageSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,

            BrandSeeder::class,
            UserSeeder::class,

            RestaurantSeeder::class,
            OperatingHourSeeder::class,
            ReviewSeeder::class,
            ReviewQuestionsSeeder::class,

            MenuSectionSeeder::class,
            MenuItemSeeder::class,
            RestaurantMenuItemSeeder::class,

            MenuPermissionsSeeder::class,
            TestMenuSeeder::class,
        ]);
    }
}
