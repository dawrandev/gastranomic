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
        // Get option IDs by key for use in reviews
        $optionIds = QuestionOption::pluck('id', 'key')->toArray();

        // Helper function to get option IDs
        $getOptionIds = function(array $keys) use ($optionIds) {
            return array_map(fn($key) => $optionIds[$key] ?? null, $keys);
        };

        $reviews = [
            ['id' => 1, 'restaurant_id' => 2, 'device_id' => 'afef4bbd-d845-4096-aa9d-e1084290f6dd', 'ip' => '213.230.87.45', 'rating' => 3, 'comment' => 'Taza ónimler. jaqsi', 'created' => '2026-01-31 18:57:30', 'answer_keys' => ['lunch', 'maybe']],
            ['id' => 2, 'restaurant_id' => 1, 'device_id' => '550e8400-e29b-41d4-a716-446655440000', 'ip' => '213.230.87.45', 'rating' => 5, 'comment' => "Juda zo'r restoran, taomlar mazali!", 'created' => '2026-01-31 19:03:50', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 3, 'restaurant_id' => 4, 'device_id' => 'afef4bbd-d845-4096-aa9d-e1084290f6dd', 'ip' => '213.230.87.45', 'rating' => 4, 'comment' => 'Taza ónimler. bb', 'created' => '2026-01-31 19:06:51', 'answer_keys' => ['dinner', 'yes']],
            ['id' => 4, 'restaurant_id' => 4, 'device_id' => '550e8400-e29b-41d4-a716-446655440000', 'ip' => '213.230.87.45', 'rating' => 2, 'comment' => 'Juda boladi epleb!', 'created' => '2026-01-31 19:09:12', 'answer_keys' => ['lunch', 'no']],
            ['id' => 5, 'restaurant_id' => 6, 'device_id' => 'afef4bbd-d845-4096-aa9d-e1084290f6dd', 'ip' => '213.230.87.45', 'rating' => 5, 'comment' => 'jaman', 'created' => '2026-01-31 19:10:04', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 6, 'restaurant_id' => 1, 'device_id' => '6b10fc17-0021-4714-bf27-c1a9407b5b61', 'ip' => '84.54.73.218', 'rating' => 4, 'comment' => 'allow', 'created' => '2026-02-01 10:19:23', 'answer_keys' => ['lunch', 'yes', 'coffee']],
            ['id' => 7, 'restaurant_id' => 5, 'device_id' => '6b10fc17-0021-4714-bf27-c1a9407b5b61', 'ip' => '84.54.73.218', 'rating' => 3, 'comment' => null, 'created' => '2026-02-01 10:19:36', 'answer_keys' => ['dinner', 'maybe']],
            ['id' => 8, 'restaurant_id' => 5, 'device_id' => 'ff308f4d-a26d-46bf-9e1c-a159b47bde6d', 'ip' => '213.230.87.45', 'rating' => 1, 'comment' => 'Porsiya kichik', 'created' => '2026-02-01 16:44:17', 'answer_keys' => ['lunch', 'no']],
            ['id' => 9, 'restaurant_id' => 4, 'device_id' => 'ff308f4d-a26d-46bf-9e1c-a159b47bde6d', 'ip' => '213.230.87.45', 'rating' => 5, 'comment' => null, 'created' => '2026-02-01 16:44:30', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 10, 'restaurant_id' => 6, 'device_id' => 'ff308f4d-a26d-46bf-9e1c-a159b47bde6d', 'ip' => '213.230.87.45', 'rating' => 5, 'comment' => 'yaqshi', 'created' => '2026-02-01 19:23:45', 'answer_keys' => ['dinner', 'yes', 'dessert']],
            ['id' => 11, 'restaurant_id' => 1, 'device_id' => 'b5576a4f-5777-479c-91a0-9219fbac0c9e', 'ip' => '213.230.92.114', 'rating' => 4, 'comment' => 'Xızmetkerler dosane. ficufufufu', 'created' => '2026-02-02 04:47:36', 'answer_keys' => ['lunch', 'yes', 'coffee']],
            ['id' => 12, 'restaurant_id' => 6, 'device_id' => 'e09ec613-5b4b-4317-a739-1f9facf8e01d', 'ip' => '37.110.214.74', 'rating' => 5, 'comment' => null, 'created' => '2026-02-02 13:45:35', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 13, 'restaurant_id' => 6, 'device_id' => '6b10fc17-0021-4714-bf27-c1a9407b5b61', 'ip' => '84.54.73.218', 'rating' => 5, 'comment' => null, 'created' => '2026-02-03 15:38:20', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 14, 'restaurant_id' => 1, 'device_id' => '6b4e935d-906e-43e5-9baa-ca616a419ac5', 'ip' => '84.54.73.218', 'rating' => 3, 'comment' => 'minaw Dilafruzga jaqpadi', 'created' => '2026-02-04 02:32:24', 'answer_keys' => ['dinner', 'maybe', 'other']],
            ['id' => 15, 'restaurant_id' => 2, 'device_id' => '6b4e935d-906e-43e5-9baa-ca616a419ac5', 'ip' => '84.54.73.218', 'rating' => 5, 'comment' => 'Xızmet tez hám sıpatlí', 'created' => '2026-02-04 02:32:44', 'answer_keys' => ['lunch', 'yes']],
            ['id' => 16, 'restaurant_id' => 6, 'device_id' => '6b4e935d-906e-43e5-9baa-ca616a419ac5', 'ip' => '84.54.73.218', 'rating' => 1, 'comment' => 'xaxaxaxxaxaxa', 'created' => '2026-02-04 06:53:08', 'answer_keys' => ['lunch', 'no']],
            ['id' => 17, 'restaurant_id' => 5, 'device_id' => '6b4e935d-906e-43e5-9baa-ca616a419ac5', 'ip' => '84.54.73.218', 'rating' => 5, 'comment' => null, 'created' => '2026-02-04 16:54:14', 'answer_keys' => ['dinner', 'yes']],
            ['id' => 18, 'restaurant_id' => 1, 'device_id' => '02bbe252-6457-4b5e-80d8-b2741df1bfa4', 'ip' => '84.54.71.66', 'rating' => 5, 'comment' => 'Clean and cozy. Beautiful atmosphere', 'created' => '2026-02-05 02:52:36', 'answer_keys' => ['breakfast', 'yes', 'coffee']],
            ['id' => 19, 'restaurant_id' => 6, 'device_id' => '02bbe252-6457-4b5e-80d8-b2741df1bfa4', 'ip' => '84.54.72.227', 'rating' => 4, 'comment' => null, 'created' => '2026-02-05 04:42:33', 'answer_keys' => ['dinner', 'yes']],
            ['id' => 20, 'restaurant_id' => 1, 'device_id' => '6de9cc76-15f0-4df4-88fa-2e1716e5d4e3', 'ip' => '213.230.86.180', 'rating' => 5, 'comment' => 'Taza hám qolaylí', 'created' => '2026-02-05 05:31:35', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 21, 'restaurant_id' => 5, 'device_id' => '02bbe252-6457-4b5e-80d8-b2741df1bfa4', 'ip' => '84.54.72.227', 'rating' => 5, 'comment' => 'Красивая атмосфера. uuu', 'created' => '2026-02-05 12:01:25', 'answer_keys' => ['lunch', 'yes', 'dessert']],
            ['id' => 22, 'restaurant_id' => 5, 'device_id' => '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', 'ip' => '213.230.93.19', 'rating' => 5, 'comment' => 'Taza ónimlerden tayarlanǵan. unadi', 'created' => '2026-02-06 01:28:24', 'answer_keys' => ['dinner', 'yes']],
            ['id' => 23, 'restaurant_id' => 1, 'device_id' => '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', 'ip' => '213.230.93.19', 'rating' => 5, 'comment' => 'nmnn', 'created' => '2026-02-06 01:33:46', 'answer_keys' => ['breakfast', 'yes', 'coffee']],
            ['id' => 24, 'restaurant_id' => 2, 'device_id' => '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', 'ip' => '213.230.93.19', 'rating' => 5, 'comment' => "xor\n\nz", 'created' => '2026-02-06 01:34:33', 'answer_keys' => ['breakfast', 'yes']],
            ['id' => 25, 'restaurant_id' => 4, 'device_id' => '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', 'ip' => '213.230.93.19', 'rating' => 5, 'comment' => 'nmmmmm', 'created' => '2026-02-06 01:35:05', 'answer_keys' => ['lunch', 'yes']],
            ['id' => 26, 'restaurant_id' => 4, 'device_id' => '02bbe252-6457-4b5e-80d8-b2741df1bfa4', 'ip' => '84.54.72.227', 'rating' => 3, 'comment' => 'Taam suwıq edi. sbhs', 'created' => '2026-02-06 07:28:02', 'answer_keys' => ['dinner', 'maybe']],
        ];

        foreach ($reviews as $review) {
            $answerKeys = $review['answer_keys'] ?? [];
            unset($review['answer_keys']);

            DB::table('reviews')->updateOrInsert(
                ['id' => $review['id']],
                [
                    'restaurant_id' => $review['restaurant_id'],
                    'device_id'     => $review['device_id'],
                    'ip_address'    => $review['ip'],
                    'rating'        => $review['rating'],
                    'comment'       => $review['comment'],
                    'created_at'    => $review['created'],
                    'updated_at'    => $review['created'],
                ]
            );

            // Attach selected answers to review
            if (!empty($answerKeys)) {
                $answerIds = $getOptionIds($answerKeys);
                $answerIds = array_filter($answerIds); // Remove null values

                $reviewModel = Review::find($review['id']);
                if ($reviewModel && !empty($answerIds)) {
                    $reviewModel->selectedOptions()->sync($answerIds);
                }
            }
        }
    }
}
