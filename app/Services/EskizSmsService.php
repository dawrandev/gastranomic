<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EskizSmsService
{
    protected string $baseUrl;
    protected string $email;
    protected string $password;
    protected ?string $token = null;

    public function __construct()
    {
        $this->baseUrl = config('services.eskiz.base_url', 'https://notify.eskiz.uz/api');
        $this->email = config('services.eskiz.email');
        $this->password = config('services.eskiz.password');
    }

    /**
     * Get authentication token from Eskiz
     */
    protected function getToken(): ?string
    {
        if ($this->token) {
            return $this->token;
        }

        try {
            $response = Http::post("{$this->baseUrl}/auth/login", [
                'email' => $this->email,
                'password' => $this->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->token = $data['data']['token'] ?? null;
                return $this->token;
            }

            Log::error('Eskiz auth failed', [
                'response' => $response->json()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Eskiz auth error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Send SMS via Eskiz
     *
     * @param string $phone Phone number (998901234567)
     * @param string $message SMS text
     * @return bool
     */
    public function sendSms(string $phone, string $message): bool
    {
        $token = $this->getToken();

        if (!$token) {
            Log::error('Cannot send SMS: No token');
            return false;
        }

        // Clean phone number (remove spaces, dashes, etc)
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Ensure phone starts with 998
        if (!str_starts_with($phone, '998')) {
            $phone = '998' . $phone;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post("{$this->baseUrl}/message/sms/send", [
                'mobile_phone' => $phone,
                'message' => $message,
                'from' => '4546', // Eskiz default sender
            ]);

            if ($response->successful()) {
                Log::info('SMS sent successfully', [
                    'phone' => $phone,
                    'response' => $response->json()
                ]);
                return true;
            }

            Log::error('SMS send failed', [
                'phone' => $phone,
                'response' => $response->json()
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('SMS send error: ' . $e->getMessage(), [
                'phone' => $phone
            ]);
            return false;
        }
    }

    /**
     * Send verification code
     *
     * @param string $phone
     * @param string $code
     * @return bool
     */
    public function sendVerificationCode(string $phone, string $code): bool
    {
        $message = "Sizning tasdiqlash kodingiz: {$code}\n\nKodni hech kimga bermang!";
        return $this->sendSms($phone, $message);
    }
}
