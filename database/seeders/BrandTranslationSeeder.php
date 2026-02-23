<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandTranslation;
use Illuminate\Database\Seeder;

class BrandTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create translations for existing brands
        $brands = [
            [
                'id' => 1,
                'translations' => [
                    'uz' => [
                        'name' => 'Cake Bumer',
                        'description' => 'Mazali tort va shirinliklar'
                    ],
                    'ru' => [
                        'name' => 'Cake Bumer',
                        'description' => 'Роскошные десерты из свежих ингредиентов и сытный Fastfood'
                    ],
                    'kk' => [
                        'name' => 'Cake Bumer',
                        'description' => 'Nóhes ingridiyentterden jasalǵan sherli tort hám toy awqat'
                    ],
                    'en' => [
                        'name' => 'Cake Bumer',
                        'description' => 'Delicious cakes and pastries'
                    ],
                ],
            ],
            [
                'id' => 2,
                'translations' => [
                    'uz' => [
                        'name' => 'Grand Lavash',
                        'description' => 'Oshpaz lavash va mashhur taomlar'
                    ],
                    'ru' => [
                        'name' => 'Grand Lavash',
                        'description' => 'Лучший лаваш и традиционная кухня'
                    ],
                    'kk' => [
                        'name' => 'Grand Lavash',
                        'description' => 'Nókis qalasındaǵı eń mazalı fast food'
                    ],
                    'en' => [
                        'name' => 'Grand Lavash',
                        'description' => 'Premium lavash and traditional cuisine'
                    ],
                ],
            ],
            [
                'id' => 3,
                'translations' => [
                    'uz' => [
                        'name' => 'Neo',
                        'description' => 'Restoran, karaoke va dans maydoni'
                    ],
                    'ru' => [
                        'name' => 'Neo',
                        'description' => 'Ресторан • Караоке • Танцпол'
                    ],
                    'kk' => [
                        'name' => 'Neo',
                        'description' => 'Restoran, karaoke hám tans maydanı'
                    ],
                    'en' => [
                        'name' => 'Neo',
                        'description' => 'Restaurant • Karaoke • Dance floor'
                    ],
                ],
            ],
            [
                'id' => 4,
                'translations' => [
                    'uz' => [
                        'name' => 'Qaraqalpaǵım',
                        'description' => 'Samarqand shahar kafe'
                    ],
                    'ru' => [
                        'name' => 'Qaraqalpaǵım',
                        'description' => 'Каракалпагым Кафе'
                    ],
                    'kk' => [
                        'name' => 'Qaraqalpaǵım',
                        'description' => 'Qaraqalpaǵım kafe'
                    ],
                    'en' => [
                        'name' => 'Qaraqalpaǵım',
                        'description' => 'Qaraqalpaǵım Cafe'
                    ],
                ],
            ],
        ];

        foreach ($brands as $brandData) {
            // Create translations for existing brands
            foreach ($brandData['translations'] as $code => $translation) {
                BrandTranslation::updateOrCreate(
                    [
                        'brand_id' => $brandData['id'],
                        'lang_code' => $code,
                    ],
                    [
                        'name' => $translation['name'],
                        'description' => $translation['description'],
                    ]
                );
            }
        }
    }
}
