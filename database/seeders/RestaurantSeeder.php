<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Restoranlar ma'lumotlari
        $restaurants = [
            [
                'id' => 1,
                'user_id' => 2,
                'brand_id' => 1,
                'city_id' => 1,
                'branch_name' => 'Cake Bumer №1',
                'phone' => '990137757',
                'address' => 'Толепберген Кайипбергенов 54, Nukus',
                'location' => '0101000000d05128fe48ce4d4066df5c236d3b4540',
                'is_active' => 1,
                'qr_code' => 'qrcodes/restaurant_1_1769683577.svg',
                'created_at' => '2026-01-29 05:46:17',
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'brand_id' => 2,
                'city_id' => 1,
                'branch_name' => 'Grand Lavash Main',
                'phone' => '+998612006622',
                'address' => 'J. Aymurzaev kóshesi',
                'location' => '0101000000b01ec29fa5ce4d40056af5be1d3c4540',
                'is_active' => 1,
                'qr_code' => 'qrcodes/restaurant_2_1769688170.svg',
                'created_at' => '2026-01-29 07:02:50',
            ],
            [
                'id' => 4,
                'user_id' => 3,
                'brand_id' => 2,
                'city_id' => 1,
                'branch_name' => 'Grand Lavash 26',
                'phone' => '+998612006622',
                'address' => 'Bilimler gúzari, 3',
                'location' => '0101000000839e415989cb4d40fa454162043c4540',
                'is_active' => 1,
                'qr_code' => 'qrcodes/restaurant_4_1769689588.svg',
                'created_at' => '2026-01-29 07:26:28',
            ],
            [
                'id' => 5,
                'user_id' => 4,
                'brand_id' => 3,
                'city_id' => 1,
                'branch_name' => 'Neo',
                'phone' => '+998551100003',
                'address' => 'Sabira Kamalova kóshesi, 21',
                'location' => '01010000006f13798f2dce4d4028fe0151e33a4540',
                'is_active' => 1,
                'qr_code' => 'qrcodes/restaurant_5_1769689939.svg',
                'created_at' => '2026-01-29 07:32:19',
            ],
            [
                'id' => 6,
                'user_id' => 5,
                'brand_id' => 4,
                'city_id' => 1,
                'branch_name' => 'Qaraqalpaǵım 1-filial',
                'phone' => '+998999567007',
                'address' => 'Máteke Jumanazarov kóshesi',
                'location' => '010100000062f2d7719fce4d404dc49c759d3c4540',
                'is_active' => 1,
                'qr_code' => 'qrcodes/restaurant_6_1769690319.svg',
                'created_at' => '2026-01-29 07:38:39',
            ],
        ];

        // 2. Restoranlarni kiritish
        foreach ($restaurants as $res) {
            DB::table('restaurants')->updateOrInsert(
                ['id' => $res['id']],
                [
                    'user_id'     => $res['user_id'],
                    'brand_id'    => $res['brand_id'],
                    'city_id'     => $res['city_id'],
                    'branch_name' => $res['branch_name'],
                    'phone'       => $res['phone'],
                    'address'     => $res['address'],
                    // Hex formatini Point-ga o'tkazamiz
                    'location'    => DB::raw("ST_GeomFromWKB(X'{$res['location']}')"),
                    'is_active'   => $res['is_active'],
                    'qr_code'     => $res['qr_code'],
                    'created_at'  => $res['created_at'],
                    'updated_at'  => $res['created_at'],
                ]
            );
        }

        $images = [
            ['id' => 1, 'restaurant_id' => 1, 'image_path' => 'restaurants/lFgMSQy2xCoqlzc2gCFseF96EIivzfvCKLuHznBs.jpg', 'is_cover' => 1, 'created' => '2026-01-29 05:46:17'],
            ['id' => 2, 'restaurant_id' => 1, 'image_path' => 'restaurants/EyVxQvwVJpzas0b23Lx5kvcb8q8f61jsF7iB2ff1.jpg', 'is_cover' => 0, 'created' => '2026-01-29 05:46:17'],
            ['id' => 3, 'restaurant_id' => 1, 'image_path' => 'restaurants/vSlst4OMwBJV57XR0QgjX2y5lp831v3SeaBrsBbi.jpg', 'is_cover' => 0, 'created' => '2026-01-29 05:46:17'],
            ['id' => 4, 'restaurant_id' => 1, 'image_path' => 'restaurants/csy7Uqg3TvUxcNpc9TqU8xBI4bi18PuUePDdDqoj.jpg', 'is_cover' => 0, 'created' => '2026-01-29 05:46:17'],
            ['id' => 5, 'restaurant_id' => 2, 'image_path' => 'restaurants/6R0AptfDvQ4QZ5120W5S64Mvmzbi1aDm17yZqTA3.webp', 'is_cover' => 1, 'created' => '2026-01-29 07:02:50'],
            ['id' => 7, 'restaurant_id' => 2, 'image_path' => 'restaurants/t7uGLgUSn2COvwOGCWUqkCS0Ov2prH8yMVy5qSJG.webp', 'is_cover' => 0, 'created' => '2026-01-29 07:02:50'],
            ['id' => 9, 'restaurant_id' => 4, 'image_path' => 'restaurants/QQx9AwbRAJMJpWLpHNzY1tzPDbSxjK6pj7nkZLUn.webp', 'is_cover' => 1, 'created' => '2026-01-29 07:26:28'],
            ['id' => 10, 'restaurant_id' => 4, 'image_path' => 'restaurants/hhGBRJNHkOcZtBwzzplL5hTXiFI26xRVimQF26FU.webp', 'is_cover' => 0, 'created' => '2026-01-29 07:26:28'],
            ['id' => 11, 'restaurant_id' => 5, 'image_path' => 'restaurants/D00JeL1Hqo7JKFMrH2E9egRJwobUALgZcVZTfS9h.jpg', 'is_cover' => 1, 'created' => '2026-01-29 07:32:19'],
            ['id' => 12, 'restaurant_id' => 5, 'image_path' => 'restaurants/zVPtmdPjHJrQ1IcNf4TdGQoUIDQ1e0bcdnOfcZA9.jpg', 'is_cover' => 0, 'created' => '2026-01-29 07:32:19'],
            ['id' => 13, 'restaurant_id' => 5, 'image_path' => 'restaurants/5USXt7WhKQ3EhozX64FNqknPOdjTviNkVZx5gUKp.jpg', 'is_cover' => 0, 'created' => '2026-01-29 07:32:19'],
            ['id' => 14, 'restaurant_id' => 6, 'image_path' => 'restaurants/hFHCCkrSjoK4Qq2UnfGHvnnklNnJhqRlVILsTMuR.webp', 'is_cover' => 1, 'created' => '2026-01-29 07:38:39'],
            ['id' => 15, 'restaurant_id' => 6, 'image_path' => 'restaurants/wi9OG9vjDwreps2oB9j2iXnt3a1B42hVZAwCczIh.webp', 'is_cover' => 0, 'created' => '2026-01-29 07:38:39'],
        ];

        foreach ($images as $img) {
            DB::table('restaurant_images')->updateOrInsert(
                ['id' => $img['id']],
                [
                    'restaurant_id' => $img['restaurant_id'],
                    'image_path' => $img['image_path'],
                    'is_cover' => $img['is_cover'],
                    'is_active' => 1,
                    'created_at' => $img['created'],
                    'updated_at' => $img['created'],
                ]
            );
        }

        // 3. Restoran va Kategoriya bog'liqligi (Pivot table)
        $categories = [
            ['id' => 3, 'restaurant_id' => 2, 'category_id' => 2],
            ['id' => 4, 'restaurant_id' => 4, 'category_id' => 2],
            ['id' => 5, 'restaurant_id' => 5, 'category_id' => 3],
            ['id' => 6, 'restaurant_id' => 6, 'category_id' => 4],
        ];

        foreach ($categories as $pivot) {
            DB::table('restaurant_category')->updateOrInsert(
                ['id' => $pivot['id']],
                [
                    'restaurant_id' => $pivot['restaurant_id'],
                    'category_id'   => $pivot['category_id'],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );
        }
    }
}
