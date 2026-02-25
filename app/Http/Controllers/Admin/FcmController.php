<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserFcmToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    /**
     * Store FCM token for the authenticated admin user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fcm_token' => 'required|string|max:500',
        ]);

        $user = $request->user();

        // Save to new table (supports multiple browsers)
        UserFcmToken::updateOrCreate(
            [
                'user_id' => $user->id,
                'fcm_token' => $validated['fcm_token'],
            ],
            [
                'device_type' => null,
            ]
        );

        // Also keep backward compatibility with old fcm_token column
        $user->update(['fcm_token' => $validated['fcm_token']]);

        return response()->json([
            'success' => true,
            'message' => 'FCM token saved successfully',
        ]);
    }

    /**
     * Check if current browser has FCM token saved
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fcm_token' => 'required|string|max:500',
        ]);

        $user = $request->user();

        $exists = UserFcmToken::where('user_id', $user->id)
            ->where('fcm_token', $validated['fcm_token'])
            ->exists();

        return response()->json([
            'success' => true,
            'has_token' => $exists,
        ]);
    }

    /**
     * Remove FCM token for the authenticated admin user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fcm_token' => 'required|string|max:500',
        ]);

        $user = $request->user();

        // Delete from new table
        UserFcmToken::where('user_id', $user->id)
            ->where('fcm_token', $validated['fcm_token'])
            ->delete();

        // If this was the last token, clear old column too
        if ($user->fcmTokens()->count() === 0) {
            $user->update(['fcm_token' => null]);
        }

        return response()->json([
            'success' => true,
            'message' => 'FCM token removed successfully',
        ]);
    }
}
