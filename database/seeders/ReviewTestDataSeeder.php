<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class ReviewTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a restaurant or create one
        $restaurant = Restaurant::first();
        if (!$restaurant) {
            $this->command->error('Ресторан не найден. Сначала создайте ресторан.');
            return;
        }

        // Get all options for testing
        $allOptions = QuestionOption::with('questionCategory')->get();

        // Sample reviews data
        $reviewsData = [
            [
                'rating' => 5,
                'comment' => 'Очень вкусная еда! Персонал был вежлив и внимателен. Атмосфера в ресторане просто замечательная.',
                'phone' => '+998901234501',
                'option_ids' => [14, 15, 17], // High rating: taste, presentation, service
            ],
            [
                'rating' => 5,
                'comment' => 'Прекрасный ресторан! Рекомендую всем своим друзьям.',
                'phone' => '+998901234502',
                'option_ids' => [16, 18, 20], // High rating: polite staff, comfort, cleanliness
            ],
            [
                'rating' => 4,
                'comment' => 'Хорошее обслуживание, только цена немного высокая.',
                'phone' => '+998901234503',
                'option_ids' => [17, 19], // Fast service, nice location
            ],
            [
                'rating' => 4,
                'comment' => 'Очень понравился обед. Буду часто приходить.',
                'phone' => '+998901234504',
                'option_ids' => [14, 18], // Taste, comfort
            ],
            [
                'rating' => 2,
                'comment' => 'Еда была холодной. Официант долго нас игнорировал.',
                'phone' => '+998901234505',
                'option_ids' => [1, 2, 6, 10], // Low rating: slow service, rude staff, poor cleanliness, wait time
            ],
            [
                'rating' => 3,
                'comment' => 'Средний ресторан. Есть проблемы с чистотой.',
                'phone' => '+998901234506',
                'option_ids' => [4, 5], // Low rating: poor cleanliness, noisy atmosphere
            ],
            [
                'rating' => 5,
                'comment' => 'Лучший ресторан в городе! Все супер!',
                'phone' => '+998901234507',
                'option_ids' => [14, 16, 20, 21], // All positive
            ],
            [
                'rating' => 1,
                'comment' => 'Ужасное качество. Деньги потратил впустую.',
                'phone' => '+998901234508',
                'option_ids' => [3, 6, 9, 13], // Low: order mistakes, poor cleanliness, food quality, price
            ],
            [
                'rating' => 4,
                'comment' => 'Вкусная еда и хороший сервис. Спасибо!',
                'phone' => '+998901234509',
                'option_ids' => [15, 17, 19], // Presentation, service, location
            ],
            [
                'rating' => 3,
                'comment' => 'Нормально. Но можно было бы улучшить.',
                'phone' => '+998901234510',
                'option_ids' => [2, 7], // Rude staff, uncomfortable seating
            ],
        ];

        // Create reviews
        foreach ($reviewsData as $index => $data) {
            $review = Review::create([
                'restaurant_id' => $restaurant->id,
                'device_id' => 'test-device-' . ($index + 1),
                'ip_address' => '127.0.0.1',
                'rating' => $data['rating'],
                'comment' => $data['comment'],
                'phone' => $data['phone'],
            ]);

            // Attach selected options
            $optionIds = array_filter($data['option_ids'], function($optionId) use ($allOptions) {
                return $allOptions->where('id', $optionId)->count() > 0;
            });

            if (!empty($optionIds)) {
                $review->selectedOptions()->sync($optionIds);
            }

            $this->command->info("✓ Отзыв #{$review->id} создан (рейтинг: {$review->rating}/5)");
        }

        $this->command->info("\n✅ 10 тестовых отзывов успешно созданы!");
    }
}
