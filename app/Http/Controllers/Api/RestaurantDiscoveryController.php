<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantDetailResource;
use App\Http\Resources\RestaurantListResource;
use App\Http\Resources\MapRestaurantResource;
use App\Services\DiscoveryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class RestaurantDiscoveryController extends Controller
{
    public function __construct(
        protected DiscoveryService $discoveryService
    ) {}

    #[OA\Get(
        path: '/api/restaurants',
        summary: 'Barcha restoranlar ro\'yxati',
        description: 'Filter va pagination bilan barcha faol restoranlarni olish',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'category_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'city_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'brand_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'menu_section_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'min_rating', in: 'query', required: false, schema: new OA\Schema(type: 'number', format: 'float')),
            new OA\Parameter(name: 'max_rating', in: 'query', required: false, schema: new OA\Schema(type: 'number', format: 'float')),
            new OA\Parameter(name: 'sort_by', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: ['rating', 'latest'])),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Restaurants list',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', example: 1),
                                    new OA\Property(property: 'restaurant', type: 'string', example: 'McDonald\'s Almaty Mall'),
                                    new OA\Property(property: 'branch_name', type: 'string', example: 'McDonald\'s Almaty Mall'),
                                    new OA\Property(property: 'address', type: 'string', example: 'Rozybakiev St 247A'),
                                    new OA\Property(property: 'phone', type: 'string', example: '+7 777 123 4567'),
                                    new OA\Property(
                                        property: 'brand',
                                        type: 'object',
                                        properties: [
                                            new OA\Property(property: 'id', type: 'integer', example: 1),
                                            new OA\Property(property: 'name', type: 'string', example: 'McDonald\'s'),
                                            new OA\Property(property: 'logo', type: 'string', nullable: true, example: 'https://example.com/storage/brands/mcdonalds.png'),
                                        ]
                                    ),
                                    new OA\Property(
                                        property: 'city',
                                        type: 'object',
                                        properties: [
                                            new OA\Property(property: 'id', type: 'integer', example: 1),
                                            new OA\Property(property: 'name', type: 'string', example: 'Алматы'),
                                        ]
                                    ),
                                    new OA\Property(property: 'cover_image', type: 'string', nullable: true, example: 'https://example.com/storage/images/restaurant.jpg'),
                                    new OA\Property(
                                        property: 'categories',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                                new OA\Property(property: 'name', type: 'string', example: 'Fast Food'),
                                            ]
                                        )
                                    ),
                                    new OA\Property(property: 'category_name', type: 'string', nullable: true, example: 'Fast Food'),
                                    new OA\Property(property: 'average_rating', type: 'number', format: 'float', example: 4.5),
                                    new OA\Property(property: 'reviews_count', type: 'integer', example: 128),
                                    new OA\Property(
                                        property: 'operating_hours',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(property: 'day_of_week', type: 'integer', description: '1=Dushanba, 7=Yakshanba', example: 1),
                                                new OA\Property(property: 'opening_time', type: 'string', example: '09:00'),
                                                new OA\Property(property: 'closing_time', type: 'string', example: '22:00'),
                                                new OA\Property(property: 'is_closed', type: 'boolean', example: false),
                                            ]
                                        )
                                    ),
                                ]
                            )
                        ),
                        new OA\Property(
                            property: 'meta',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'current_page', type: 'integer', example: 1),
                                new OA\Property(property: 'last_page', type: 'integer', example: 10),
                                new OA\Property(property: 'per_page', type: 'integer', example: 15),
                                new OA\Property(property: 'total', type: 'integer', example: 150),
                            ]
                        ),
                    ]
                )
            )
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['category_id', 'city_id', 'brand_id', 'menu_section_id', 'min_rating', 'max_rating', 'sort_by']);
        $perPage = $request->input('per_page', 15);

        $restaurants = $this->discoveryService->getAllRestaurants($filters, $perPage);

        return response()->json([
            'success' => true,
            'data' => RestaurantListResource::collection($restaurants),
            'meta' => [
                'current_page' => $restaurants->currentPage(),
                'last_page' => $restaurants->lastPage(),
                'per_page' => $restaurants->perPage(),
                'total' => $restaurants->total(),
            ],
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/nearby',
        summary: 'Yaqin atrofdagi restoranlar',
        description: 'Foydalanuvchi lokatsiyasidan berilgan radius (km) ichidagi restoranlarni topadi',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(name: 'lat', in: 'query', required: true, schema: new OA\Schema(type: 'number', format: 'float')),
            new OA\Parameter(name: 'lng', in: 'query', required: true, schema: new OA\Schema(type: 'number', format: 'float')),
            new OA\Parameter(name: 'radius', in: 'query', required: false, schema: new OA\Schema(type: 'number', format: 'float', default: 5)),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Nearby restaurants list',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                        new OA\Property(property: 'meta', type: 'object'),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error'
            )
        ]
    )]
    public function nearby(Request $request): JsonResponse
    {
        $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:0.1|max:50',
        ]);

        $latitude = $request->input('lat');
        $longitude = $request->input('lng');
        $radius = $request->input('radius', 5);
        $perPage = $request->input('per_page', 15);

        $restaurants = $this->discoveryService->getNearbyRestaurants(
            $latitude,
            $longitude,
            $radius,
            $perPage
        );

        return response()->json([
            'success' => true,
            'data' => RestaurantListResource::collection($restaurants),
            'meta' => [
                'current_page' => $restaurants->currentPage(),
                'last_page' => $restaurants->lastPage(),
                'per_page' => $restaurants->perPage(),
                'total' => $restaurants->total(),
                'search_radius_km' => $radius,
            ],
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/{id}',
        summary: 'Restoran batafsil ma\'lumotlari',
        description: 'Restoranning to\'liq ma\'lumotlari: rasmlar, brend, menyu, operating hours, reviews statistics va hokazo',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Restaurant details',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Restaurant not found'
            )
        ]
    )]
    public function show(Request $request, int $id): JsonResponse
    {
        $clientId = $request->user('sanctum')?->id;

        $restaurant = $this->discoveryService->getRestaurantById($id, $clientId);

        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new RestaurantDetailResource($restaurant),
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/map',
        summary: 'Xarita uchun restoranlar',
        description: 'Xaritada ko\'rsatish uchun barcha restoranlarning koordinatalari',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(name: 'category_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'city_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'min_rating', in: 'query', required: false, schema: new OA\Schema(type: 'number', format: 'float')),
            new OA\Parameter(name: 'max_rating', in: 'query', required: false, schema: new OA\Schema(type: 'number', format: 'float')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Restaurants for map',
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
        $filters = $request->only(['category_id', 'city_id', 'min_rating', 'max_rating']);

        $restaurants = $this->discoveryService->getRestaurantsForMap($filters);

        return response()->json([
            'success' => true,
            'data' => MapRestaurantResource::collection(collect($restaurants)),
        ]);
    }

    #[OA\Get(
        path: '/api/categories/{id}/top-restaurants',
        summary: 'Kategoriya bo\'yicha eng yuqori reytingli restoranlar',
        description: 'Berilgan kategoriyaga tegishli eng yuqori reytingli restoranlarni qaytaradi. Masalan: "Ommabop fast foodlar", "Ommabop restoranlar"',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Kategoriya ID', schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'limit', in: 'query', required: false, description: 'Natijalar soni (default: 10)', schema: new OA\Schema(type: 'integer', default: 10)),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Top restoranlar ro\'yxati',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Kategoriya topilmadi'
            )
        ]
    )]
    public function topByCategory(Request $request, int $categoryId): JsonResponse
    {
        $limit = $request->input('limit', 10);
        $restaurants = $this->discoveryService->getTopRestaurantsByCategory($categoryId, $limit);

        return response()->json([
            'success' => true,
            'data' => RestaurantListResource::collection($restaurants),
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/nearest',
        summary: 'Eng yaqin 5 ta restoran',
        description: 'Foydalanuvchi lokatsiyasiga eng yaqin 5 ta restoranni qaytaradi',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(name: 'lat', in: 'query', required: true, description: 'Latitude (kenglik)', schema: new OA\Schema(type: 'number', format: 'float')),
            new OA\Parameter(name: 'lng', in: 'query', required: true, description: 'Longitude (uzunlik)', schema: new OA\Schema(type: 'number', format: 'float')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Eng yaqin restoranlar',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validatsiya xatosi'
            )
        ]
    )]
    public function nearest(Request $request): JsonResponse
    {
        $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        $latitude = $request->input('lat');
        $longitude = $request->input('lng');

        $restaurants = $this->discoveryService->getNearestRestaurants($latitude, $longitude, 5);

        return response()->json([
            'success' => true,
            'data' => RestaurantListResource::collection($restaurants),
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/search',
        summary: 'Restoranlarni qidirish',
        description: 'Restoran nomi yoki brend nomi bo\'yicha qidiruv. Natijalar products (batafsil ma\'lumotlar) va maps (xarita uchun koordinatalar) formatida qaytariladi.',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(
                name: 'q',
                in: 'query',
                required: true,
                description: 'Qidiruv so\'rovi (kamida 2 ta harf)',
                schema: new OA\Schema(type: 'string', minLength: 2),
                example: 'mcdonald'
            ),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15)),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Qidiruv natijalari',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'products',
                                    type: 'array',
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: 'id', type: 'integer', example: 1),
                                            new OA\Property(property: 'restaurant_name', type: 'string', example: 'McDonald\'s Almaty Mall'),
                                            new OA\Property(property: 'category_name', type: 'string', example: 'Fast Food'),
                                            new OA\Property(property: 'avg_rating', type: 'number', format: 'float', example: 4.5),
                                            new OA\Property(property: 'reviews_count', type: 'integer', example: 128),
                                            new OA\Property(property: 'address', type: 'string', example: 'Rozybakiev St 247A'),
                                            new OA\Property(
                                                property: 'operating_hours',
                                                type: 'array',
                                                items: new OA\Items(
                                                    properties: [
                                                        new OA\Property(property: 'day_of_week', type: 'integer', example: 1),
                                                        new OA\Property(property: 'opening_time', type: 'string', example: '09:00'),
                                                        new OA\Property(property: 'closing_time', type: 'string', example: '22:00'),
                                                        new OA\Property(property: 'is_closed', type: 'boolean', example: false),
                                                    ]
                                                )
                                            ),
                                        ]
                                    )
                                ),
                                new OA\Property(
                                    property: 'maps',
                                    type: 'array',
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: 'id', type: 'integer', example: 1),
                                            new OA\Property(property: 'restaurant_name', type: 'string', example: 'McDonald\'s Almaty Mall'),
                                            new OA\Property(property: 'longitude', type: 'number', format: 'float', example: 76.9286),
                                            new OA\Property(property: 'latitude', type: 'number', format: 'float', example: 43.2220),
                                            new OA\Property(property: 'avg_rating', type: 'number', format: 'float', example: 4.5),
                                        ]
                                    )
                                ),
                            ]
                        ),
                        new OA\Property(
                            property: 'meta',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'current_page', type: 'integer', example: 1),
                                new OA\Property(property: 'last_page', type: 'integer', example: 3),
                                new OA\Property(property: 'per_page', type: 'integer', example: 15),
                                new OA\Property(property: 'total', type: 'integer', example: 42),
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validatsiya xatosi'
            )
        ]
    )]
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'q' => 'required|string|min:2',
            'per_page' => 'nullable|integer|min:1|max:50',
        ]);

        $query = $request->input('q');
        $perPage = $request->input('per_page', 15);
        $locale = $request->header('Accept-Language', 'kk');

        $restaurants = $this->discoveryService->searchRestaurantsWithDetails($query, $perPage);

        // Format products data
        $products = $restaurants->map(function ($restaurant) use ($locale) {
            // Get category name from translations
            $categoryName = null;
            if ($restaurant->categories->isNotEmpty()) {
                $category = $restaurant->categories->first();
                if ($category && $category->translations) {
                    $translation = $category->translations->firstWhere('lang_code', $locale);
                    $categoryName = $translation ? $translation->name : null;
                }
            }

            return [
                'id' => $restaurant->id,
                'restaurant_name' => $restaurant->branch_name,
                'category_name' => $categoryName,
                'avg_rating' => round($restaurant->reviews_avg_rating ?? 0, 1),
                'reviews_count' => $restaurant->reviews_count ?? 0,
                'address' => $restaurant->address,
                'operating_hours' => $restaurant->operatingHours->map(function ($hour) {
                    return [
                        'day_of_week' => $hour->day_of_week,
                        'opening_time' => $hour->opening_time,
                        'closing_time' => $hour->closing_time,
                        'is_closed' => (bool) $hour->is_closed,
                    ];
                }),
            ];
        });

        // Format maps data
        $maps = $restaurants->map(function ($restaurant) {
            return [
                'id' => $restaurant->id,
                'restaurant_name' => $restaurant->branch_name,
                'longitude' => $restaurant->longitude ? (float) $restaurant->longitude : null,
                'latitude' => $restaurant->latitude ? (float) $restaurant->latitude : null,
                'avg_rating' => round($restaurant->reviews_avg_rating ?? 0, 1),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'products' => $products,
                'maps' => $maps,
            ],
            'meta' => [
                'current_page' => $restaurants->currentPage(),
                'last_page' => $restaurants->lastPage(),
                'per_page' => $restaurants->perPage(),
                'total' => $restaurants->total(),
            ],
        ]);
    }

    #[OA\Get(
        path: '/api/restaurants/autocomplete',
        summary: 'Restoran nomini avtomatik to\'ldirish',
        description: 'Client har bir harf yozganda, shu harfdan BOSHLANADIGAN restoran nomlari qaytariladi. Real-time search uchun optimallashtirilgan - minimal ma\'lumotlar bilan tez javob beradi.',
        tags: ['Restoranlar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                description: 'Til kodi (uz, ru, kk, en). Default: kk',
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en'], default: 'kk')
            ),
            new OA\Parameter(
                name: 'q',
                in: 'query',
                required: true,
                description: 'Qidiruv so\'rovi (kamida 1 ta harf)',
                schema: new OA\Schema(type: 'string', minLength: 1),
                example: 'mcdo'
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Autocomplete natijalari',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', example: 1),
                                    new OA\Property(property: 'name', type: 'string', example: 'McDonald\'s Almaty Mall'),
                                    new OA\Property(property: 'brand_name', type: 'string', example: 'McDonald\'s'),
                                    new OA\Property(property: 'city_name', type: 'string', example: 'Алматы'),
                                    new OA\Property(property: 'average_rating', type: 'number', format: 'float', example: 4.5),
                                    new OA\Property(property: 'cover_image', type: 'string', nullable: true, example: 'https://example.com/storage/images/restaurant.jpg'),
                                ]
                            )
                        ),
                        new OA\Property(
                            property: 'meta',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'total', type: 'integer', example: 5),
                                new OA\Property(property: 'query', type: 'string', example: 'mcdo'),
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validatsiya xatosi - q parametri bo\'sh yoki noto\'g\'ri'
            )
        ]
    )]
    public function autocomplete(Request $request): JsonResponse
    {
        $request->validate([
            'q' => 'required|string|min:1',
        ]);

        $query = $request->input('q');
        $locale = $request->header('Accept-Language', 'kk');

        $restaurants = $this->discoveryService->autocompleteRestaurants($query);

        // Format lightweight response for autocomplete
        $data = $restaurants->map(function ($restaurant) use ($locale) {
            // Get brand name from translations
            $brandName = null;
            if ($restaurant->brand && $restaurant->brand->translations) {
                $translation = $restaurant->brand->translations->firstWhere('lang_code', $locale);
                $brandName = $translation ? $translation->name : null;
            }

            // Get city name from translations
            $cityName = null;
            if ($restaurant->city && $restaurant->city->translations) {
                $translation = $restaurant->city->translations->firstWhere('lang_code', $locale);
                $cityName = $translation ? $translation->name : null;
            }

            return [
                'id' => $restaurant->id,
                'name' => $restaurant->branch_name,
                'brand_name' => $brandName,
                'city_name' => $cityName,
                'average_rating' => round($restaurant->reviews_avg_rating ?? 0, 1),
                'cover_image' => $restaurant->coverImage?->image_path
                    ? asset('storage/' . $restaurant->coverImage->image_path)
                    : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'total' => $data->count(),
                'query' => $query,
            ],
        ]);
    }
}
