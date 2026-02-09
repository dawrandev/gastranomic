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
        // 1. Kategoriyalar ro'yxati
        $categories = [
            [
                'id' => 2,
                'icon' => 'categories/icons/uFeu7gxFPZglDIVw59sj496AgiGaAPOnjOgQRXbP.png',
                'created_at' => '2026-01-29 06:55:27',
                'updated_at' => '2026-01-29 06:55:27',
                'translations' => [
                    ['code' => 'kk', 'name' => 'Fast Food'],
                    ['code' => 'uz', 'name' => 'Fast Food'],
                    ['code' => 'ru', 'name' => 'Фаст Фуд'],
                    ['code' => 'en', 'name' => 'Fast Food'],
                ]
            ],
            [
                'id' => 3,
                'icon' => 'categories/icons/zfztUKr3UN3ZFDUGFMQ6jWEPkHx6TixzTFaM2evu.png',
                'created_at' => '2026-01-29 07:29:21',
                'updated_at' => '2026-01-29 07:29:21',
                'translations' => [
                    ['code' => 'kk', 'name' => 'Restoran'],
                    ['code' => 'uz', 'name' => 'Restoran'],
                    ['code' => 'ru', 'name' => 'Ресторан'],
                    ['code' => 'en', 'name' => 'Restaurant'],
                ]
            ],
            [
                'id' => 4,
                'icon' => 'categories/icons/z9hDCF0Z2GC1iaTxAU52tCLTEfteJ1te4xJnbq93.png',
                'created_at' => '2026-01-29 07:34:42',
                'updated_at' => '2026-01-29 07:34:42',
                'translations' => [
                    ['code' => 'kk', 'name' => 'Kafe'],
                    ['code' => 'uz', 'name' => 'Kafe'],
                    ['code' => 'ru', 'name' => 'Кафе'],
                    ['code' => 'en', 'name' => 'Cafe'],
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

            // Tarjimalarni kiritish
            foreach ($catData['translations'] as $trans) {
                DB::table('category_translations')->updateOrInsert(
                    [
                        'category_id' => $catData['id'],
                        'code' => $trans['code']
                    ],
                    [
                        'name' => $trans['name'],
                        'created_at' => $catData['created_at'],
                        'updated_at' => $catData['updated_at'],
                    ]
                );
            }
        }
    }
}
