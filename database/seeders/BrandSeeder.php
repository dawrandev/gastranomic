<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tranzaksiya ishlatish tavsiya etiladi: agar bir joyda xato bo'lsa, 
        // bazaga chala ma'lumot yozilmaydi.
        DB::transaction(function () {

            $brands = [
                [
                    'id' => 1,
                    'logo' => 'brands/logos/9HmgIpTfGmKI4lBDSltXtaYhuksoVlztGQpiO99F.png',
                    'created_at' => '2026-01-29 00:44:25',
                    'updated_at' => '2026-01-29 02:27:07',
                    'translations' => [
                        'uz' => ['name' => 'Cake Bumer', 'description' => 'Mazali tort va shirinliklar'],
                        'ru' => ['name' => 'Cake Bumer', 'description' => 'Роскошные десерты из свежих ингредиентов и сытный Fastfood'],
                        'kk' => ['name' => 'Cake Bumer', 'description' => 'Nóhes ingridiyentterden jasalǵan sherli tort hám toy awqat'],
                        'en' => ['name' => 'Cake Bumer', 'description' => 'Delicious cakes and pastries'],
                    ],
                ],
                [
                    'id' => 2,
                    'logo' => 'brands/logos/9jjJ4N0RZvydpA1eou2xHrJPS1shNs6WHyOcnc6v.png',
                    'created_at' => '2026-01-29 01:54:57',
                    'updated_at' => '2026-01-29 01:58:19',
                    'translations' => [
                        'uz' => ['name' => 'Grand Lavash', 'description' => 'Oshpaz lavash va mashhur taomlar'],
                        'ru' => ['name' => 'Grand Lavash', 'description' => 'Лучший лаваш и традиционная кухня'],
                        'kk' => ['name' => 'Grand Lavash', 'description' => 'Nókis qalasındaǵı eń mazalı fast food'],
                        'en' => ['name' => 'Grand Lavash', 'description' => 'Premium lavash and traditional cuisine'],
                    ],
                ],
                [
                    'id' => 3,
                    'logo' => 'brands/logos/9kRULfr5hKBKTDunjZEYBrNt1uYMa1fLu4jBpeSM.png',
                    'created_at' => '2026-01-29 02:28:58',
                    'updated_at' => '2026-01-29 02:28:58',
                    'translations' => [
                        'uz' => ['name' => 'Neo', 'description' => 'Restoran, karaoke va dans maydoni'],
                        'ru' => ['name' => 'Neo', 'description' => 'Ресторан • Караоке • Танцпол'],
                        'kk' => ['name' => 'Neo', 'description' => 'Restoran, karaoke hám tans maydanı'],
                        'en' => ['name' => 'Neo', 'description' => 'Restaurant • Karaoke • Dance floor'],
                    ],
                ],
                [
                    'id' => 4,
                    'logo' => 'brands/logos/ag61sJUwjBLn3AeDgLkOaXHcbiR6IUVoRPgr0BsI.png',
                    'created_at' => '2026-01-29 02:35:18',
                    'updated_at' => '2026-01-29 02:35:18',
                    'translations' => [
                        'uz' => ['name' => 'Qaraqalpaǵım', 'description' => 'Samarqand shahar kafe'],
                        'ru' => ['name' => 'Qaraqalpaǵım', 'description' => 'Каракалпагым Кафе'],
                        'kk' => ['name' => 'Qaraqalpaǵım', 'description' => 'Qaraqalpaǵım kafe'],
                        'en' => ['name' => 'Qaraqalpaǵım', 'description' => 'Qaraqalpaǵım Cafe'],
                    ],
                ],
            ];

            foreach ($brands as $brandData) {
                // 1. Brendni yaratish yoki yangilash
                $brand = Brand::updateOrCreate(
                    ['id' => $brandData['id']],
                    [
                        'logo' => $brandData['logo'],
                        'created_at' => $brandData['created_at'],
                        'updated_at' => $brandData['updated_at'],
                    ]
                );

                // 2. Tarjimalarni yaratish yoki yangilash
                foreach ($brandData['translations'] as $code => $translation) {
                    BrandTranslation::updateOrCreate(
                        [
                            'brand_id' => $brand->id,
                            'lang_code' => $code,
                        ],
                        [
                            'name' => $translation['name'],
                            'description' => $translation['description'],
                        ]
                    );
                }
            }
        });
    }
}
