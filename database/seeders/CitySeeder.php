<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'id' => 1,
                'created_at' => '2026-01-29 05:44:04',
                'updated_at' => '2026-01-29 05:44:04',
                'translations' => [
                    ['code' => 'kk', 'name' => 'Nókis'],
                    ['code' => 'uz', 'name' => 'Nukus'],
                    ['code' => 'ru', 'name' => 'Нукус'],
                    ['code' => 'en', 'name' => 'Nukus'],
                ]
            ],
        ];

        foreach ($cities as $cityData) {
            DB::table('cities')->updateOrInsert(
                ['id' => $cityData['id']],
                [
                    'created_at' => $cityData['created_at'],
                    'updated_at' => $cityData['updated_at'],
                ]
            );

            foreach ($cityData['translations'] as $trans) {
                DB::table('city_translations')->updateOrInsert(
                    [
                        'city_id' => $cityData['id'],
                        'code' => $trans['code']
                    ],
                    [
                        'name' => $trans['name'],
                        'created_at' => $cityData['created_at'],
                        'updated_at' => $cityData['updated_at'],
                    ]
                );
            }
        }
    }
}
