<?php

namespace App\Services;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Factory;

class FcmNotificationService
{
    /**
     * Send notification to admin about new review
     *
     * @param User $admin The restaurant admin
     * @param Review $review The newly created review
     * @return void
     */
    public function sendNewReviewNotification(User $admin, Review $review): void
    {
        // Skip if admin doesn't have FCM token
        if (!$admin->fcm_token) {
            Log::info('FCM: Skipped notification - admin has no FCM token', [
                'admin_id' => $admin->id,
                'review_id' => $review->id,
            ]);
            return;
        }

        try {
            $factory = (new Factory)->withServiceAccount(storage_path('app/firebase-credentials.json'));
            $messaging = $factory->createMessaging();

            $ratingStars = str_repeat('⭐', $review->rating);

            $message = CloudMessage::withTarget('token', $admin->fcm_token)
                ->withNotification(
                    Notification::create(
                        'Yangi sharh!',
                        "Restoraningizga yangi {$ratingStars} sharh qoldirildi"
                    )
                )
                ->withData([
                    'type' => 'new_review',
                    'review_id' => (string) $review->id,
                    'restaurant_id' => (string) $review->restaurant_id,
                    'rating' => (string) $review->rating,
                    'click_action' => url("/admin/reviews/{$review->id}"),
                ]);

            $messaging->send($message);

            Log::info('FCM: Notification sent successfully', [
                'admin_id' => $admin->id,
                'review_id' => $review->id,
                'restaurant_id' => $review->restaurant_id,
            ]);
        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
            // Handle FCM-specific errors (invalid token, etc.)
            Log::error('FCM: Messaging error', [
                'admin_id' => $admin->id,
                'review_id' => $review->id,
                'error' => $e->getMessage(),
            ]);

            // If token is invalid, remove it from database
            if (str_contains($e->getMessage(), 'not a valid FCM registration token')) {
                $admin->update(['fcm_token' => null]);
                Log::info('FCM: Invalid token removed from database', ['admin_id' => $admin->id]);
            }
        } catch (\Exception $e) {
            // Log any other errors but don't fail the review creation
            Log::error('FCM: Notification failed', [
                'admin_id' => $admin->id,
                'review_id' => $review->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
