<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Asosiy taomlar ma'lumotlari
        $menuItems = [
            ['id' => 1, 'menu_section_id' => 2, 'image_path' => 'menu-items/BGG54pXqzzPHzZe7znht9d2qV76nwKoqLHVpb3Uu.webp', 'base_price' => 22000.00, 'weight' => null],
            ['id' => 2, 'menu_section_id' => 2, 'image_path' => 'menu-items/sYkvPnATqOiMNmcNFStyWwosBmFUfVYNY7kmbRqF.webp', 'base_price' => 23000.00, 'weight' => null],
            ['id' => 3, 'menu_section_id' => 2, 'image_path' => 'menu-items/WdR7iU7OevcCga4vM3nYqKri4QtxI5q1k8DWJ837.webp', 'base_price' => 24000.00, 'weight' => null],
            ['id' => 4, 'menu_section_id' => 1, 'image_path' => 'menu-items/0JQgyshAo0eNGBmNd5wM4bfvP5VVMpmNQHxMBhLA.webp', 'base_price' => 250000.00, 'weight' => null],
            ['id' => 5, 'menu_section_id' => 1, 'image_path' => 'menu-items/blM0C4yrFjwUjmX4GFYlT19xPM3jxu9iZKxRtmGb.webp', 'base_price' => 170000.00, 'weight' => null],
            ['id' => 6, 'menu_section_id' => 1, 'image_path' => 'menu-items/IO7ijbXmbYc8sBC2riT4r1s4CrSHlq5sYzcOrN1s.webp', 'base_price' => 110000.00, 'weight' => null],
            ['id' => 7, 'menu_section_id' => 3, 'image_path' => 'menu-items/LVc0TKKvXmSBXsS6JLYK5VGKeVeL8kOI4ABUEP2B.webp', 'base_price' => 260000.00, 'weight' => null],
            ['id' => 8, 'menu_section_id' => 3, 'image_path' => 'menu-items/aFlwtZB8PQVpQRUBFcnakZ1KsnTvG5ztXtIZY4wk.webp', 'base_price' => 270000.00, 'weight' => null],
            ['id' => 9, 'menu_section_id' => 3, 'image_path' => 'menu-items/0o7aUeiKf0DGBHJoBl0jRkNIjBGyPyjpoVYYovnk.webp', 'base_price' => 372000.00, 'weight' => null],
            ['id' => 10, 'menu_section_id' => 4, 'image_path' => 'menu-items/c9ErO6sQ5HmApR0c41bx2VKJaUewQOzY5WdhNEDT.jpg', 'base_price' => 33000.00, 'weight' => 350],
            ['id' => 11, 'menu_section_id' => 4, 'image_path' => 'menu-items/8rr9sPmPbvmYpbfpUblhN0ct947etSyeTCEwHYHu.webp', 'base_price' => 28000.00, 'weight' => 200],
            ['id' => 12, 'menu_section_id' => 4, 'image_path' => 'menu-items/GD4CDtw96QQUHyPrpi4G5UCVeeLHnTHZwmIX1hOC.webp', 'base_price' => 37000.00, 'weight' => 348],
            ['id' => 13, 'menu_section_id' => 6, 'image_path' => 'menu-items/pi1ZsbDqngjgzOaphGOqv3ARLkxz43A7kBbwQXrh.webp', 'base_price' => 45000.00, 'weight' => null],
            ['id' => 14, 'menu_section_id' => 6, 'image_path' => 'menu-items/P5l4qfiSzt8vLknBAv4rFVvBQExwBKagKTX4EUaY.webp', 'base_price' => 65000.00, 'weight' => null],
            ['id' => 15, 'menu_section_id' => 6, 'image_path' => 'menu-items/RYlU6F0slla5iwlvDhar6HjIo7Aq07C3LwHdJ3O5.webp', 'base_price' => 60000.00, 'weight' => null],
            ['id' => 16, 'menu_section_id' => 5, 'image_path' => 'menu-items/pdXfSolYJeDuHBQSKc0pTy4t0iO1JeQBCZqvKOze.webp', 'base_price' => 50000.00, 'weight' => null],
            ['id' => 17, 'menu_section_id' => 5, 'image_path' => 'menu-items/7VjZ2XTz8jC8u769QjaKeQEv1iAhY6tsVcN0NT3L.webp', 'base_price' => 70000.00, 'weight' => 520],
            ['id' => 18, 'menu_section_id' => 5, 'image_path' => 'menu-items/74LlI3XZbON3ql7rGPgJmH323VI51JlUgjUxSnpn.webp', 'base_price' => 29000.00, 'weight' => 200],
        ];

        foreach ($menuItems as $item) {
            DB::table('menu_items')->updateOrInsert(
                ['id' => $item['id']],
                [
                    'menu_section_id' => $item['menu_section_id'],
                    'image_path'      => $item['image_path'],
                    'base_price'      => $item['base_price'],
                    'weight'          => $item['weight'],
                    'created_at'      => '2026-01-29 06:43:29',
                    'updated_at'      => '2026-01-29 06:43:29',
                ]
            );
        }

        // 2. Taomlar tarjimalari (Barcha 72 ta qator)
        $translations = [
            // ID 1
            ['id' => 1, 'menu_item_id' => 1, 'lang_code' => 'kk', 'name' => 'Brown', 'description' => null],
            ['id' => 2, 'menu_item_id' => 1, 'lang_code' => 'uz', 'name' => 'Brown', 'description' => null],
            ['id' => 3, 'menu_item_id' => 1, 'lang_code' => 'ru', 'name' => 'Броун', 'description' => null],
            ['id' => 4, 'menu_item_id' => 1, 'lang_code' => 'en', 'name' => 'Brown', 'description' => null],
            // ID 2
            ['id' => 5, 'menu_item_id' => 2, 'lang_code' => 'kk', 'name' => 'Bumer bólegi', 'description' => null],
            ['id' => 6, 'menu_item_id' => 2, 'lang_code' => 'uz', 'name' => 'Bumer parchasi', 'description' => null],
            ['id' => 7, 'menu_item_id' => 2, 'lang_code' => 'ru', 'name' => 'Бумер кусок', 'description' => null],
            ['id' => 8, 'menu_item_id' => 2, 'lang_code' => 'en', 'name' => 'Boomer piece', 'description' => null],
            // ID 3
            ['id' => 9, 'menu_item_id' => 3, 'lang_code' => 'kk', 'name' => 'General bólegi', 'description' => null],
            ['id' => 10, 'menu_item_id' => 3, 'lang_code' => 'uz', 'name' => 'General parchasi', 'description' => null],
            ['id' => 11, 'menu_item_id' => 3, 'lang_code' => 'ru', 'name' => 'Генерал кусок', 'description' => null],
            ['id' => 12, 'menu_item_id' => 3, 'lang_code' => 'en', 'name' => 'General piece', 'description' => null],
            // ID 4
            ['id' => 13, 'menu_item_id' => 4, 'lang_code' => 'kk', 'name' => 'Baby', 'description' => null],
            ['id' => 14, 'menu_item_id' => 4, 'lang_code' => 'uz', 'name' => 'Baby', 'description' => null],
            ['id' => 15, 'menu_item_id' => 4, 'lang_code' => 'ru', 'name' => 'Бейби', 'description' => null],
            ['id' => 16, 'menu_item_id' => 4, 'lang_code' => 'en', 'name' => 'Baby', 'description' => null],
            // ID 5
            ['id' => 17, 'menu_item_id' => 5, 'lang_code' => 'kk', 'name' => 'Barxat', 'description' => null],
            ['id' => 18, 'menu_item_id' => 5, 'lang_code' => 'uz', 'name' => 'Barxat', 'description' => null],
            ['id' => 19, 'menu_item_id' => 5, 'lang_code' => 'ru', 'name' => 'Barxat', 'description' => null],
            ['id' => 20, 'menu_item_id' => 5, 'lang_code' => 'en', 'name' => 'Barxat', 'description' => null],
            // ID 6
            ['id' => 21, 'menu_item_id' => 6, 'lang_code' => 'kk', 'name' => 'Bento', 'description' => null],
            ['id' => 22, 'menu_item_id' => 6, 'lang_code' => 'uz', 'name' => 'Bento', 'description' => null],
            ['id' => 23, 'menu_item_id' => 6, 'lang_code' => 'ru', 'name' => 'Бенто', 'description' => null],
            ['id' => 24, 'menu_item_id' => 6, 'lang_code' => 'en', 'name' => 'Bento', 'description' => null],
            // ID 7
            ['id' => 25, 'menu_item_id' => 7, 'lang_code' => 'kk', 'name' => 'Malinali Chizkeyk', 'description' => null],
            ['id' => 26, 'menu_item_id' => 7, 'lang_code' => 'uz', 'name' => 'Malinali Chizkeyk', 'description' => null],
            ['id' => 27, 'menu_item_id' => 7, 'lang_code' => 'ru', 'name' => 'Чизкейк Малиновый', 'description' => null],
            ['id' => 28, 'menu_item_id' => 7, 'lang_code' => 'en', 'name' => 'Raspberry Cheesecake', 'description' => null],
            // ID 8
            ['id' => 29, 'menu_item_id' => 8, 'lang_code' => 'kk', 'name' => 'Oreo Chizkeyk', 'description' => null],
            ['id' => 30, 'menu_item_id' => 8, 'lang_code' => 'uz', 'name' => 'Oreo Chizkeyk', 'description' => null],
            ['id' => 31, 'menu_item_id' => 8, 'lang_code' => 'ru', 'name' => 'Чизкейк Орео', 'description' => null],
            ['id' => 32, 'menu_item_id' => 8, 'lang_code' => 'en', 'name' => 'Oreo Cheesecake', 'description' => null],
            // ID 9
            ['id' => 33, 'menu_item_id' => 9, 'lang_code' => 'kk', 'name' => 'San Sebastian Chizkeyk', 'description' => null],
            ['id' => 34, 'menu_item_id' => 9, 'lang_code' => 'uz', 'name' => 'San Sebastian Chizkeyk', 'description' => null],
            ['id' => 35, 'menu_item_id' => 9, 'lang_code' => 'ru', 'name' => 'Чизкейк Сан-Себастьян', 'description' => null],
            ['id' => 36, 'menu_item_id' => 9, 'lang_code' => 'en', 'name' => 'San Sebastian Cheesecake', 'description' => null],
            // ID 10
            ['id' => 37, 'menu_item_id' => 10, 'lang_code' => 'kk', 'name' => 'Mal góshinnen úlken lavash', 'description' => 'Juqa lavashqa shireli hám mazalı mal góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı. Toyımlı hám ishtey ashıwshı awqat.'],
            ['id' => 38, 'menu_item_id' => 10, 'lang_code' => 'uz', 'name' => 'Mol góshtidan katta lavash', 'description' => 'Yupqa lavashga shirali va mazali mol go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi. To‘yimli va ishtahaochar taom.'],
            ['id' => 39, 'menu_item_id' => 10, 'lang_code' => 'ru', 'name' => 'Большой лаваш с говядиной', 'description' => 'Большой лаваш с сочной и ароматной говядиной, свежими овощами и фирменным соусом. Сытное и аппетитное блюдо.'],
            ['id' => 40, 'menu_item_id' => 10, 'lang_code' => 'en', 'name' => 'Large Beef Lavash', 'description' => 'Large lavash filled with juicy and flavorful beef, fresh vegetables, and a special sauce. A hearty and appetizing dish.'],
            // ID 11
            ['id' => 41, 'menu_item_id' => 11, 'lang_code' => 'kk', 'name' => 'Tawıq góshinen kishkene lavash', 'description' => 'Tandırda pisirilgen juqa lavashqa jumsaq hám shireli tawıq góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı. Jeńil, mazalı hám tez tayar bolatuǵın taǵam.'],
            ['id' => 42, 'menu_item_id' => 11, 'lang_code' => 'uz', 'name' => "Tovuq go'shtidan kichik lavash", 'description' => 'Tandirda pishirilgan yupqa lavashga yumshoq va shirali tovuq go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi. Yengil, mazali va tez tayyor bo‘ladigan taom.'],
            ['id' => 43, 'menu_item_id' => 11, 'lang_code' => 'ru', 'name' => 'Тандыр мини лаваш с курицей', 'description' => 'Мини-лаваш, приготовленный в тандыре, с нежным и сочным куриным мясом, свежими овощами и фирменным соусом. Лёгкое, вкусное и сытное блюдо.'],
            ['id' => 44, 'menu_item_id' => 11, 'lang_code' => 'en', 'name' => 'Mini tandoor lavash with chicken', 'description' => 'Mini tandoor-baked lavash filled with tender and juicy chicken, fresh vegetables, and a special sauce. A light, tasty, and satisfying dish.'],
            // ID 12
            ['id' => 45, 'menu_item_id' => 12, 'lang_code' => 'kk', 'name' => 'Tandırda pisirilgen úlken lavash mal góshi menen', 'description' => 'Tandırda pisirilgen juqa lavashqa shireli hám mazalı mal góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı. Júdá toyımlı hám ishtey ashıwshı awqat.'],
            ['id' => 46, 'menu_item_id' => 12, 'lang_code' => 'uz', 'name' => 'Tandirda pishirilgan katta lavash mol go‘shti bilan', 'description' => 'Tandirda pishirilgan yupqa lavashga shirali va mazali mol go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi. Juda to‘yimli va ishtahaochar taom.'],
            ['id' => 47, 'menu_item_id' => 12, 'lang_code' => 'ru', 'name' => 'Тандыр лаваш большой с говядиной', 'description' => 'Большой лаваш, приготовленный в тандыре, с сочной и ароматной говядиной, свежими овощами и фирменным соусом. Очень сытное и аппетитное блюдо.'],
            ['id' => 48, 'menu_item_id' => 12, 'lang_code' => 'en', 'name' => 'Large tandoor-baked lavash with beef', 'description' => 'Large tandoor-baked lavash filled with juicy and flavorful beef, fresh vegetables, and a special sauce. A hearty and satisfying dish.'],
            // ID 13
            ['id' => 49, 'menu_item_id' => 13, 'lang_code' => 'kk', 'name' => 'Vegetarian pitsa', 'description' => 'Pomidor sousı tiykarında tayarlanǵan vegetarianlıq pizza. Quramına mozzarella sırı, pomidor, bolgar burıshı, zamarrıq, zaytun hám xosh iyisli pripravalar qosıladı.'],
            ['id' => 50, 'menu_item_id' => 13, 'lang_code' => 'uz', 'name' => 'Vegetarian pitsa', 'description' => 'Pomidor sousi asosida tayyorlangan vegetarian pitsa. Tarkibiga mozzarella pishlog‘i, pomidor, bolgar qalampiri, qo‘ziqorin, zaytun va xushbo‘y ziravorlar qo‘shiladi.'],
            ['id' => 51, 'menu_item_id' => 13, 'lang_code' => 'ru', 'name' => 'Пицца вегетарианская', 'description' => 'Вегетарианская пицца на основе томатного соуса. В состав входят сыр моцарелла, помидоры, болгарский перец, шампиньоны, оливки и ароматные специи.'],
            ['id' => 52, 'menu_item_id' => 13, 'lang_code' => 'en', 'name' => 'Vegetarian pizza', 'description' => 'Vegetarian pizza made with a tomato sauce base. Topped with mozzarella cheese, tomatoes, bell peppers, mushrooms, olives, and aromatic spices.'],
            // ID 14
            ['id' => 53, 'menu_item_id' => 14, 'lang_code' => 'kk', 'name' => 'Assorti pitsa', 'description' => 'Pomidor sousı tiykarında tayarlanǵan assorti picası. Quramına mozzarella sırı, kolbasa, mal góshi, tawıq góshi, pomidor, bolgar burıshı, zamarrıq hám zaytun qosıladı.'],
            ['id' => 54, 'menu_item_id' => 14, 'lang_code' => 'uz', 'name' => 'Assorti pitsa', 'description' => 'Pomidor sousi asosida tayyorlangan assorti pitsa. Tarkibiga mozzarella pishlog‘i, kolbasa, mol go‘shti, tovuq go‘shti, pomidor, bolgar qalampiri, qo‘ziqorin va zaytun qo‘shiladi.'],
            ['id' => 55, 'menu_item_id' => 14, 'lang_code' => 'ru', 'name' => 'Пицца Ассорти', 'description' => 'Пицца ассорти на основе томатного соуса. В состав входят сыр моцарелла, колбаса, говядина, куриное мясо, помидоры, болгарский перец, шампиньоны и оливки.'],
            ['id' => 56, 'menu_item_id' => 14, 'lang_code' => 'en', 'name' => 'Assorted pizza', 'description' => 'Assorted pizza made with a tomato sauce base. Topped with mozzarella cheese, sausage, beef, chicken, tomatoes, bell peppers, mushrooms, and olives.'],
            // ID 15
            ['id' => 57, 'menu_item_id' => 15, 'lang_code' => 'kk', 'name' => 'Góshli pitsa', 'description' => 'Pomidor sousı tiykarında tayarlanǵan góshli picca. Quramına mozzarella sırı, mal góshi, tawıq góshi, kolbasa, piyaz hám xosh iyisli pripravalar qosıladı.'],
            ['id' => 58, 'menu_item_id' => 15, 'lang_code' => 'uz', 'name' => 'Go‘shtli pitsa', 'description' => 'Pomidor sousi asosida tayyorlangan go‘shtli pitsa. Tarkibiga mozzarella pishlog‘i, mol go‘shti, tovuq go‘shti, kolbasa, piyoz va xushbo‘y ziravorlar qo‘shiladi.'],
            ['id' => 59, 'menu_item_id' => 15, 'lang_code' => 'ru', 'name' => 'Пицца мясная', 'description' => 'Мясная пицца на основе томатного соуса. В состав входят сыр моцарелла, говядина, куриное мясо, колбаса, лук и ароматные специи.'],
            ['id' => 60, 'menu_item_id' => 15, 'lang_code' => 'en', 'name' => 'Meat pizza', 'description' => 'Meat pizza made with a tomato sauce base. Topped with mozzarella cheese, beef, chicken, sausage, onion, and aromatic spices.'],
            // ID 16
            ['id' => 61, 'menu_item_id' => 16, 'lang_code' => 'kk', 'name' => 'Lavash kombo', 'description' => null],
            ['id' => 62, 'menu_item_id' => 16, 'lang_code' => 'uz', 'name' => 'Lavash kombo', 'description' => null],
            ['id' => 63, 'menu_item_id' => 16, 'lang_code' => 'ru', 'name' => 'Лаваш Комбо', 'description' => null],
            ['id' => 64, 'menu_item_id' => 16, 'lang_code' => 'en', 'name' => 'Lavash Combo', 'description' => null],
            // ID 17
            ['id' => 65, 'menu_item_id' => 17, 'lang_code' => 'kk', 'name' => 'Palwan kombo', 'description' => null],
            ['id' => 66, 'menu_item_id' => 17, 'lang_code' => 'uz', 'name' => 'Polvon kombo', 'description' => null],
            ['id' => 67, 'menu_item_id' => 17, 'lang_code' => 'ru', 'name' => 'Палуан комбо', 'description' => null],
            ['id' => 68, 'menu_item_id' => 17, 'lang_code' => 'en', 'name' => 'Paluan kombo', 'description' => null],
            // ID 18
            ['id' => 69, 'menu_item_id' => 18, 'lang_code' => 'kk', 'name' => 'Balalar kombo', 'description' => null],
            ['id' => 70, 'menu_item_id' => 18, 'lang_code' => 'uz', 'name' => 'Bolalar Kombo', 'description' => null],
            ['id' => 71, 'menu_item_id' => 18, 'lang_code' => 'ru', 'name' => 'Детский комбо', 'description' => null],
            ['id' => 72, 'menu_item_id' => 18, 'lang_code' => 'en', 'name' => 'Kids Combo', 'description' => null],
        ];

        foreach ($translations as $trans) {
            DB::table('menu_item_translations')->updateOrInsert(
                ['id' => $trans['id']],
                [
                    'menu_item_id' => $trans['menu_item_id'],
                    'lang_code'    => $trans['lang_code'],
                    'name'         => $trans['name'],
                    'description'  => $trans['description'],
                    'created_at'   => '2026-01-29 06:43:29',
                    'updated_at'   => '2026-01-29 06:43:29',
                ]
            );
        }
    }
}
