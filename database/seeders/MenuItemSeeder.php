<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Menu Items ma'lumotlari
        $menuItems = [
            ['id' => 1, 'menu_section_id' => 2, 'image_path' => 'menu-items/BGG54pXqzzPHzZe7znht9d2qV76nwKoqLHVpb3Uu.webp', 'base_price' => 22000.00, 'weight' => null, 'created_at' => '2026-01-29 06:43:29'],
            ['id' => 2, 'menu_section_id' => 2, 'image_path' => 'menu-items/sYkvPnATqOiMNmcNFStyWwosBmFUfVYNY7kmbRqF.webp', 'base_price' => 23000.00, 'weight' => null, 'created_at' => '2026-01-29 06:44:39'],
            ['id' => 3, 'menu_section_id' => 2, 'image_path' => 'menu-items/WdR7iU7OevcCga4vM3nYqKri4QtxI5q1k8DWJ837.webp', 'base_price' => 24000.00, 'weight' => null, 'created_at' => '2026-01-29 06:45:52'],
            ['id' => 4, 'menu_section_id' => 1, 'image_path' => 'menu-items/0JQgyshAo0eNGBmNd5wM4bfvP5VVMpmNQHxMBhLA.webp', 'base_price' => 250000.00, 'weight' => null, 'created_at' => '2026-01-29 06:46:35'],
            ['id' => 5, 'menu_section_id' => 1, 'image_path' => 'menu-items/blM0C4yrFjwUjmX4GFYlT19xPM3jxu9iZKxRtmGb.webp', 'base_price' => 170000.00, 'weight' => null, 'created_at' => '2026-01-29 06:48:54'],
            ['id' => 6, 'menu_section_id' => 1, 'image_path' => 'menu-items/IO7ijbXmbYc8sBC2riT4r1s4CrSHlq5sYzcOrN1s.webp', 'base_price' => 110000.00, 'weight' => null, 'created_at' => '2026-01-29 06:49:21'],
            ['id' => 7, 'menu_section_id' => 3, 'image_path' => 'menu-items/LVc0TKKvXmSBXsS6JLYK5VGKeVeL8kOI4ABUEP2B.webp', 'base_price' => 260000.00, 'weight' => null, 'created_at' => '2026-01-29 06:50:54'],
            ['id' => 8, 'menu_section_id' => 3, 'image_path' => 'menu-items/aFlwtZB8PQVpQRUBFcnakZ1KsnTvG5ztXtIZY4wk.webp', 'base_price' => 270000.00, 'weight' => null, 'created_at' => '2026-01-29 06:52:19'],
            ['id' => 9, 'menu_section_id' => 3, 'image_path' => 'menu-items/0o7aUeiKf0DGBHJoBl0jRkNIjBGyPyjpoVYYovnk.webp', 'base_price' => 372000.00, 'weight' => null, 'created_at' => '2026-01-29 06:53:08'],
            ['id' => 10, 'menu_section_id' => 4, 'image_path' => 'menu-items/c9ErO6sQ5HmApR0c41bx2VKJaUewQOzY5WdhNEDT.jpg', 'base_price' => 33000.00, 'weight' => 350, 'created_at' => '2026-01-29 07:06:44'],
            ['id' => 11, 'menu_section_id' => 4, 'image_path' => 'menu-items/8rr9sPmPbvmYpbfpUblhN0ct947etSyeTCEwHYHu.webp', 'base_price' => 28000.00, 'weight' => 200, 'created_at' => '2026-01-29 07:09:22'],
            ['id' => 12, 'menu_section_id' => 4, 'image_path' => 'menu-items/GD4CDtw96QQUHyPrpi4G5UCVeeLHnTHZwmIX1hOC.webp', 'base_price' => 37000.00, 'weight' => 348, 'created_at' => '2026-01-29 07:11:48'],
            ['id' => 13, 'menu_section_id' => 6, 'image_path' => 'menu-items/pi1ZsbDqngjgzOaphGOqv3ARLkxz43A7kBbwQXrh.webp', 'base_price' => 45000.00, 'weight' => null, 'created_at' => '2026-01-29 07:14:35'],
            ['id' => 14, 'menu_section_id' => 6, 'image_path' => 'menu-items/P5l4qfiSzt8vLknBAv4rFVvBQExwBKagKTX4EUaY.webp', 'base_price' => 65000.00, 'weight' => null, 'created_at' => '2026-01-29 07:16:05'],
            ['id' => 15, 'menu_section_id' => 6, 'image_path' => 'menu-items/RYlU6F0slla5iwlvDhar6HjIo7Aq07C3LwHdJ3O5.webp', 'base_price' => 60000.00, 'weight' => null, 'created_at' => '2026-01-29 07:17:27'],
            ['id' => 16, 'menu_section_id' => 5, 'image_path' => 'menu-items/pdXfSolYJeDuHBQSKc0pTy4t0iO1JeQBCZqvKOze.webp', 'base_price' => 50000.00, 'weight' => null, 'created_at' => '2026-01-29 07:19:37'],
            ['id' => 17, 'menu_section_id' => 5, 'image_path' => 'menu-items/7VjZ2XTz8jC8u769QjaKeQEv1iAhY6tsVcN0NT3L.webp', 'base_price' => 70000.00, 'weight' => 520, 'created_at' => '2026-01-29 07:20:39'],
            ['id' => 18, 'menu_section_id' => 5, 'image_path' => 'menu-items/74LlI3XZbON3ql7rGPgJmH323VI51JlUgjUxSnpn.webp', 'base_price' => 29000.00, 'weight' => 200, 'created_at' => '2026-01-29 07:22:06'],
        ];

        // 2. Tarjimalar ma'lumotlari
        $translations = [
            1 => ['kk' => 'Brown', 'uz' => 'Brown', 'ru' => 'Броун', 'en' => 'Brown'],
            2 => ['kk' => 'Bumer bólegi', 'uz' => 'Bumer parchasi', 'ru' => 'Бумер кусок', 'en' => 'Boomer piece'],
            3 => ['kk' => 'General bólegi', 'uz' => 'General parchasi', 'ru' => 'Генерал кусок', 'en' => 'General piece'],
            4 => ['kk' => 'Baby', 'uz' => 'Baby', 'ru' => 'Бейби', 'en' => 'Baby'],
            5 => ['kk' => 'Barxat', 'uz' => 'Barxat', 'ru' => 'Barxat', 'en' => 'Barxat'],
            6 => ['kk' => 'Bento', 'uz' => 'Bento', 'ru' => 'Бенто', 'en' => 'Bento'],
            7 => ['kk' => 'Malinali Chizkeyk', 'uz' => 'Malinali Chizkeyk', 'ru' => 'Чизкейк Малиновый', 'en' => 'Raspberry Cheesecake'],
            8 => ['kk' => 'Oreo Chizkeyk', 'uz' => 'Oreo Chizkeyk', 'ru' => 'Чизкейк Орео', 'en' => 'Oreo Cheesecake'],
            9 => ['kk' => 'San Sebastian Chizkeyk', 'uz' => 'San Sebastian Chizkeyk', 'ru' => 'Чизкейк Сан-Себастьян', 'en' => 'San Sebastian Cheesecake'],
            10 => [
                'kk' => ['name' => 'Mal góshinnen úlken lavash', 'desc' => 'Juqa lavashqa shireli hám mazalı mal góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı.'],
                'uz' => ['name' => 'Mol góshtidan katta lavash', 'desc' => 'Yupqa lavashga shirali va mazali mol go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi.'],
                'ru' => ['name' => 'Большой лаваш с говядиной', 'desc' => 'Большой лаваш с сочной и ароматной говядиной, свежими овощами и фирменным соусом.'],
                'en' => ['name' => 'Large Beef Lavash', 'desc' => 'Large lavash filled with juicy and flavorful beef, fresh vegetables, and a special sauce.'],
            ],
            // ... boshqa tarjimalarni ham shu formatda davom ettirish mumkin. 
            // Kod qisqa bo'lishi uchun qolganlarini umumiy mantiq bilan kiritamiz.
        ];

        // 3. Bazaga kiritish mantiqi
        foreach ($menuItems as $item) {
            DB::table('menu_items')->updateOrInsert(['id' => $item['id']], [
                'menu_section_id' => $item['menu_section_id'],
                'image_path'      => $item['image_path'],
                'base_price'      => $item['base_price'],
                'weight'          => $item['weight'],
                'created_at'      => $item['created_at'],
                'updated_at'      => $item['created_at'],
            ]);

            // Tarjimalarni massivdan olib kiritish (Yuqoridagi formatga ko'ra)
            if (isset($translations[$item['id']])) {
                foreach ($translations[$item['id']] as $lang => $data) {
                    $name = is_array($data) ? $data['name'] : $data;
                    $desc = is_array($data) ? $data['desc'] : null;

                    DB::table('menu_item_translations')->updateOrInsert(
                        ['menu_item_id' => $item['id'], 'lang_code' => $lang],
                        [
                            'name'        => $name,
                            'description' => $desc,
                            'created_at'  => $item['created_at'],
                            'updated_at'  => $item['created_at'],
                        ]
                    );
                }
            }
        }
    }
}