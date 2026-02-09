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
        // Create brands with their translations
        $brands = [
            [
                'name' => 'KFC',
                'logo' => null,
                'description' => 'Kentucky Fried Chicken',
                'translations' => [
                    'uz' => [
                        'name' => 'KFC',
                        'description' => 'Kentucky Qovurilgan Tovuq'
                    ],
                    'ru' => [
                        'name' => 'KFC',
                        'description' => 'Кентукки Жареная Курица'
                    ],
                    'kk' => [
                        'name' => 'KFC',
                        'description' => 'Кентукки Қуырылған Тауық'
                    ],
                    'en' => [
                        'name' => 'KFC',
                        'description' => 'Kentucky Fried Chicken'
                    ],
                ],
            ],
            [
                'name' => 'McDonald\'s',
                'logo' => null,
                'description' => 'Fast food restaurant chain',
                'translations' => [
                    'uz' => [
                        'name' => 'McDonald\'s',
                        'description' => 'Tez ovqatlanish restoran tarmog\'i'
                    ],
                    'ru' => [
                        'name' => 'McDonald\'s',
                        'description' => 'Сеть ресторанов быстрого питания'
                    ],
                    'kk' => [
                        'name' => 'McDonald\'s',
                        'description' => 'Тез тамақтану мекемелер желісі'
                    ],
                    'en' => [
                        'name' => 'McDonald\'s',
                        'description' => 'Fast food restaurant chain'
                    ],
                ],
            ],
            [
                'name' => 'Osh Markazi',
                'logo' => null,
                'description' => 'Traditional Uzbek cuisine',
                'translations' => [
                    'uz' => [
                        'name' => 'Osh Markazi',
                        'description' => 'An\'anaviy o\'zbek oshxonasi'
                    ],
                    'ru' => [
                        'name' => 'Центр Плова',
                        'description' => 'Традиционная узбекская кухня'
                    ],
                    'kk' => [
                        'name' => 'Ош Орталығы',
                        'description' => 'Дәстүрлі өзбек асханасы'
                    ],
                    'en' => [
                        'name' => 'Osh Center',
                        'description' => 'Traditional Uzbek cuisine'
                    ],
                ],
            ],
            [
                'name' => 'City Cafe',
                'logo' => null,
                'description' => 'Modern cafe chain',
                'translations' => [
                    'uz' => [
                        'name' => 'City Cafe',
                        'description' => 'Zamonaviy kafe tarmog\'i'
                    ],
                    'ru' => [
                        'name' => 'City Cafe',
                        'description' => 'Современная сеть кафе'
                    ],
                    'kk' => [
                        'name' => 'City Cafe',
                        'description' => 'Заманауи кафе желісі'
                    ],
                    'en' => [
                        'name' => 'City Cafe',
                        'description' => 'Modern cafe chain'
                    ],
                ],
            ],
        ];

        foreach ($brands as $brandData) {
            // Create brand
            $brand = Brand::firstOrCreate(
                ['name' => $brandData['name']],
                [
                    'logo' => $brandData['logo'],
                    'description' => $brandData['description'],
                ]
            );

            // Create translations for the brand
            foreach ($brandData['translations'] as $code => $translation) {
                BrandTranslation::updateOrCreate(
                    [
                        'brand_id' => $brand->id,
                        'code' => $code,
                    ],
                    [
                        'name' => $translation['name'],
                        'description' => $translation['description'],
                    ]
                );
            }
        }

        $this->command->info('Brand translations created successfully!');
    }
}
