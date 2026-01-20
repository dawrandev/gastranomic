<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['code' => 'kk', 'name' => 'Karakalpak'],
            ['code' => 'uz', 'name' => 'Uzbek'],
            ['code' => 'ru', 'name' => 'Russian'],
            ['code' => 'en', 'name' => 'English'],
        ];

        foreach ($languages as $language) {
            \App\Models\Language::create($language);
        }
    }
}
