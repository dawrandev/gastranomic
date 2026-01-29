<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantDiscoveryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| Public API Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Authentication
Route::prefix('auth')->group(function () {
    Route::post('/send-code', [AuthController::class, 'sendCode']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
});

// Restaurant Discovery
Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantDiscoveryController::class, 'index']);
    Route::get('/nearest', [RestaurantDiscoveryController::class, 'nearest']);
    Route::get('/nearby', [RestaurantDiscoveryController::class, 'nearby']);
    Route::get('/map', [RestaurantDiscoveryController::class, 'map']);
    Route::get('/{id}', [RestaurantDiscoveryController::class, 'show']);

    Route::get('/{id}/menu', [MenuController::class, 'getRestaurantMenu']);

    Route::get('/{id}/reviews', [ReviewController::class, 'index']);
});

// Top restaurants by category
Route::get('/categories/{id}/top-restaurants', [RestaurantDiscoveryController::class, 'topByCategory']);

Route::get('/menu-items/{id}', [MenuController::class, 'show']);

Route::get('/search', [SearchController::class, 'search']);

// Reviews (now guest-friendly with device tracking)
Route::prefix('restaurants')->group(function () {
    Route::post('/{id}/reviews', [ReviewController::class, 'store'])->middleware('throttle:10,1'); // 10 requests per minute
});

/*
|--------------------------------------------------------------------------
| Protected API Routes (Authentication Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // Reviews (update/delete only for authenticated users)
    Route::prefix('reviews')->group(function () {
        Route::put('/{id}', [ReviewController::class, 'update']);
        Route::delete('/{id}', [ReviewController::class, 'destroy']);
    });

    // Favorites (authenticated only)
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::get('/favorites/map', [FavoriteController::class, 'map']);
    Route::post('/restaurants/{id}/favorite', [FavoriteController::class, 'toggle'])->middleware('throttle:20,1');
});
