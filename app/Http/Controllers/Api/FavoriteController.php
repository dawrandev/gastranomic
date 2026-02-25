<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapRestaurantResource;
use App\Http\Resources\RestaurantListResource;
use App\Models\Favorite;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

class FavoriteController extends Controller
{
    #[OA\Get(
        path: '/api/favorites',
        summary: 'Sevimli restoranlar ro\'yxati',
        description: 'Foydalanuvchining sevimli restoranlari (pagination bilan)',
        tags: ['Sevimlilar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(
                name: 'device_id',
                in: 'query',
                required: true,
                description: 'Qurilmaning unikal ID\'si',
                schema: new OA\Schema(type: 'string', maxLength: 100)
            ),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15)),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sevimli restoranlar ro\'yxati',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                        new OA\Property(property: 'meta', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string|max:100',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $deviceId = $request->input('device_id');
        $perPage = $request->input('per_page', 15);

        $favorites = Favorite::where('device_id', $deviceId)
            ->with(['restaurant.city', 'restaurant.brand', 'restaurant.categories'])
            ->latest()
            ->paginate($perPage);

        $restaurants = $favorites->map(fn($favorite) => $favorite->restaurant);

        return response()->json([
            'success' => true,
            'data' => RestaurantListResource::collection($restaurants),
            'meta' => [
                'current_page' => $favorites->currentPage(),
                'last_page' => $favorites->lastPage(),
                'per_page' => $favorites->perPage(),
                'total' => $favorites->total(),
            ],
        ]);
    }

    #[OA\Get(
        path: '/api/favorites/map',
        summary: 'Sevimli restoranlar xarita uchun',
        description: 'Foydalanuvchining sevimli restoranlarini xarita uchun qaytaradi (barcha ma\'lumotlar)',
        tags: ['Sevimlilar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(
                name: 'device_id',
                in: 'query',
                required: true,
                description: 'Qurilmaning unikal ID\'si',
                schema: new OA\Schema(type: 'string', maxLength: 100)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sevimli restoranlar xarita uchun',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                    ]
                )
            )
        ]
    )]
    public function map(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $deviceId = $request->input('device_id');

        $favorites = Favorite::where('device_id', $deviceId)
            ->with(['restaurant.city', 'restaurant.brand', 'restaurant.categories'])
            ->get();

        $restaurants = $favorites->map(fn($favorite) => $favorite->restaurant);

        return response()->json([
            'success' => true,
            'data' => MapRestaurantResource::collection($restaurants),
        ]);
    }

    #[OA\Post(
        path: '/api/restaurants/{id}/favorite',
        summary: 'Restoranni sevimliga qo\'shish/olib tashlash',
        description: 'Restoran sevimli bo\'lsa - olib tashlaydi, aks holda - qo\'shadi',
        tags: ['Sevimlilar'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Restoran ID', schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['device_id'],
                properties: [
                    new OA\Property(
                        property: 'device_id',
                        type: 'string',
                        description: 'Qurilmaning unikal ID\'si',
                        maxLength: 100,
                        example: 'device-123'
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sevimli holati o\'zgartirildi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'is_favorite', type: 'boolean', example: true, description: 'Hozir sevimli ekanligini bildiradi'),
                        new OA\Property(property: 'message', type: 'string', example: 'Added to favorites'),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Restoran topilmadi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: false),
                        new OA\Property(property: 'message', type: 'string', example: 'Restaurant not found'),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation xatosi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: false),
                        new OA\Property(property: 'message', type: 'string', example: 'Validation failed'),
                        new OA\Property(property: 'errors', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function toggle(Request $request, int $restaurantId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $restaurant = Restaurant::find($restaurantId);

        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not found',
            ], 404);
        }

        $deviceId = $request->input('device_id');
        $ipAddress = $request->ip();

        $favorite = Favorite::where('device_id', $deviceId)
            ->where('restaurant_id', $restaurantId)
            ->first();

        if ($favorite) {
            $favorite->delete();

            return response()->json([
                'success' => true,
                'is_favorite' => false,
                'message' => 'Removed from favorites',
            ]);
        }

        Favorite::create([
            'device_id' => $deviceId,
            'restaurant_id' => $restaurantId,
            'ip_address' => $ipAddress,
        ]);

        return response()->json([
            'success' => true,
            'is_favorite' => true,
            'message' => 'Added to favorites',
        ]);
    }
}
