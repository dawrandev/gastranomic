<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Services\FavoriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class FavoriteController extends Controller
{
    public function __construct(
        protected FavoriteService $favoriteService
    ) {}

    #[OA\Get(
        path: '/api/favorites',
        summary: 'Sevimlilar ro\'yxati',
        description: 'Login qilgan foydalanuvchining barcha sevimli restoranlar ro\'yxati',
        security: [['sanctum' => []]],
        tags: ['❤️ Sevimlilar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'per_page',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Favorites list',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                        new OA\Property(property: 'meta', type: 'object'),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            )
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $client = $request->user();
        $perPage = $request->input('per_page', 15);

        $favorites = $this->favoriteService->getClientFavorites($client->id, $perPage);

        return response()->json([
            'success' => true,
            'data' => FavoriteResource::collection($favorites),
            'meta' => [
                'current_page' => $favorites->currentPage(),
                'last_page' => $favorites->lastPage(),
                'per_page' => $favorites->perPage(),
                'total' => $favorites->total(),
            ],
        ]);
    }

    #[OA\Post(
        path: '/api/restaurants/{id}/favorite',
        summary: 'Sevimlilar ro\'yxatiga qo\'shish/o\'chirish',
        description: 'Restoranni sevimlilar ro\'yxatiga qo\'shish yoki o\'chirish. Faqat autentifikatsiya qilingan foydalanuvchilar uchun.',
        security: [['bearerAuth' => []]],
        tags: ['❤️ Sevimlilar'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Restoran ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sevimlilar holati o\'zgartirildi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Sevimlilar ro\'yxatiga qo\'shildi'),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'is_favorited', type: 'boolean', example: true)
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Autentifikatsiya xatosi'
            ),
            new OA\Response(
                response: 404,
                description: 'Restoran topilmadi'
            )
        ]
    )]
    public function toggle(Request $request, int $restaurantId): JsonResponse
    {
        $restaurant = \App\Models\Restaurant::find($restaurantId);
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not found',
            ], 404);
        }

        $client = $request->user();

        // Toggle favorite
        $favorite = $client->favorites()->where('restaurant_id', $restaurantId)->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Removed from favorites';
            $isFavorited = false;
        } else {
            $client->favorites()->create([
                'restaurant_id' => $restaurantId,
            ]);
            $message = 'Added to favorites';
            $isFavorited = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'is_favorited' => $isFavorited,
            ],
        ]);
    }

    #[OA\Get(
        path: '/api/favorites/map',
        summary: 'Sevimli restoranlarni xaritada ko\'rsatish',
        description: 'Client sevimli restoranlarining koordinatalari xarita uchun',
        security: [['bearerAuth' => []]],
        tags: ['❤️ Sevimlilar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sevimli restoranlar koordinatalari',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Autentifikatsiya xatosi'
            )
        ]
    )]
    public function map(Request $request): JsonResponse
    {
        $client = $request->user();

        $favorites = $client->favorites()
            ->with([
                'restaurant:id,branch_name,location,brand_id',
                'restaurant.brand:id,name',
            ])
            ->get()
            ->filter(function ($favorite) {
                // Filter out favorites where restaurant doesn't exist
                return $favorite->restaurant !== null;
            })
            ->map(function ($favorite) {
                $restaurant = $favorite->restaurant;
                return [
                    'id' => $restaurant->id,
                    'branch_name' => $restaurant->branch_name,
                    'latitude' => $restaurant->latitude,
                    'longitude' => $restaurant->longitude,
                    'brand' => $restaurant->brand ? [
                        'id' => $restaurant->brand->id,
                        'name' => $restaurant->brand->name,
                    ] : null,
                ];
            })
            ->filter(function ($item) {
                // Filter out items without valid coordinates
                return $item['latitude'] && $item['longitude'];
            })
            ->values();

        return response()->json([
            'success' => true,
            'data' => $favorites,
        ]);
    }
}
