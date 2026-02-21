<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 2,
                'icon' => 'categories/icons/uFeu7gxFPZglDIVw59sj496AgiGaAPOnjOgQRXbP.png',
                'created_at' => '2026-01-29 06:55:27',
                'updated_at' => '2026-01-29 06:55:27',
                'translations' => [
                    ['code' => 'uz', 'name' => 'Fast Food', 'desc' => 'Tezkor, mazali va to‘yimli tanovul.'],
                    ['code' => 'ru', 'name' => 'Фаст Фуд', 'desc' => 'Быстрый, вкусный и сытный перекус.'],
                    ['code' => 'en', 'name' => 'Fast Food', 'desc' => 'Quick, delicious and satisfying meals.'],
                    ['code' => 'kk', 'name' => 'Fast Food', 'desc' => 'Tez, dámli hám toyımlı awqatlar.'],
                ]
            ],
            [
                'id' => 3,
                'icon' => 'categories/icons/zfztUKr3UN3ZFDUGFMQ6jWEPkHx6TixzTFaM2evu.png',
                'created_at' => '2026-01-29 07:29:21',
                'updated_at' => '2026-01-29 07:29:21',
                'translations' => [
                    ['code' => 'uz', 'name' => 'Restoran', 'desc' => 'Oliy darajadagi xizmat va nafis ta’mlar.'],
                    ['code' => 'ru', 'name' => 'Ресторан', 'desc' => 'Высокий сервис и изысканные вкусы.'],
                    ['code' => 'en', 'name' => 'Restaurant', 'desc' => 'Premium service and exquisite flavors.'],
                    ['code' => 'kk', 'name' => 'Restoran', 'desc' => 'Joqarı dárejeli xizmet hám názik dámler.'],
                ]
            ],
            [
                'id' => 4,
                'icon' => 'categories/icons/z9hDCF0Z2GC1iaTxAU52tCLTEfteJ1te4xJnbq93.png',
                'created_at' => '2026-01-29 07:34:42',
                'updated_at' => '2026-01-29 07:34:42',
                'translations' => [
                    ['code' => 'uz', 'name' => 'Kafe', 'desc' => 'Qaynoq qahva va sokin muhit.'],
                    ['code' => 'ru', 'name' => 'Кафе', 'desc' => 'Горячий кофе и уютная атмосфера.'],
                    ['code' => 'en', 'name' => 'Cafe', 'desc' => 'Hot coffee and cozy atmosphere.'],
                    ['code' => 'kk', 'name' => 'Kafe', 'desc' => 'Issı kofe hám tınısh ortalıq.'],
                ]
            ],
        ];

        foreach ($categories as $catData) {
            DB::table('categories')->updateOrInsert(
                ['id' => $catData['id']],
                [
                    'icon' => $catData['icon'],
                    'created_at' => $catData['created_at'],
                    'updated_at' => $catData['updated_at'],
                ]
            );

            foreach ($catData['translations'] as $trans) {
                DB::table('category_translations')->updateOrInsert(
                    [
                        'category_id' => $catData['id'],
                        'lang_code' => $trans['code']
                    ],
                    [
                        'name' => $trans['name'],
                        'description' => $trans['desc'], // Description maydoni qo'shildi
                        'created_at' => $catData['created_at'],
                        'updated_at' => $catData['updated_at'],
                    ]
                );
            }
        }
    }
}
