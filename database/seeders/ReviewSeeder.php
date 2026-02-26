<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\QuestionOption;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all options grouped by question
        $allOptions = QuestionOption::with('questionCategory')->get();

        // 25 ta review: 5 ta har bir restoranga
        // Restaurant IDs: 1, 2, 4, 5, 6
        $reviews = [
            // RESTORAN 1 - Cake Bumer №1 (5 ta review)
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Juda zo\'r restoran! Taomlar mazali, atmosfera chiroyli.',
                    'ru' => 'Отличный ресторан! Вкусная еда, уютная атмосфера.',
                    'kk' => 'Ótken restorani! Dámi tamaq, qulay atmosfera.',
                    'en' => 'Excellent restaurant! Delicious food, cozy atmosphere.'
                ],
                'phone' => '+998901234001',
                'option_ids' => [14, 16, 18, 22]  // taste, staff, comfort, breakfast
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Yaxshi xizmat va tezkor jihozlar. Baho bir oz yuqori.',
                    'ru' => 'Хороший сервис и быстрое обслуживание. Цена немного высокая.',
                    'kk' => 'Jaqsi xyzmet jáne tez qyzmet körsetuw. Baha bir az jóqary.',
                    'en' => 'Good service and quick delivery. Price is a bit high.'
                ],
                'phone' => '+998901234002',
                'option_ids' => [17, 20, 23]  // fast service, location, lunch
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'O\'rtacha. Xizmat yaxshi, ammo taom bir oz saliq edi.',
                    'ru' => 'Средне. Сервис хороший, но еда слегка холодная.',
                    'kk' => 'Ortashá. Xyzmet jaqsi, bírem tamaq bir az suwıq edi.',
                    'en' => 'Average. Service is good, but food was a bit cold.'
                ],
                'phone' => '+998901234003',
                'option_ids' => [1, 2, 25]  // low rating: slow service, rude staff, coffee
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Hammasini yoqdi! Tazalik, yangi taomlar, mohirlar.',
                    'ru' => 'Все понравилось! Чистота, свежие блюда, профессионалы.',
                    'kk' => 'Hamnasi unaǵan! Tazalıq, jáńa tamaqlar, biliki.',
                    'en' => 'I loved everything! Cleanliness, fresh dishes, professionals.'
                ],
                'phone' => '+998901234004',
                'option_ids' => [14, 15, 19, 28]  // taste, presentation, cleanliness, yes
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-5',
                'rating' => 2,
                'comments' => [
                    'uz' => 'Juda sariqo\'z xizmat. Qamoq uchun ko\'p pul olish.',
                    'ru' => 'Медленный сервис. Дорого за качество.',
                    'kk' => 'Asta xyzmet. Bahasına nisbattan qımmat.',
                    'en' => 'Slow service. Expensive for the quality.'
                ],
                'phone' => '+998901234005',
                'option_ids' => [1, 6, 13, 30]  // slow, poor cleanliness, price, no
            ],

            // RESTORAN 2 - Grand Lavash Main (5 ta review)
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Lavash bemalol! Yangi va toza, xizmat super!',
                    'ru' => 'Лаваш восхитительный! Свежий и чистый, сервис супер!',
                    'kk' => 'Lavash zeriksiń! Jáńa jáne taza, xyzmet super!',
                    'en' => 'Lavash is amazing! Fresh and clean, service is super!'
                ],
                'phone' => '+998901234010',
                'option_ids' => [14, 17, 19, 23]  // taste, service, cleanliness, lunch
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Yaxshi tanlovlar, tez tayyorlanadi, uyali xodimlar.',
                    'ru' => 'Хороший выбор, быстро готовят, вежливые сотрудники.',
                    'kk' => 'Jaqsi tanlawlar, tez tayarlanadi, sáwleli ishchilar.',
                    'en' => 'Good selection, quick preparation, polite employees.'
                ],
                'phone' => '+998901234011',
                'option_ids' => [16, 22, 25]  // staff, breakfast, coffee
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Narma-narma restoran. Yaxshi, lekin ko\'p tanlov yo\'q.',
                    'ru' => 'Обычный ресторан. Нормально, но не очень большой выбор.',
                    'kk' => 'Odday restoran. Normal, bírem ósi çoq emes.',
                    'en' => 'Regular restaurant. Okay, but not much selection.'
                ],
                'phone' => '+998901234012',
                'option_ids' => [5, 23]  // noisy, lunch
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Eng yaxshi lavash joylatuvchi! Qaytaman albatta.',
                    'ru' => 'Лучший лавашный ресторан! Вернусь обязательно.',
                    'kk' => 'Enmesi jaqsi lavash restoran! Jáne kelemen bilipsiz.',
                    'en' => 'Best lavash restaurant! I\'ll definitely return.'
                ],
                'phone' => '+998901234013',
                'option_ids' => [15, 18, 20, 28]  // presentation, comfort, location, yes
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-5',
                'rating' => 2,
                'comments' => [
                    'uz' => 'Lavash quruq edi. Sous yo\'q. Kechiktirilgan xizmat.',
                    'ru' => 'Лаваш сухой был. Соуса нет. Задержанный сервис.',
                    'kk' => 'Lavash quru edi. Sous joq. Gecikmegen xyzmet.',
                    'en' => 'Lavash was dry. No sauce. Delayed service.'
                ],
                'phone' => '+998901234014',
                'option_ids' => [3, 9, 13, 30]  // order mistake, food quality, price, no
            ],

            // RESTORAN 4 - Grand Lavash 26 (5 ta review)
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Yangi filial, hammasiga yaxshi! Clean va modernish!',
                    'ru' => 'Новый филиал, все хорошо! Чистый и современный!',
                    'kk' => 'Jáńa filial, hamnasi jaqsi! Taza jáne zamandas!',
                    'en' => 'New branch, everything is good! Clean and modern!'
                ],
                'phone' => '+998901234020',
                'option_ids' => [14, 19, 20, 24]  // taste, cleanliness, location, dinner
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Chiroyli ichki bezak, yaxshi ovqat, xizmat tez.',
                    'ru' => 'Красивый интерьер, хорошая еда, быстрый сервис.',
                    'kk' => 'Adem interer, jaqsi tamaq, tez xyzmet.',
                    'en' => 'Beautiful interior, good food, fast service.'
                ],
                'phone' => '+998901234021',
                'option_ids' => [15, 17, 22]  // presentation, service, breakfast
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Nomi nomi, lekin qiymati bir oz baland.',
                    'ru' => 'Хорошие названия, но цена немного завышена.',
                    'kk' => 'Jaqsi atalar, bírem baha bir az jóqary.',
                    'en' => 'Good names, but price is a bit overpriced.'
                ],
                'phone' => '+998901234022',
                'option_ids' => [2, 4, 23]  // rude staff, poor cleanliness, lunch
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Filialning eng yaxshisi! Tabriklaymiz jamiyatga!',
                    'ru' => 'Лучший из всех филиалов! Поздравляем команду!',
                    'kk' => 'Filialning enmesi jaqsisi! Kútelik komandaya!',
                    'en' => 'Best of all branches! Congratulations to the team!'
                ],
                'phone' => '+998901234023',
                'option_ids' => [16, 18, 21, 28]  // staff, comfort, good, yes
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-5',
                'rating' => 1,
                'comments' => [
                    'uz' => 'Hech qanday yaxshi narsa yo\'q. Pula ayb.',
                    'ru' => 'Ничего хорошего нет. Деньги впустую потрачены.',
                    'kk' => 'Hesh qanday jaqsi narsa joq. Pul bosqa sarpaladı.',
                    'en' => 'Nothing good. Money wasted.'
                ],
                'phone' => '+998901234024',
                'option_ids' => [1, 3, 5, 30]  // low: slow, mistakes, noise, no
            ],

            // RESTORAN 5 - Neo (5 ta review)
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Neo nomi talaasdagi! Zamonaviy, chiroyli, mazali!',
                    'ru' => 'Neo оправдывает название! Современный, красивый, вкусный!',
                    'kk' => 'Neo atlı talaasdın! Zamandas, adem, dámili!',
                    'en' => 'Neo lives up to its name! Modern, beautiful, tasty!'
                ],
                'phone' => '+998901234030',
                'option_ids' => [14, 15, 18, 26]  // taste, presentation, comfort, dessert
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Yaxshi joyda joylashgan, toza, professionali xizmat.',
                    'ru' => 'Хорошо расположен, чистый, профессиональный сервис.',
                    'kk' => 'Jaqsi ornında joylaskan, taza, professionaldy xyzmet.',
                    'en' => 'Well located, clean, professional service.'
                ],
                'phone' => '+998901234031',
                'option_ids' => [17, 20, 25]  // service, location, coffee
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Qiziqarli design, lekin qiymati qiymati yuqori.',
                    'ru' => 'Интересный дизайн, но цена довольно высокая.',
                    'kk' => 'Qaiziqtırıw dizayn, bírem baha jóqary.',
                    'en' => 'Interesting design, but the price is quite high.'
                ],
                'phone' => '+998901234032',
                'option_ids' => [6, 7, 24]  // poor lighting, uncomfortable seating, dinner
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Neo o\'z soʻz beradi! Yangi, zamonaviy, hamma yaxshi!',
                    'ru' => 'Neo свое слово держит! Новый, современный, все хорошо!',
                    'kk' => 'Neo óziniń sózi tutádi! Jáńa, zamandas, hamnasi jaqsi!',
                    'en' => 'Neo keeps its word! New, modern, everything is good!'
                ],
                'phone' => '+998901234033',
                'option_ids' => [16, 19, 21, 28]  // staff, cleanliness, good, yes
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-5',
                'rating' => 2,
                'comments' => [
                    'uz' => 'Zamonaviy lekin sovuq xizmat. Ovqat sifati pastroq.',
                    'ru' => 'Современный, но холодный сервис. Качество еды ниже.',
                    'kk' => 'Zamandas, bírem sowuq xyzmet. Tamaq sápasy tómen.',
                    'en' => 'Modern but cold service. Food quality is lower.'
                ],
                'phone' => '+998901234034',
                'option_ids' => [2, 9, 12, 29]  // rude staff, food quality, impression, maybe
            ],

            // RESTORAN 6 - Qaraqalpaǵım 1-filial (5 ta review)
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Qaraqalpak ovqatining asli! Ot chog\'ida tayyorlangan!',
                    'ru' => 'Настоящая каракалпакская еда! Готовится с душой!',
                    'kk' => 'Shınjılı qaraqalpaq tamağı! Júrek bilen tayarlanǵan!',
                    'en' => 'Real Karakalpak cuisine! Prepared with love!'
                ],
                'phone' => '+998901234040',
                'option_ids' => [14, 16, 19, 22]  // taste, staff, cleanliness, breakfast
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Mamlakatiy taom, yaxshi tadiga, qulay joyda.',
                    'ru' => 'Национальное блюдо, хороший вкус, удобное место.',
                    'kk' => 'Ellik tamaq, jaqsi dámi, qulay ornında.',
                    'en' => 'National dish, good taste, comfortable place.'
                ],
                'phone' => '+998901234041',
                'option_ids' => [15, 20, 27]  // presentation, location, other
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Taom yaxshi lekin atmosfera shovqinli edi.',
                    'ru' => 'Еда хорошая, но атмосфера шумная была.',
                    'kk' => 'Tamaq jaqsi, bírem atmosfera shovqınlı edi.',
                    'en' => 'Food is good, but atmosphere was noisy.'
                ],
                'phone' => '+998901234042',
                'option_ids' => [5, 8, 23]  // noise, other reasons, lunch
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Haqiqiy qaraqalpak roh! Bevosita vatanning ta\'mi!',
                    'ru' => 'Истинный каракалпакский дух! Вкус родины!',
                    'kk' => 'Shınjılı qaraqalpaq pnewmasy! Watannıń dámi!',
                    'en' => 'True Karakalpak spirit! Taste of homeland!'
                ],
                'phone' => '+998901234043',
                'option_ids' => [14, 18, 21, 28]  // taste, comfort, good, yes
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-5',
                'rating' => 1,
                'comments' => [
                    'uz' => 'Nomi yaxshi lekin ta\'mi yo\'q. Pul bosganda!',
                    'ru' => 'Название хорошее, но вкуса нет. Деньги даром!',
                    'kk' => 'Atı jaqsi, bírem dámi joq. Pul bosdań!',
                    'en' => 'Good name, but no taste. Money wasted!'
                ],
                'phone' => '+998901234044',
                'option_ids' => [1, 4, 10, 30]  // slow, cleanliness, wait time, no
            ],
        ];

        // Create reviews
        foreach ($reviews as $index => $reviewData) {
            $comments = $reviewData['comments'];
            $comment = $comments['ru']; // Default: Russian
            $phone = $reviewData['phone'] ?? null;
            $optionIds = $reviewData['option_ids'] ?? [];

            $review = Review::create([
                'restaurant_id' => $reviewData['restaurant_id'],
                'device_id' => $reviewData['device_id'],
                'ip_address' => '127.0.0.1',
                'rating' => $reviewData['rating'],
                'comment' => $comment,
                'phone' => $phone,
            ]);

            // Attach selected options
            if (!empty($optionIds)) {
                $review->selectedOptions()->sync($optionIds);
            }

            $this->command->info("✓ Review #{$review->id} created (Rating: {$review->rating}/5, Restaurant: {$reviewData['restaurant_id']})");
        }

        $this->command->info("\n✅ 25 ta testovyye otzivy muvaffaqiyatli yaratildi!");
    }
}
