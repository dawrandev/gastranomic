<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class BrandController extends Controller
{
    #[OA\Get(
        path: '/api/brands',
        summary: 'Barcha brandlar ro\'yxati',
        description: 'Accept-Language header orqali berilgan tildagi barcha brand tarjimalarini qaytaradi',
        tags: ['Brandlar'],
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
                description: 'Brandlar ro\'yxati',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', example: 1),
                                    new OA\Property(property: 'name', type: 'string', example: 'KFC'),
                                    new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Kentucky Fried Chicken'),
                                    new OA\Property(property: 'logo', type: 'string', nullable: true, example: 'https://example.com/storage/brands/logos/kfc.png'),
                                ],
                                type: 'object'
                            )
                        ),
                    ]
                )
            )
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $brands = Brand::with('translations')->get();

        return response()->json([
            'success' => true,
            'data' => BrandResource::collection($brands),
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/brand/{brand_id}',
        summary: 'Brand bo\'yicha restaurantlar',
        description: 'Berilgan brand_id ga tegishli barcha restaurantlarni qaytaradi',
        tags: ['Brandlar'],
        parameters: [
            new OA\Parameter(
                name: 'brand_id',
                in: 'path',
                required: true,
                description: 'Brand ID',
                schema: new OA\Schema(type: 'integer', example: 1)
            ),
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
                description: 'Brandga tegishli restaurantlar ro\'yxati',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'brand_id', type: 'integer', example: 1),
                                new OA\Property(property: 'brand_name', type: 'string', example: 'KFC'),
                                new OA\Property(
                                    property: 'restaurants',
                                    type: 'array',
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: 'id', type: 'integer', example: 1),
                                            new OA\Property(property: 'name', type: 'string', example: 'KFC Mega Planet'),
                                            new OA\Property(
                                                property: 'images',
                                                type: 'array',
                                                items: new OA\Items(
                                                    properties: [
                                                        new OA\Property(property: 'id', type: 'integer', example: 1),
                                                        new OA\Property(property: 'image_url', type: 'string', example: 'https://example.com/storage/restaurants/image.jpg'),
                                                        new OA\Property(property: 'is_cover', type: 'boolean', example: true),
                                                    ],
                                                    type: 'object'
                                                )
                                            ),
                                            new OA\Property(property: 'avg_rating', type: 'number', format: 'float', example: 4.5),
                                            new OA\Property(property: 'reviews_count', type: 'integer', example: 120),
                                            new OA\Property(property: 'address', type: 'string', nullable: true, example: 'Mega Planet, Almaty'),
                                            new OA\Property(
                                                property: 'operating_hours',
                                                type: 'array',
                                                items: new OA\Items(
                                                    properties: [
                                                        new OA\Property(property: 'day_of_week', type: 'integer', example: 1),
                                                        new OA\Property(property: 'opening_time', type: 'string', example: '09:00:00'),
                                                        new OA\Property(property: 'closing_time', type: 'string', example: '23:00:00'),
                                                        new OA\Property(property: 'is_closed', type: 'boolean', example: false),
                                                    ],
                                                    type: 'object'
                                                )
                                            ),
                                        ],
                                        type: 'object'
                                    )
                                ),
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Brand topilmadi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: false),
                        new OA\Property(property: 'message', type: 'string', example: 'Brand not found'),
                    ]
                )
            )
        ]
    )]
    public function restaurantsByBrand(Request $request, $brand_id): JsonResponse
    {
        $locale = $request->header('Accept-Language', 'kk');

        $brand = Brand::with('translations')->find($brand_id);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
            ], 404);
        }

        $restaurants = Restaurant::where('brand_id', $brand_id)
            ->with(['images', 'operatingHours', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->get();

        $restaurantsData = $restaurants->map(function ($restaurant) {
            return [
                'id' => $restaurant->id,
                'name' => $restaurant->branch_name,
                'images' => $restaurant->images->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'image_url' => asset('storage/' . $image->image_path),
                        'is_cover' => $image->is_cover,
                    ];
                }),
                'avg_rating' => round($restaurant->reviews_avg_rating ?? 0, 1),
                'reviews_count' => $restaurant->reviews_count ?? 0,
                'address' => $restaurant->address,
                'operating_hours' => $restaurant->operatingHours->map(function ($hour) {
                    return [
                        'day_of_week' => $hour->day_of_week,
                        'opening_time' => $hour->opening_time,
                        'closing_time' => $hour->closing_time,
                        'is_closed' => $hour->is_closed,
                    ];
                }),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'brand_id' => $brand->id,
                'brand_name' => $brand->getTranslatedName($locale),
                'restaurants' => $restaurantsData,
            ],
        ]);
    }
}
