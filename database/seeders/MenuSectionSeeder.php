<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Menu Sections ma'lumotlari
        $sections = [
            [
                'id' => 1,
                'brand_id' => 1,
                'sort_order' => 1,
                'created_at' => '2026-01-29 05:47:14',
                'translations' => [
                    'kk' => 'Tortlar',
                    'uz' => 'Tortlar',
                    'ru' => 'Торты',
                    'en' => 'Cakes'
                ]
            ],
            [
                'id' => 2,
                'brand_id' => 1,
                'sort_order' => 2,
                'created_at' => '2026-01-29 06:26:40',
                'translations' => [
                    'kk' => 'Bólekli tortlar',
                    'uz' => 'Parchali tortlar',
                    'ru' => 'Кусок торты',
                    'en' => 'A piece of cake'
                ]
            ],
            [
                'id' => 3,
                'brand_id' => 1,
                'sort_order' => 3,
                'created_at' => '2026-01-29 06:33:12',
                'translations' => [
                    'kk' => 'Chizkeyk',
                    'uz' => 'Chizkeyk',
                    'ru' => 'Чизкейк',
                    'en' => 'Cheesecake'
                ]
            ],
            [
                'id' => 4,
                'brand_id' => 2,
                'sort_order' => 1,
                'created_at' => '2026-01-29 07:03:58',
                'translations' => [
                    'kk' => 'Lavash',
                    'uz' => 'Lavash',
                    'ru' => 'Лаваш',
                    'en' => 'Lavash'
                ]
            ],
            [
                'id' => 5,
                'brand_id' => 2,
                'sort_order' => 2,
                'created_at' => '2026-01-29 07:04:21',
                'translations' => [
                    'kk' => 'Kombo',
                    'uz' => 'Kombo',
                    'ru' => 'Комбо',
                    'en' => 'Kombo'
                ]
            ],
            [
                'id' => 6,
                'brand_id' => 2,
                'sort_order' => 3,
                'created_at' => '2026-01-29 07:04:47',
                'translations' => [
                    'kk' => 'Pitsa',
                    'uz' => 'Pitsa',
                    'ru' => 'Пицца',
                    'en' => 'Pizza'
                ]
            ],
        ];

        // 2. Bazaga kiritish mantiqi
        foreach ($sections as $section) {
            // Asosiy bo'limni kiritish
            DB::table('menu_sections')->updateOrInsert(
                ['id' => $section['id']],
                [
                    'brand_id'   => $section['brand_id'],
                    'sort_order' => $section['sort_order'],
                    'created_at' => $section['created_at'],
                    'updated_at' => $section['created_at'],
                ]
            );

            // Tarjimalarni kiritish
            foreach ($section['translations'] as $code => $name) {
                DB::table('menu_section_translations')->updateOrInsert(
                    [
                        'menu_section_id' => $section['id'],
                        'lang_code'       => $code
                    ],
                    [
                        'name'       => $name,
                        'created_at' => $section['created_at'],
                        'updated_at' => $section['created_at'],
                    ]
                );
            }
        }
    }
}
