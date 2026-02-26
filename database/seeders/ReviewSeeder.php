<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        // 25 ta review
        $reviews = [
            // RESTORAN 1 - Cake Bumer №1
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Juda zo\'r restoran! Taomlar mazali, atmosfera chiroyli.',
                    'ru' => 'Отличный ресторан! Вкусная еда, уютная атмосфера.',
                    'kk' => 'Ájayıp restoran! Awqatları dámli, ortalıǵı júdá shınnamlı.',
                    'en' => 'Excellent restaurant! Delicious food, cozy atmosphere.'
                ],
                'phone' => '+998901234001',
                'option_ids' => [14, 16, 18, 22]
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Yaxshi xizmat va tezkor jihozlar. Baho bir oz yuqori.',
                    'ru' => 'Хороший сервис и быстрое обслуживание. Цена немного высокая.',
                    'kk' => 'Xızmet kórsetiw jaqsı hám tez. Bahası bir az qımbatlaw.',
                    'en' => 'Good service and quick delivery. Price is a bit high.'
                ],
                'phone' => '+998901234002',
                'option_ids' => [17, 20, 23]
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'O\'rtacha. Xizmat yaxshi, ammo taom bir oz saliq edi.',
                    'ru' => 'Средне. Сервис хороший, но еда слегка холодная.',
                    'kk' => 'Ortasha. Xızmet jaqsı, biraq awqat sál suwıp qalǵan eken.',
                    'en' => 'Average. Service is good, but food was a bit cold.'
                ],
                'phone' => '+998901234003',
                'option_ids' => [1, 2, 25]
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Hammasini yoqdi! Tazalik, yangi taomlar, mohirlar.',
                    'ru' => 'Все понравилось! Чистота, свежие блюда, профессионалы.',
                    'kk' => 'Hámme zat únadı! Tazalıq, jańa pisken awqatlar, óz isiniń ustaları.',
                    'en' => 'I loved everything! Cleanliness, fresh dishes, professionals.'
                ],
                'phone' => '+998901234004',
                'option_ids' => [14, 15, 19, 28]
            ],
            [
                'restaurant_id' => 1,
                'device_id' => 'device-1-5',
                'rating' => 2,
                'comments' => [
                    'uz' => 'Juda sariqo\'z xizmat. Qamoq uchun ko\'p pul olish.',
                    'ru' => 'Медленный сервис. Дорого за качество.',
                    'kk' => 'Xızmet kórsetiw júdá áste. Sapasına qaraǵanda bahası qımbat.',
                    'en' => 'Slow service. Expensive for the quality.'
                ],
                'phone' => '+998901234005',
                'option_ids' => [1, 6, 13, 30]
            ],

            // RESTORAN 2 - Grand Lavash Main
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Lavash bemalol! Yangi va toza, xizmat super!',
                    'ru' => 'Лаваш восхитительный! Свежий и чистый, сервис супер!',
                    'kk' => 'Lavash júdá dámli! Jańa hám taza, xızmet kórsetiw aǵla!',
                    'en' => 'Lavash is amazing! Fresh and clean, service is super!'
                ],
                'phone' => '+998901234010',
                'option_ids' => [14, 17, 19, 23]
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Yaxshi tanlovlar, tez tayyorlanadi, uyali xodimlar.',
                    'ru' => 'Хороший выбор, быстро готовят, вежливые сотрудники.',
                    'kk' => 'Saylaw imkaniyatı kóp, tez tayarlaydı, xızmetkerleri kishipeyil.',
                    'en' => 'Good selection, quick preparation, polite employees.'
                ],
                'phone' => '+998901234011',
                'option_ids' => [16, 22, 25]
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Narma-narma restoran. Yaxshi, lekin ko\'p tanlov yo\'q.',
                    'ru' => 'Обычный ресторан. Нормально, но не очень большой выбор.',
                    'kk' => 'Ápiwayı restoran. Jaman emes, biraq as-máziyiri júdá bay emes.',
                    'en' => 'Regular restaurant. Okay, but not much selection.'
                ],
                'phone' => '+998901234012',
                'option_ids' => [5, 23]
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Eng yaxshi lavash joylatuvchi! Qaytaman albatta.',
                    'ru' => 'Лучший лавашный ресторан! Вернусь обязательно.',
                    'kk' => 'Eń jaqsı lavash orayı! Mine-mine jáne kelemen.',
                    'en' => 'Best lavash restaurant! I\'ll definitely return.'
                ],
                'phone' => '+998901234013',
                'option_ids' => [15, 18, 20, 28]
            ],
            [
                'restaurant_id' => 2,
                'device_id' => 'device-2-5',
                'rating' => 2,
                'comments' => [
                    'uz' => 'Lavash quruq edi. Sous yo\'q. Kechiktirilgan xizmat.',
                    'ru' => 'Лаваш сухой был. Соуса нет. Задержанный сервис.',
                    'kk' => 'Lavash qurǵaq eken. Sousı joq. Xızmet kórsetiw keshikti.',
                    'en' => 'Lavash was dry. No sauce. Delayed service.'
                ],
                'phone' => '+998901234014',
                'option_ids' => [3, 9, 13, 30]
            ],

            // RESTORAN 4 - Grand Lavash 26
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Yangi filial, hammasiga yaxshi! Clean va modernish!',
                    'ru' => 'Новый филиал, все хорошо! Чистый и современный!',
                    'kk' => 'Jańa filial, hámme zat jaqsı! Taza hám zamanagóy!',
                    'en' => 'New branch, everything is good! Clean and modern!'
                ],
                'phone' => '+998901234020',
                'option_ids' => [14, 19, 20, 24]
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Chiroyli ichki bezak, yaxshi ovqat, xizmat tez.',
                    'ru' => 'Красивый интерьер, хорошая еда, быстрый сервис.',
                    'kk' => 'Interyeri ádemi, awqatları jaqsı, xızmet tez.',
                    'en' => 'Beautiful interior, good food, fast service.'
                ],
                'phone' => '+998901234021',
                'option_ids' => [15, 17, 22]
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Nomi nomi, lekin qiymati bir oz baland.',
                    'ru' => 'Хорошие названия, но цена немного завышена.',
                    'kk' => 'Atı jaqsı-aw, biraq bahası sál qımbatıraq.',
                    'en' => 'Good names, but price is a bit overpriced.'
                ],
                'phone' => '+998901234022',
                'option_ids' => [2, 4, 23]
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Filialning eng yaxshisi! Tabriklaymiz jamiyatga!',
                    'ru' => 'Лучший из всех филиалов! Поздравляем команду!',
                    'kk' => 'Filiallardıń ishinde eń jaqsısı! Komandaǵa raxmet!',
                    'en' => 'Best of all branches! Congratulations to the team!'
                ],
                'phone' => '+998901234023',
                'option_ids' => [16, 18, 21, 28]
            ],
            [
                'restaurant_id' => 4,
                'device_id' => 'device-4-5',
                'rating' => 1,
                'comments' => [
                    'uz' => 'Hech qanday yaxshi narsa yo\'q. Pula ayb.',
                    'ru' => 'Ничего хорошего нет. Деньги впустую потрачены.',
                    'kk' => 'Hesh qanday jaqsı tárepi joq. Pul bosqa ketti.',
                    'en' => 'Nothing good. Money wasted.'
                ],
                'phone' => '+998901234024',
                'option_ids' => [1, 3, 5, 30]
            ],

            // RESTORAN 5 - Neo
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Neo nomi talaasdagi! Zamonaviy, chiroyli, mazali!',
                    'ru' => 'Neo оправдывает название! Современный, красивый, вкусный!',
                    'kk' => 'Neo óz atına múnasip! Zamanagóy, ádemi hám dámli!',
                    'en' => 'Neo lives up to its name! Modern, beautiful, tasty!'
                ],
                'phone' => '+998901234030',
                'option_ids' => [14, 15, 18, 26]
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Yaxshi joyda joylashgan, toza, professionali xizmat.',
                    'ru' => 'Хорошо расположен, чистый, профессиональный сервис.',
                    'kk' => 'Qolaylı jerde jaylasqan, taza, kásibi xızmet.',
                    'en' => 'Well located, clean, professional service.'
                ],
                'phone' => '+998901234031',
                'option_ids' => [17, 20, 25]
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Qiziqarli design, lekin qiymati qiymati yuqori.',
                    'ru' => 'Интересный дизайн, но цена довольно высокая.',
                    'kk' => 'Dizaynı qızıqlı, biraq bahaları sál joqarı.',
                    'en' => 'Interesting design, but the price is quite high.'
                ],
                'phone' => '+998901234032',
                'option_ids' => [6, 7, 24]
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Neo o\'z soʻz beradi! Yangi, zamonaviy, hamma yaxshi!',
                    'ru' => 'Neo свое слово держит! Новый, современный, все хорошо!',
                    'kk' => 'Neo bergen wádasinde turadı! Jańa, zamanagóy, bárine raxmet!',
                    'en' => 'Neo keeps its word! New, modern, everything is good!'
                ],
                'phone' => '+998901234033',
                'option_ids' => [16, 19, 21, 28]
            ],
            [
                'restaurant_id' => 5,
                'device_id' => 'device-5-5',
                'rating' => 2,
                'comments' => [
                    'uz' => 'Zamonaviy lekin sovuq xizmat. Ovqat sifati pastroq.',
                    'ru' => 'Современный, но холодный сервис. Качество еды ниже.',
                    'kk' => 'Zamanagóy, biraq xızmetkerler suwıq qabıllaydı. Awqat sapası tómen.',
                    'en' => 'Modern but cold service. Food quality is lower.'
                ],
                'phone' => '+998901234034',
                'option_ids' => [2, 9, 12, 29]
            ],

            // RESTORAN 6 - Qaraqalpaǵım 1-filial
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-1',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Qaraqalpak ovqatining asli! Ot chog\'ida tayyorlangan!',
                    'ru' => 'Настоящая каракалпакская еда! Готовится с душой!',
                    'kk' => 'Haqıyqıy qaraqalpaq asxanası! Janıńdı berip tayarlanǵan!',
                    'en' => 'Real Karakalpak cuisine! Prepared with love!'
                ],
                'phone' => '+998901234040',
                'option_ids' => [14, 16, 19, 22]
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-2',
                'rating' => 4,
                'comments' => [
                    'uz' => 'Mamlakatiy taom, yaxshi tadiga, qulay joyda.',
                    'ru' => 'Национальное блюдо, хороший вкус, удобное место.',
                    'kk' => 'Milliy awqatlar, dámine gáp joq, qolaylı jer.',
                    'en' => 'National dish, good taste, comfortable place.'
                ],
                'phone' => '+998901234041',
                'option_ids' => [15, 20, 27]
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-3',
                'rating' => 3,
                'comments' => [
                    'uz' => 'Taom yaxshi lekin atmosfera shovqinli edi.',
                    'ru' => 'Еда хорошая, но атмосфера шумная была.',
                    'kk' => 'Awqatları jaqsı, biraq ishki ortalıq júdá shıwlı.',
                    'en' => 'Food is good, but atmosphere was noisy.'
                ],
                'phone' => '+998901234042',
                'option_ids' => [5, 8, 23]
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-4',
                'rating' => 5,
                'comments' => [
                    'uz' => 'Haqiqiy qaraqalpak roh! Bevosita vatanning ta\'mi!',
                    'ru' => 'Истинный каракалпакский дух! Вкус родины!',
                    'kk' => 'Shınjı qaraqalpaq ruwxı! Watanımızdıń dástúrxan dástúri!',
                    'en' => 'True Karakalpak spirit! Taste of homeland!'
                ],
                'phone' => '+998901234043',
                'option_ids' => [14, 18, 21, 28]
            ],
            [
                'restaurant_id' => 6,
                'device_id' => 'device-6-5',
                'rating' => 1,
                'comments' => [
                    'uz' => 'Nomi yaxshi lekin ta\'mi yo\'q. Pul bosganda!',
                    'ru' => 'Название хорошее, но вкуса нет. Деньги даром!',
                    'kk' => 'Atı jaqsı eken, biraq dám joq. Pul bosqa ketti!',
                    'en' => 'Good name, but no taste. Money wasted!'
                ],
                'phone' => '+998901234044',
                'option_ids' => [1, 4, 10, 30]
            ],
        ];

        // Create reviews
        foreach ($reviews as $reviewData) {
            $comment = $reviewData['comments']['kk']; // Backward compatibility: eski comment field uchun
            $phone = $reviewData['phone'] ?? null;
            $optionIds = $reviewData['option_ids'] ?? [];

            // Build comments array for open-ended questions
            // These question IDs should map to open-ended questions in your system
            // Example: question_id 8 = "Что можно улучшить?", question_id 9 = "Особенно запомнилось?"
            $commentsArray = [];
            if (!empty($comment)) {
                // Distribute comments to different open-ended questions based on rating
                if ($reviewData['rating'] <= 3) {
                    // Low rating - use "Что можно улучшить?" (example: question_id 8)
                    $commentsArray[] = [
                        'question_id' => 8,
                        'text' => $comment
                    ];
                } else {
                    // High rating - use "Что особенно запомнилось?" (example: question_id 9)
                    $commentsArray[] = [
                        'question_id' => 9,
                        'text' => $comment
                    ];
                }
            }

            $review = Review::create([
                'restaurant_id' => $reviewData['restaurant_id'],
                'device_id' => $reviewData['device_id'],
                'ip_address' => '127.0.0.1',
                'rating' => $reviewData['rating'],
                'comment' => $comment,  // Keep for backward compatibility
                'comments' => !empty($commentsArray) ? $commentsArray : null,  // NEW: JSON array format
                'phone' => $phone,
            ]);

            if (!empty($optionIds)) {
                $review->selectedOptions()->sync($optionIds);
            }
        }
    }
}
