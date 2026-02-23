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
        // Question Category 1: Overall satisfaction - Open-ended (no options)
        $category1 = QuestionCategory::create([
            'key' => 'overall_satisfied',
            'sort_order' => 1,
            'is_required' => true,
            'is_active' => true,
        ]);

        $category1->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Jemay hammasi sizge jaqpadımı?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Umuman hammasi sizga yoqqadimi?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'В целом всё понравилось?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'Overall, did you like everything?',
                'description' => null,
            ],
        ]);

        // Question Category 2: Visit category
        $category2 = QuestionCategory::create([
            'key' => 'visit_category',
            'sort_order' => 2,
            'is_required' => false,
            'is_active' => true,
        ]);

        $category2->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Qanday kategoriyani tashlawshı?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Qaysi kategoriya uchun tafsiya bergan bo\'lardingiz?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Какую категорию вы бы выделили для посещения?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'Which category would you recommend visiting?',
                'description' => null,
            ],
        ]);

        $options2 = [
            ['key' => 'breakfast', 'kk' => 'Tangilik', 'uz' => 'Nonushta', 'ru' => 'Завтрак', 'en' => 'Breakfast'],
            ['key' => 'lunch', 'kk' => 'Tushlik', 'uz' => 'Tushlik', 'ru' => 'Ланч', 'en' => 'Lunch'],
            ['key' => 'dinner', 'kk' => 'Kesh', 'uz' => 'Kechki ovqat', 'ru' => 'Ужин', 'en' => 'Dinner'],
            ['key' => 'coffee', 'kk' => 'Kofe', 'uz' => 'Kofe', 'ru' => 'Кофе', 'en' => 'Coffee'],
            ['key' => 'dessert', 'kk' => 'Turımtay', 'uz' => 'Qandolat', 'ru' => 'Десерт', 'en' => 'Dessert'],
            ['key' => 'other', 'kk' => 'Basqa', 'uz' => 'Boshqasi', 'ru' => 'Другое', 'en' => 'Other'],
        ];

        foreach ($options2 as $optionData) {
            $key = $optionData['key'];
            $option = QuestionOption::create([
                'questions_category_id' => $category2->id,
                'key' => $key,
                'sort_order' => array_search($optionData, $options2),
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // Question Category 3: Would you return again?
        $category3 = QuestionCategory::create([
            'key' => 'would_return_again',
            'sort_order' => 3,
            'is_required' => false,
            'is_active' => true,
        ]);

        $category3->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Qaytadan oshinsa kelesizbemi?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Yana bu restoranga kelasizmi?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Вернётесь ли вы снова в этот ресторан?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'Will you visit this restaurant again?',
                'description' => null,
            ],
        ]);

        $options3 = [
            ['key' => 'yes', 'kk' => 'Ha', 'uz' => 'Ha', 'ru' => 'Да', 'en' => 'Yes'],
            ['key' => 'maybe', 'kk' => 'Mumkin', 'uz' => 'Ehtimol', 'ru' => 'Возможно', 'en' => 'Maybe'],
            ['key' => 'no', 'kk' => 'Joq', 'uz' => 'Yo\'q', 'ru' => 'Нет', 'en' => 'No'],
        ];

        foreach ($options3 as $optionData) {
            $key = $optionData['key'];
            $option = QuestionOption::create([
                'questions_category_id' => $category3->id,
                'key' => $key,
                'sort_order' => array_search($optionData, $options3),
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // Question Category 4: Additional comments - Open-ended (no options)
        $category4 = QuestionCategory::create([
            'key' => 'additional_comments',
            'sort_order' => 4,
            'is_required' => false,
            'is_active' => true,
        ]);

        $category4->translations()->createMany([
            [
                'lang_code' => 'kk',
                'title' => 'Qo\'shimsha fikir-mulohazalarni qoydirmoqchisiz?',
                'description' => null,
            ],
            [
                'lang_code' => 'uz',
                'title' => 'Qo\'shimcha izoh qoldirmoqchisiz?',
                'description' => null,
            ],
            [
                'lang_code' => 'ru',
                'title' => 'Хотите оставить дополнительные комментарии?',
                'description' => null,
            ],
            [
                'lang_code' => 'en',
                'title' => 'Would you like to leave additional comments?',
                'description' => null,
            ],
        ]);
    }
}
