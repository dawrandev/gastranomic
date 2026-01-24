<?php

namespace Database\Seeders;

use App\Models\MenuSection;
use Illuminate\Database\Seeder;

class TestMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create menu sections for brand_id = 1 (Grand Lavash)
        $sections = [
            ['ru' => 'Салаты', 'uz' => 'Salatlar', 'en' => 'Salads', 'sort_order' => 1],
            ['ru' => 'Супы', 'uz' => 'Sho\'rvalar', 'en' => 'Soups', 'sort_order' => 2],
            ['ru' => 'Основные блюда', 'uz' => 'Asosiy taomlar', 'en' => 'Main Dishes', 'sort_order' => 3],
            ['ru' => 'Напитки', 'uz' => 'Ichimliklar', 'en' => 'Beverages', 'sort_order' => 4],
            ['ru' => 'Десерты', 'uz' => 'Shirinliklar', 'en' => 'Desserts', 'sort_order' => 5],
        ];

        foreach ($sections as $sectionData) {
            $section = MenuSection::create([
                'brand_id' => 1,
                'sort_order' => $sectionData['sort_order']
            ]);

            $section->translations()->create([
                'lang_code' => 'ru',
                'name' => $sectionData['ru']
            ]);

            $section->translations()->create([
                'lang_code' => 'uz',
                'name' => $sectionData['uz']
            ]);

            $section->translations()->create([
                'lang_code' => 'en',
                'name' => $sectionData['en']
            ]);
        }

        $this->command->info('Test menu sections created successfully for Grand Lavash!');
    }
}
