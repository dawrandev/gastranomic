<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            // Restaurant 1 items
            ['id' => 1, 'restaurant_id' => 1, 'menu_item_id' => 1, 'price' => 22000.00, 'created' => '2026-01-29 06:43:29'],
            ['id' => 2, 'restaurant_id' => 1, 'menu_item_id' => 2, 'price' => 23000.00, 'created' => '2026-01-29 06:44:39'],
            ['id' => 3, 'restaurant_id' => 1, 'menu_item_id' => 3, 'price' => 24000.00, 'created' => '2026-01-29 06:45:52'],
            ['id' => 4, 'restaurant_id' => 1, 'menu_item_id' => 4, 'price' => 250000.00, 'created' => '2026-01-29 06:46:35'],
            ['id' => 5, 'restaurant_id' => 1, 'menu_item_id' => 5, 'price' => 170000.00, 'created' => '2026-01-29 06:48:54'],
            ['id' => 6, 'restaurant_id' => 1, 'menu_item_id' => 6, 'price' => 110000.00, 'created' => '2026-01-29 06:49:21'],
            ['id' => 7, 'restaurant_id' => 1, 'menu_item_id' => 7, 'price' => 260000.00, 'created' => '2026-01-29 06:50:54'],
            ['id' => 8, 'restaurant_id' => 1, 'menu_item_id' => 8, 'price' => 270000.00, 'created' => '2026-01-29 06:52:19'],
            ['id' => 9, 'restaurant_id' => 1, 'menu_item_id' => 9, 'price' => 372000.00, 'created' => '2026-01-29 06:53:08'],

            // Restaurant 2 items
            ['id' => 10, 'restaurant_id' => 2, 'menu_item_id' => 10, 'price' => 33000.00, 'created' => '2026-01-29 07:06:44'],
            ['id' => 11, 'restaurant_id' => 2, 'menu_item_id' => 11, 'price' => 28000.00, 'created' => '2026-01-29 07:09:22'],
            ['id' => 12, 'restaurant_id' => 2, 'menu_item_id' => 12, 'price' => 37000.00, 'created' => '2026-01-29 07:11:48'],
            ['id' => 13, 'restaurant_id' => 2, 'menu_item_id' => 13, 'price' => 45000.00, 'created' => '2026-01-29 07:14:35'],
            ['id' => 14, 'restaurant_id' => 2, 'menu_item_id' => 14, 'price' => 65000.00, 'created' => '2026-01-29 07:16:05'],
            ['id' => 15, 'restaurant_id' => 2, 'menu_item_id' => 15, 'price' => 60000.00, 'created' => '2026-01-29 07:17:27'],
            ['id' => 16, 'restaurant_id' => 2, 'menu_item_id' => 16, 'price' => 50000.00, 'created' => '2026-01-29 07:19:37'],
            ['id' => 17, 'restaurant_id' => 2, 'menu_item_id' => 17, 'price' => 70000.00, 'created' => '2026-01-29 07:20:39'],
            ['id' => 18, 'restaurant_id' => 2, 'menu_item_id' => 18, 'price' => 29000.00, 'created' => '2026-01-29 07:22:06'],

            // Restaurant 4 items (Grand Lavash filiali)
            ['id' => 19, 'restaurant_id' => 4, 'menu_item_id' => 10, 'price' => 33000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 20, 'restaurant_id' => 4, 'menu_item_id' => 11, 'price' => 28000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 21, 'restaurant_id' => 4, 'menu_item_id' => 12, 'price' => 37000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 22, 'restaurant_id' => 4, 'menu_item_id' => 13, 'price' => 45000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 23, 'restaurant_id' => 4, 'menu_item_id' => 14, 'price' => 65000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 24, 'restaurant_id' => 4, 'menu_item_id' => 15, 'price' => 60000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 25, 'restaurant_id' => 4, 'menu_item_id' => 16, 'price' => 50000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 26, 'restaurant_id' => 4, 'menu_item_id' => 17, 'price' => 70000.00, 'created' => '2026-01-29 07:26:28'],
            ['id' => 27, 'restaurant_id' => 4, 'menu_item_id' => 18, 'price' => 29000.00, 'created' => '2026-01-29 07:26:28'],
        ];

        foreach ($links as $link) {
            DB::table('restaurant_menu_items')->updateOrInsert(
                ['id' => $link['id']],
                [
                    'restaurant_id' => $link['restaurant_id'],
                    'menu_item_id'   => $link['menu_item_id'],
                    'price'          => $link['price'],
                    'is_available'   => 1,
                    'created_at'     => $link['created'],
                    'updated_at'     => $link['created'],
                ]
            );
        }
    }
}
