<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class ReviewQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Overall satisfaction
        $category1 = QuestionCategory::create([
            'key' => 'overall_satisfied',
            'sort_order' => 1,
            'is_required' => true,
            'is_active' => true,
        ]);

        $category1->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Ulıwma alǵanda, barlıǵı sızge jaqtı ma?', 'description' => null],
            ['lang_code' => 'uz', 'title' => 'Umuman olganda, barchasi sizga yoqdimi?', 'description' => null],
            ['lang_code' => 'ru', 'title' => 'В целом всё понравилось?', 'description' => null],
            ['lang_code' => 'en', 'title' => 'Overall, did you like everything?', 'description' => null],
        ]);

        // 1A. Sub-question: What didn't you like? (rating <= 3)
        $category1a = QuestionCategory::create([
            'parent_category_id' => $category1->id,
            'key' => 'overall_satisfied_a',
            'sort_order' => 1,
            'is_required' => false,
            'is_active' => true,
            'allow_multiple' => true,
            'condition' => ['field' => 'rating', 'operator' => '<=', 'value' => 3],
        ]);

        $category1a->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Sizge ne únamaǵan?', 'description' => '(birewin yamasa birneshewin saylań)'],
            ['lang_code' => 'uz', 'title' => 'Sizga nima yoqmadi?', 'description' => '(birini yoki bir nechtasini tanlang)'],
            ['lang_code' => 'ru', 'title' => 'Что вам не понравилось?', 'description' => '(выберите одно или несколько)'],
            ['lang_code' => 'en', 'title' => 'What didn\'t you like?', 'description' => '(select one or more)'],
        ]);

        $options1a = [
            ['key' => 'slow_service', 'kk' => 'Ásta xızmet kórsetiw', 'uz' => 'Sekin xizmat ko\'rsatish', 'ru' => 'Медленное обслуживание', 'en' => 'Slow service'],
            ['key' => 'rude_staff', 'kk' => 'Dópı yamasa dıqqatsız xızmetkerler', 'uz' => 'Qo\'pol yoki e\'tiborsiz xodimlar', 'ru' => 'Грубый или невнимательный персонал', 'en' => 'Rude or inattentive staff'],
            ['key' => 'order_mistakes', 'kk' => 'Buyırtpadaǵı qátelikler', 'uz' => 'Buyurtmadagi xatolar', 'ru' => 'Ошибки в заказе', 'en' => 'Order mistakes'],
            ['key' => 'poor_cleanliness', 'kk' => 'Tazalıq jetkiliksiz (zal, stol, daret xana)', 'uz' => 'Tozalik yetarli emas (zal, stol, hojatxona)', 'ru' => 'Недостаточная чистота (зал, стол, туалет)', 'en' => 'Poor cleanliness (hall, table, restroom)'],
            ['key' => 'noisy_atmosphere', 'kk' => 'Shıwlı ortalıq (muzıka, basqa miymanlar)', 'uz' => 'Shovqinli muhit (musiqa, boshqa mehmonlar)', 'ru' => 'Шумная атмосфера (музыка, другие гости)', 'en' => 'Noisy atmosphere (music, other guests)'],
            ['key' => 'poor_lighting', 'kk' => 'Yaman jaqtılandırıw', 'uz' => 'Yomon yoritish tizimi', 'ru' => 'Плохое освещение', 'en' => 'Poor lighting'],
            ['key' => 'uncomfortable_seating', 'kk' => 'Noqulay otırǵıshlar yamasa stollardıń jaylasıwı', 'uz' => 'Noqulay o\'rindiqlar yoki stollarning joylashuvi', 'ru' => 'Неудобная посадка или расположение столов', 'en' => 'Uncomfortable seating or table arrangement'],
            ['key' => 'other', 'kk' => 'Basqa (jazıp kórsetiń)', 'uz' => 'Boshqa (yozib ko\'rsating)', 'ru' => 'Другое (напишите)', 'en' => 'Other (please specify)'],
        ];

        foreach ($options1a as $index => $optionData) {
            $option = QuestionOption::create([
                'questions_category_id' => $category1a->id,
                'key' => $optionData['key'],
                'sort_order' => $index,
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // 1B. Sub-question: What specifically caused dissatisfaction?
        $category1b = QuestionCategory::create([
            'parent_category_id' => $category1->id,
            'key' => 'overall_satisfied_b',
            'sort_order' => 2,
            'is_required' => false,
            'is_active' => true,
            'allow_multiple' => true,
            'condition' => ['field' => 'rating', 'operator' => '<=', 'value' => 3],
        ]);

        $category1b->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Anıq ne narazılıq keltirip shıǵardı?', 'description' => '(qosımsha anıqlamalar)'],
            ['lang_code' => 'uz', 'title' => 'Aynan nima norozilik keltirib chiqardi?', 'description' => '(qo\'shimcha tushuntirishlar)'],
            ['lang_code' => 'ru', 'title' => 'Что конкретно вызвало недовольство?', 'description' => '(дополнительные уточнения)'],
            ['lang_code' => 'en', 'title' => 'What specifically caused dissatisfaction?', 'description' => '(additional clarifications)'],
        ]);

        $options1b = [
            ['key' => 'food_drinks', 'kk' => 'Awqat / ishimlikler: dámi, sapası, temperaturası', 'uz' => 'Taom / ichimliklar: ta\'mi, sifati, harorati', 'ru' => 'Еда / напитки: вкус, качество, температура', 'en' => 'Food / drinks: taste, quality, temperature'],
            ['key' => 'waiting_time', 'kk' => 'Awqattı kútiw waqtı', 'uz' => 'Taomlarni kutish vaqti', 'ru' => 'Время ожидания блюд', 'en' => 'Dish waiting time'],
            ['key' => 'waiter_politeness', 'kk' => 'Ofitsianttıń kishipeyilligi', 'uz' => 'Ofitsiantning xushmuomalaligi', 'ru' => 'Вежливость официанта', 'en' => 'Waiter politeness'],
            ['key' => 'atmosphere_impression', 'kk' => 'Ortalıqtan ulıwma tásir', 'uz' => 'Muhitdan umumiy taassurot', 'ru' => 'Общее впечатление от атмосферы', 'en' => 'Overall atmosphere impression'],
            ['key' => 'price_quality', 'kk' => 'Baha hám sapa sáykesligi', 'uz' => 'Narx va sifat mutanosibligi', 'ru' => 'Соотношение цена/качество', 'en' => 'Price/quality ratio'],
        ];

        foreach ($options1b as $index => $optionData) {
            $option = QuestionOption::create([
                'questions_category_id' => $category1b->id,
                'key' => $optionData['key'],
                'sort_order' => $index,
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // 1C. Sub-question: What can be improved? (open text)
        $category1c = QuestionCategory::create([
            'parent_category_id' => $category1->id,
            'key' => 'overall_satisfied_c',
            'sort_order' => 3,
            'is_required' => false,
            'is_active' => true,
            'allow_multiple' => false,
            'condition' => ['field' => 'rating', 'operator' => '<=', 'value' => 3],
        ]);

        $category1c->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Neni jaqsılaw múmkin?', 'description' => '(qálewińizshe, erkin juwap)'],
            ['lang_code' => 'uz', 'title' => 'Nimani yaxshilash mumkin?', 'description' => '(ixtiyoriy, ochiq javob)'],
            ['lang_code' => 'ru', 'title' => 'Что можно улучшить?', 'description' => '(открытый вариант, опционально)'],
            ['lang_code' => 'en', 'title' => 'What can be improved?', 'description' => '(open-ended, optional)'],
        ]);

        // ========== HIGH RATING SUB-QUESTIONS (4-5) ==========

        // 1D. Sub-question: What did you like? (rating >= 4)
        $category1d = QuestionCategory::create([
            'parent_category_id' => $category1->id,
            'key' => 'overall_satisfied_high_a',
            'sort_order' => 4,
            'is_required' => false,
            'is_active' => true,
            'allow_multiple' => true,
            'condition' => ['field' => 'rating', 'operator' => '>=', 'value' => 4],
        ]);

        $category1d->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Sizge ne únaǵan?', 'description' => '(birewin yamasa birneshewin saylań)'],
            ['lang_code' => 'uz', 'title' => 'Sizga nima yoqdi?', 'description' => '(birini yoki bir nechtasini tanlang)'],
            ['lang_code' => 'ru', 'title' => 'Что вам понравилось?', 'description' => '(выберите одно или несколько)'],
            ['lang_code' => 'en', 'title' => 'What did you like?', 'description' => '(select one or more)'],
        ]);

        $options1d = [
            ['key' => 'taste_of_dishes', 'kk' => 'Awqatlardıń dámi', 'uz' => 'Taomlarning mazasi', 'ru' => 'Вкус блюд', 'en' => 'Taste of dishes'],
            ['key' => 'beautiful_presentation', 'kk' => 'Awqatlardıń ádemi bezetiliwi', 'uz' => 'Taomlarning chiroyli tortilishi', 'ru' => 'Красивое оформление блюд', 'en' => 'Beautiful presentation of dishes'],
            ['key' => 'polite_attentive_staff', 'kk' => 'Kishipeyil hám dıqqatlı xızmetkerler', 'uz' => 'Xushmuomala va e\'tiborli xodimlar', 'ru' => 'Вежливый и внимательный персонал', 'en' => 'Polite and attentive staff'],
            ['key' => 'fast_service', 'kk' => 'Tez xızmet kórsetiw', 'uz' => 'Tezkor xizmat ko\'rsatish', 'ru' => 'Быстрое обслуживание', 'en' => 'Fast service'],
            ['key' => 'comfortable_atmosphere', 'kk' => 'Shınnamlı ortalıq', 'uz' => 'Shinam muhit', 'ru' => 'Комфортная атмосфера', 'en' => 'Comfortable atmosphere'],
            ['key' => 'cleanliness_order', 'kk' => 'Tazalıq hám tártip', 'uz' => 'Tozalik va tartib', 'ru' => 'Чистота и порядок', 'en' => 'Cleanliness and order'],
            ['key' => 'convenient_location', 'kk' => 'Qulay jaylasıwı / interyer', 'uz' => 'Qulay joylashuv / interyer', 'ru' => 'Удобное расположение / интерьер', 'en' => 'Convenient location / interior'],
            ['key' => 'other', 'kk' => 'Basqa (jazıp kórsetiń)', 'uz' => 'Boshqa (yozib ko\'rsating)', 'ru' => 'Другое (напишите)', 'en' => 'Other (please specify)'],
        ];

        foreach ($options1d as $index => $optionData) {
            $option = QuestionOption::create([
                'questions_category_id' => $category1d->id,
                'key' => $optionData['key'],
                'sort_order' => $index,
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // 1E. Sub-question: What was particularly memorable?
        $category1e = QuestionCategory::create([
            'parent_category_id' => $category1->id,
            'key' => 'overall_satisfied_high_b',
            'sort_order' => 5,
            'is_required' => false,
            'is_active' => true,
            'allow_multiple' => false,
            'condition' => ['field' => 'rating', 'operator' => '>=', 'value' => 4],
        ]);

        $category1e->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Aynan ne esińizde qaldı?', 'description' => '(erkin juwap)'],
            ['lang_code' => 'uz', 'title' => 'Aynan nima yodingizda qoldi?', 'description' => '(ochiq javob)'],
            ['lang_code' => 'ru', 'title' => 'Что особенно запомнилось?', 'description' => '(открытый вариант)'],
            ['lang_code' => 'en', 'title' => 'What was particularly memorable?', 'description' => '(open-ended)'],
        ]);

        // 1F. Sub-question: Improvement even if good
        $category1f = QuestionCategory::create([
            'parent_category_id' => $category1->id,
            'key' => 'overall_satisfied_high_c',
            'sort_order' => 6,
            'is_required' => false,
            'is_active' => true,
            'allow_multiple' => false,
            'condition' => ['field' => 'rating', 'operator' => '>=', 'value' => 4],
        ]);

        $category1f->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Ulıwma hámme zat únaǵan bolsa da, neni jaqsılawǵa bolar edi?', 'description' => '(erkin juwap)'],
            ['lang_code' => 'uz', 'title' => 'Umuman hammasi yoqqan bo\'lsa-da, nimani yaxshilash mumkin edi?', 'description' => '(ochiq javob)'],
            ['lang_code' => 'ru', 'title' => 'Что можно было бы улучшить, даже если в целом всё понравилось?', 'description' => '(открытый вариант)'],
            ['lang_code' => 'en', 'title' => 'What could be improved even though overall it was good?', 'description' => '(open-ended)'],
        ]);

        // 2. Visit category
        $category2 = QuestionCategory::create([
            'key' => 'visit_category',
            'sort_order' => 2,
            'is_required' => false,
            'is_active' => true,
        ]);

        $category2->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Siz kelsiw ushın qaysı kategoriyanı belgilegen bolar edińiz?', 'description' => null],
            ['lang_code' => 'uz', 'title' => 'Siz kelish uchun qaysi kategoriyani belgilagan bo‘lar edingiz?', 'description' => null],
            ['lang_code' => 'ru', 'title' => 'Какую категорию вы бы выделили для посещения?', 'description' => null],
            ['lang_code' => 'en', 'title' => 'Which category would you highlight for a visit?', 'description' => null],
        ]);

        $options2 = [
            ['key' => 'breakfast', 'kk' => 'Erteńgi awqat', 'uz' => 'Nonushta', 'ru' => 'Завтрак', 'en' => 'Breakfast'],
            ['key' => 'lunch',     'kk' => 'Lanch (túslik)', 'uz' => 'Tushlik (lanch)',  'ru' => 'Ланч',    'en' => 'Lunch'],
            ['key' => 'dinner',    'kk' => 'Keshki awqat',  'uz' => 'Kechki ovqat', 'ru' => 'Ужин', 'en' => 'Dinner'],
            ['key' => 'coffee',    'kk' => 'Kofe',          'uz' => 'Kofe',     'ru' => 'Кофе',    'en' => 'Coffee'],
            ['key' => 'dessert',   'kk' => 'Desert',        'uz' => 'Desert',   'ru' => 'Десерт',  'en' => 'Dessert'],
            ['key' => 'other',     'kk' => 'Basqa',         'uz' => 'Boshqa',   'ru' => 'Другое',  'en' => 'Other'],
        ];

        foreach ($options2 as $index => $optionData) {
            $option = QuestionOption::create([
                'questions_category_id' => $category2->id,
                'key' => $optionData['key'],
                'sort_order' => $index,
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // 3. Would you return again?
        $category3 = QuestionCategory::create([
            'key' => 'would_return_again',
            'sort_order' => 3,
            'is_required' => false,
            'is_active' => true,
        ]);

        $category3->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Bul restoranǵa jáne kelesiz be?', 'description' => null],
            ['lang_code' => 'uz', 'title' => 'Ushbu restoranga yana kelasizmi?', 'description' => null],
            ['lang_code' => 'ru', 'title' => 'Вернётесь ли вы снова в этот ресторан?', 'description' => null],
            ['lang_code' => 'en', 'title' => 'Will you return to this restaurant again?', 'description' => null],
        ]);

        $options3 = [
            ['key' => 'yes',   'kk' => 'Awa',     'uz' => 'Ha',      'ru' => 'Да',       'en' => 'Yes'],
            ['key' => 'maybe', 'kk' => 'Múmkin',  'uz' => 'Ehtimol', 'ru' => 'Возможно', 'en' => 'Maybe'],
            ['key' => 'no',    'kk' => 'Yaq',     'uz' => 'Yo‘q',    'ru' => 'Нет',      'en' => 'No'],
        ];

        foreach ($options3 as $index => $optionData) {
            $option = QuestionOption::create([
                'questions_category_id' => $category3->id,
                'key' => $optionData['key'],
                'sort_order' => $index,
                'is_active' => true,
            ]);

            $option->translations()->createMany([
                ['lang_code' => 'kk', 'text' => $optionData['kk']],
                ['lang_code' => 'uz', 'text' => $optionData['uz']],
                ['lang_code' => 'ru', 'text' => $optionData['ru']],
                ['lang_code' => 'en', 'text' => $optionData['en']],
            ]);
        }

        // 4. Additional comments
        $category4 = QuestionCategory::create([
            'key' => 'additional_comments',
            'sort_order' => 4,
            'is_required' => false,
            'is_active' => true,
        ]);

        $category4->translations()->createMany([
            ['lang_code' => 'kk', 'title' => 'Qosımsha pikir qaldırıwdı qaleysiz be?', 'description' => null],
            ['lang_code' => 'uz', 'title' => 'Qo‘shimcha fikr qoldirishni xohlaysizmi?', 'description' => null],
            ['lang_code' => 'ru', 'title' => 'Хотите оставить дополнительные комментарии?', 'description' => null],
            ['lang_code' => 'en', 'title' => 'Would you like to leave additional comments?', 'description' => null],
        ]);
    }
}
