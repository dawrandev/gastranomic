<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * Optional Authentication Middleware
 *
 * Agar Authorization header mavjud bo'lsa, client ni authenticate qiladi.
 * Aks holda, request ni davom ettiradi (guest mode).
 */
class OptionalAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if Authorization header exists
        $token = $request->bearerToken();

        if ($token) {
            // Try to authenticate via Sanctum
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable_type === Client::class) {
                // Set the authenticated user
                $request->setUserResolver(function () use ($accessToken) {
                    return $accessToken->tokenable;
                });
            }
        }

        return $next($request);
    }
}
