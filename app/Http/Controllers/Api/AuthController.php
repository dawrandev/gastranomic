<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\VerificationCode;
use App\Services\EskizSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected EskizSmsService $smsService;

    public function __construct(EskizSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Send verification code to phone
     *
     * POST /api/auth/send-code
     * Body: { "phone": "998901234567" }
     */
    public function sendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:9|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = $this->cleanPhone($request->phone);

        // Generate 4-digit code
        $code = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);

        // Save to database (expires in 5 minutes)
        VerificationCode::create([
            'phone' => $phone,
            'code' => $code,
            'expires_at' => Carbon::now()->addMinutes(5),
            'is_used' => false,
        ]);

        // Send SMS via Eskiz
        $smsSent = $this->smsService->sendVerificationCode($phone, $code);

        // For testing without Eskiz - log the code
        \Log::info("Verification code for {$phone}: {$code}");

        if (!$smsSent && !config('app.debug')) {
            return response()->json([
                'success' => false,
                'message' => 'SMS yuborishda xatolik yuz berdi. Qaytadan urinib ko\'ring.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tasdiqlash kodi yuborildi',
            'phone' => $phone,
            // Only for development/testing - remove in production
            'code' => config('app.debug') ? $code : null,
        ]);
    }

    /**
     * Verify code and login/register
     *
     * POST /api/auth/verify-code
     * Body: {
     *   "phone": "998901234567",
     *   "code": "1234",
     *   "first_name": "John",    // Optional, required for new users
     *   "last_name": "Doe"        // Optional, required for new users
     * }
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:9|max:20',
            'code' => 'required|string|size:4',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = $this->cleanPhone($request->phone);
        $code = $request->code;

        // Find active verification code
        $verification = VerificationCode::where('phone', $phone)
            ->active()
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Tasdiqlash kodi topilmadi yoki muddati tugagan',
            ], 404);
        }

        if (!$verification->isValid($code)) {
            return response()->json([
                'success' => false,
                'message' => 'Noto\'g\'ri tasdiqlash kodi',
            ], 401);
        }

        // Mark code as used
        $verification->markAsUsed();

        // Find or create client
        $client = Client::where('phone', $phone)->first();

        if (!$client) {
            // New client - require name
            if (!$request->filled('first_name') || !$request->filled('last_name')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ism va familiya kiritish shart',
                    'requires_registration' => true,
                ], 422);
            }

            $client = Client::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $phone,
            ]);

            $isNewUser = true;
        } else {
            $isNewUser = false;
        }

        // Generate API token (using Sanctum)
        $token = $client->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => $isNewUser ? 'Ro\'yxatdan o\'tdingiz' : 'Tizimga kirdingiz',
            'is_new_user' => $isNewUser,
            'client' => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'full_name' => $client->full_name,
                'phone' => $client->phone,
                'image_path' => $client->image_path,
            ],
            'token' => $token,
        ]);
    }

    /**
     * Get authenticated client profile
     *
     * GET /api/auth/me
     * Headers: { "Authorization": "Bearer {token}" }
     */
    public function me(Request $request)
    {
        $client = $request->user();

        return response()->json([
            'success' => true,
            'client' => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'full_name' => $client->full_name,
                'phone' => $client->phone,
                'image_path' => $client->image_path,
            ],
        ]);
    }

    /**
     * Logout
     *
     * POST /api/auth/logout
     * Headers: { "Authorization": "Bearer {token}" }
     */
    public function logout(Request $request)
    {
        // Revoke current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tizimdan chiqdingiz',
        ]);
    }

    /**
     * Clean phone number
     */
    protected function cleanPhone(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Ensure it starts with 998
        if (!str_starts_with($phone, '998')) {
            $phone = '998' . $phone;
        }

        return $phone;
    }
}
