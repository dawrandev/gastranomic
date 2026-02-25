<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Handle admin login.
     */
    public function login(array $credentials): string
    {
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        $user = Auth::user();

        // Redirect based on user role
        if ($user->hasRole('superadmin')) {
            return route('superadmin.dashboard');
        }

        return route('admin.dashboard');
    }
}
