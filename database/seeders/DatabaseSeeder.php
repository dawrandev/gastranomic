<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            LanguageSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,

            BrandSeeder::class,
            BrandTranslationSeeder::class,
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
