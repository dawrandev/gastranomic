<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class ReviewQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Question Category A: What did you like?
        $categoryA = QuestionCategory::create([
            'key' => 'what_did_you_like',
            'sort_order' => 1,
            'is_required' => true,
            'is_active' => true,
        ]);

        $categoryA->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Sizge ne jaqpadı?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Sizga nima yoqqadi?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Что вам понравилось?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'What did you like?',
                'description' => null,
            ],
        ]);

        // Options for Category A
        $optionsA = [
            ['key' => 'good_service', 'kk' => 'Baqaw xızmet', 'uz' => 'Yaxshi xizmat', 'ru' => 'Хорошее обслуживание', 'en' => 'Good service'],
            ['key' => 'poor_service', 'kk' => 'Qolaylı emes xızmetkerler', 'uz' => 'Noqulay xizmat', 'ru' => 'Плохое обслуживание', 'en' => 'Poor service'],
            ['key' => 'poor_cleanliness', 'kk' => 'Jetkilikli tazalıq joq', 'uz' => 'Nopok tazolik', 'ru' => 'Плохая чистота', 'en' => 'Poor cleanliness'],
            ['key' => 'order_errors', 'kk' => 'Buyırtpada qáteler', 'uz' => 'Buyurtmada xatolar', 'ru' => 'Ошибки в заказе', 'en' => 'Order errors'],
            ['key' => 'bad_presentation', 'kk' => 'Yamán jaritıw', 'uz' => 'Yomon taqdim etish', 'ru' => 'Плохое оформление', 'en' => 'Bad presentation'],
            ['key' => 'noisy_environment', 'kk' => 'Shawqınlı muxıt', 'uz' => 'Shovqinli muhit', 'ru' => 'Шумная атмосфера', 'en' => 'Noisy environment'],
            ['key' => 'uncomfortable_seating', 'kk' => 'Qolaylı emes orınlıqlar', 'uz' => 'Noqulay o\'rindiqlar', 'ru' => 'Неудобные сиденья', 'en' => 'Uncomfortable seating'],
        ];

        foreach ($optionsA as $optionData) {
            $key = $optionData['key'];
            $option = QuestionOption::create([
                'questions_category_id' => $categoryA->id,
                'key' => $key,
                'sort_order' => array_search($optionData, $optionsA),
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // Question Category B: What caused dissatisfaction?
        $categoryB = QuestionCategory::create([
            'key' => 'what_caused_dissatisfaction',
            'sort_order' => 2,
            'is_required' => false,
            'is_active' => true,
        ]);

        $categoryB->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Neni narazılıqqa sebep boldı?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Nima norozilikka sabab bo\'ldi?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Что вызвало недовольство?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'What caused dissatisfaction?',
                'description' => null,
            ],
        ]);

        // Options for Category B
        $optionsB = [
            ['key' => 'food_quality', 'kk' => 'Taam/ishimlik', 'uz' => 'Ovqat/ichimlik', 'ru' => 'Еда/напитки', 'en' => 'Food/drinks'],
            ['key' => 'taste_issue', 'kk' => 'dám', 'uz' => 'ta\'m', 'ru' => 'вкус', 'en' => 'taste'],
            ['key' => 'quality_issue', 'kk' => 'sapat', 'uz' => 'sifat', 'ru' => 'качество', 'en' => 'quality'],
            ['key' => 'temperature_issue', 'kk' => 'temperatura', 'uz' => 'temperatura', 'ru' => 'температура', 'en' => 'temperature'],
            ['key' => 'staff_responsibility', 'kk' => 'Xızmetkerdıń wájibliligı', 'uz' => 'Xodim mas\'uliyati', 'ru' => 'Ответственность персонала', 'en' => 'Staff responsibility'],
            ['key' => 'price_quality_ratio', 'kk' => 'Baha/sapat qatnası', 'uz' => 'Narx/sifat nisbati', 'ru' => 'Соотношение цена/качество', 'en' => 'Price/quality ratio'],
            ['key' => 'overall_environment', 'kk' => 'Muxıttıń ulıwma tásiri', 'uz' => 'Muhitning umumiy ta\'siri', 'ru' => 'Общее впечатление от атмосферы', 'en' => 'Overall environment'],
            ['key' => 'wait_time', 'kk' => 'Taamdı kútiw waqtı', 'uz' => 'Ovqatni kutish vaqti', 'ru' => 'Время ожидания', 'en' => 'Wait time'],
        ];

        foreach ($optionsB as $optionData) {
            $key = $optionData['key'];
            $option = QuestionOption::create([
                'questions_category_id' => $categoryB->id,
                'key' => $key,
                'sort_order' => array_search($optionData, $optionsB),
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // Question Category C: What meal category did you order?
        $categoryC = QuestionCategory::create([
            'key' => 'meal_category',
            'sort_order' => 3,
            'is_required' => false,
            'is_active' => true,
        ]);

        $categoryC->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Qanday kategoriyani ajratasiz?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Qanday kategoriyani tanladingiz?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Какую категорию вы выбрали?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'What meal category did you order?',
                'description' => null,
            ],
        ]);

        // Options for Category C (meal types)
        $optionsC = [
            ['key' => 'breakfast', 'kk' => 'Taňgilik', 'uz' => 'Nonushta', 'ru' => 'Завтрак', 'en' => 'Breakfast'],
            ['key' => 'lunch', 'kk' => 'Gúnortag', 'uz' => 'Tushlik', 'ru' => 'Обед', 'en' => 'Lunch'],
            ['key' => 'dinner', 'kk' => 'Kesh', 'uz' => 'Kechki ovqat', 'ru' => 'Ужин', 'en' => 'Dinner'],
            ['key' => 'snacks', 'kk' => 'Araqashılıqlar', 'uz' => 'Yumshoqlar', 'ru' => 'Закуски', 'en' => 'Snacks'],
            ['key' => 'desserts', 'kk' => 'Turımtay', 'uz' => 'Qandolat', 'ru' => 'Десерты', 'en' => 'Desserts'],
            ['key' => 'beverages', 'kk' => 'Ishimlikler', 'uz' => 'Ichimliklar', 'ru' => 'Напитки', 'en' => 'Beverages'],
        ];

        foreach ($optionsC as $optionData) {
            $key = $optionData['key'];
            $option = QuestionOption::create([
                'questions_category_id' => $categoryC->id,
                'key' => $key,
                'sort_order' => array_search($optionData, $optionsC),
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // Question Category D: Would you come back?
        $categoryD = QuestionCategory::create([
            'key' => 'would_return',
            'sort_order' => 4,
            'is_required' => false,
            'is_active' => true,
        ]);

        $categoryD->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Qaytadan kelesizbemi?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Yana kelasizmi?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Вы вернетесь к нам?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'Would you visit us again?',
                'description' => null,
            ],
        ]);

        // Options for Category D
        $optionsD = [
            ['key' => 'definitely_yes', 'kk' => 'Barılıq', 'uz' => 'Aniq ha', 'ru' => 'Определенно да', 'en' => 'Definitely yes'],
            ['key' => 'probably', 'kk' => 'Múmkin', 'uz' => 'Mumkin', 'ru' => 'Возможно', 'en' => 'Maybe'],
            ['key' => 'probably_not', 'kk' => 'Mumkin emes', 'uz' => 'Ehtimol yo\'q', 'ru' => 'Вряд ли', 'en' => 'Probably not'],
            ['key' => 'definitely_no', 'kk' => 'Joq', 'uz' => 'Katigiy yo\'q', 'ru' => 'Определенно нет', 'en' => 'Definitely not'],
        ];

        foreach ($optionsD as $optionData) {
            $key = $optionData['key'];
            $option = QuestionOption::create([
                'questions_category_id' => $categoryD->id,
                'key' => $key,
                'sort_order' => array_search($optionData, $optionsD),
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }
    }
}
