<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantDiscoveryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\QuestionController;

/*
|--------------------------------------------------------------------------
| Public API Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

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

// Categories
Route::get('/categories', [CategoryController::class, 'index']);

// Top restaurants by category
Route::get('/categories/{id}/top-restaurants', [RestaurantDiscoveryController::class, 'topByCategory']);

// Brands
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/restaurants/brand/{brand_id}', [BrandController::class, 'restaurantsByBrand']);


// Questions (for review submission)
Route::get('/questions', [QuestionController::class, 'index']);

Route::get('/menu-items/{id}', [MenuController::class, 'show']);

Route::get('/search', [SearchController::class, 'search']);

// Reviews (guest-only with device tracking)
Route::prefix('restaurants')->group(function () {
    Route::post('/{id}/reviews', [ReviewController::class, 'store'])
        ->middleware(['throttle:10,1']); // 10 requests per minute
});
