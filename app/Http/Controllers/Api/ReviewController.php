<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    #[OA\Get(
        path: '/api/restaurants/{id}/reviews',
        summary: 'Restoran sharhlari',
        description: 'Restoranga qoldirilgan barcha sharhlar va statistika',
        tags: ['⭐ Sharhlar'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Restaurant reviews list',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'object')),
                        new OA\Property(property: 'statistics', type: 'object'),
                        new OA\Property(property: 'meta', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function index(Request $request, int $restaurantId): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $reviews = $this->reviewService->getRestaurantReviews($restaurantId, $perPage);

        // Get statistics
        $stats = $this->reviewService->getRestaurantReviewStats($restaurantId);

        return response()->json([
            'success' => true,
            'data' => ReviewResource::collection($reviews),
            'statistics' => $stats,
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'per_page' => $reviews->perPage(),
                'total' => $reviews->total(),
            ],
        ]);
    }

    #[OA\Post(
        path: '/api/restaurants/{id}/reviews',
        summary: 'Restoranga sharh qoldirish',
        description: 'Restoranga reyting, izoh va savollar javoblarini qoldirish. Avval GET /api/questions endpoint\'dan savollarni oling. selected_option_ids arrayiga faqat multiple-choice savollari (options mavjud bo\'lgan savollar) uchun option ID\'larini kiriting. Limit: 3 sharh/kun per restaurant.',
        security: [['bearerAuth' => []], []],
        tags: ['⭐ Sharhlar'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['device_id', 'rating'],
                example: [
                    'device_id' => 'device-123',
                    'rating' => 5,
                    'comment' => 'Juda zo\'r restoran, taomlar mazali!',
                    'phone' => '+998901234567',
                    'selected_option_ids' => [2, 7]
                ],
                properties: [
                    new OA\Property(
                        property: 'device_id',
                        type: 'string',
                        description: 'Qurilmaning unikal ID\'si (UUID yoki fingerprint). Limit o\'rnatishda ishlatiladi',
                        maxLength: 100,
                        example: 'device-123'
                    ),
                    new OA\Property(
                        property: 'rating',
                        type: 'integer',
                        description: 'Restoran reytingi (1 = juda yomon, 5 = ajoyib)',
                        minimum: 1,
                        maximum: 5,
                        example: 5
                    ),
                    new OA\Property(
                        property: 'comment',
                        type: 'string',
                        description: 'Foydalanuvchining izohи (ixtiyoriy, maksimum 1000 belgi)',
                        maxLength: 1000,
                        nullable: true,
                        example: 'Juda zo\'r restoran, taomlar mazali!'
                    ),
                    new OA\Property(
                        property: 'phone',
                        type: 'string',
                        description: 'Foydalanuvchining telefon raqami (ixtiyoriy, maksimum 20 belgi)',
                        maxLength: 20,
                        nullable: true,
                        example: '+998901234567'
                    ),
                    new OA\Property(
                        property: 'selected_option_ids',
                        type: 'array',
                        description: 'Tanlangan savol variantlarining ID\'lari (ixtiyoriy). GET /api/questions\'dan olgan option ID\'larini kiriting',
                        nullable: true,
                        items: new OA\Items(type: 'integer', description: 'Javob variantining ID\'si'),
                        example: [2, 7]
                    )
                ]
            )
        ),
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Sharh muvaffaqiyatli yaratildi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Review submitted successfully'),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            description: 'Yaratilgan sharh ma\'lumotlari',
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 42),
                                new OA\Property(property: 'rating', type: 'integer', example: 5),
                                new OA\Property(property: 'comment', type: 'string', example: 'Juda zo\'r!'),
                                new OA\Property(
                                    property: 'selected_answers',
                                    type: 'array',
                                    description: 'Foydalanuvchi tanlagan javob variantlari (tarjimada)',
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: 'id', type: 'integer', description: 'Javob variantining ID\'si', example: 7),
                                            new OA\Property(property: 'key', type: 'string', description: 'Variantning unikal kaliti', example: 'lunch'),
                                            new OA\Property(property: 'text', type: 'string', description: 'Variantning tarjimali nomи (tanlangan tilga qarab)', example: 'Ланч'),
                                        ]
                                    )
                                ),
                                new OA\Property(property: 'created_at', type: 'string', example: '2024-01-15 10:30:00'),
                            ]
                        ),
                        new OA\Property(
                            property: 'rate_limit',
                            type: 'object',
                            description: 'Kun\'lik sharh limitini ko\'rsatish',
                            properties: [
                                new OA\Property(property: 'remaining', type: 'integer', description: 'Qolgan sharh soni (bu restoranga uchun bugun)', example: 2),
                                new OA\Property(property: 'reset_at', type: 'string', description: 'Limit qayta tiklanish vaqti (keyingi kun boshida)', example: '2024-01-16 00:00:00'),
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation Error - Ma\'lumotlar xato yoki to\'liq emas',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid'),
                        new OA\Property(
                            property: 'errors',
                            type: 'object',
                            description: 'Xato maydonlari va ularning xabar-xabarlari',
                            properties: [
                                new OA\Property(property: 'device_id', type: 'array', items: new OA\Items(type: 'string'), example: ['device_id field is required']),
                                new OA\Property(property: 'rating', type: 'array', items: new OA\Items(type: 'string'), example: ['rating must be between 1 and 5']),
                                new OA\Property(property: 'selected_option_ids.*', type: 'array', items: new OA\Items(type: 'string'), example: ['selected option id does not exist']),
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 429,
                description: 'Rate limit exceeded - Foydalanuvchi bu restoranga kun\'da maksimal miqdorda sharh qoldirgan (limit: 3 ta)',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: false),
                        new OA\Property(property: 'message', type: 'string', example: 'You have reached the maximum number of reviews for this restaurant today. Please try again tomorrow.'),
                        new OA\Property(
                            property: 'rate_limit',
                            type: 'object',
                            description: 'Limit haqida ma\'lumotlar',
                            properties: [
                                new OA\Property(property: 'can_review', type: 'boolean', example: false, description: 'Sharh qoldirishi mumkinmi?'),
                                new OA\Property(property: 'reviews_count', type: 'integer', example: 3, description: 'Bu kun qoldirgan sharh soni'),
                                new OA\Property(property: 'remaining', type: 'integer', example: 0, description: 'Qolgan sharh soni (0 = limit to\'ldi)'),
                                new OA\Property(property: 'reset_at', type: 'string', example: '2024-01-16 00:00:00', description: 'Limit qayta tiklanish vaqti (keyingi kun boshida)'),
                            ]
                        ),
                    ]
                )
            )
        ]
    )]
    public function store(StoreReviewRequest $request, int $restaurantId): JsonResponse
    {
        $validated = $request->validated();
        $deviceId = $validated['device_id'];
        $ipAddress = $request->ip();

        // Check rate limiting
        $rateLimitCheck = $this->reviewService->canDeviceReview($deviceId, $ipAddress, $restaurantId);

        if (!$rateLimitCheck['can_review']) {
            return response()->json([
                'success' => false,
                'message' => 'You have reached the maximum number of reviews for this restaurant today. Please try again tomorrow.',
                'rate_limit' => $rateLimitCheck,
            ], 429);
        }

        // Get authenticated client if exists (nullable for guest support)
        // OptionalAuthMiddleware automatically sets user if token is valid
        $clientId = $request->user()?->id;

        $review = $this->reviewService->createOrUpdateReview(
            $clientId,
            $restaurantId,
            [
                ...$validated,
                'ip_address' => $ipAddress,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully',
            'data' => new ReviewResource($review),
            'rate_limit' => [
                'remaining' => $rateLimitCheck['remaining'] - 1,
                'reset_at' => $rateLimitCheck['reset_at'],
            ],
        ], 201);
    }

    #[OA\Put(
        path: '/api/reviews/{id}',
        summary: 'Sharhni yangilash',
        description: 'O\'z sharhingizni yangilash. Faqat authenticated users uchun.',
        security: [['sanctum' => []]],
        tags: ['⭐ Sharhlar'],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'rating',
                        type: 'integer',
                        description: 'Reyting (1 dan 5 gacha)',
                        minimum: 1,
                        maximum: 5,
                        example: 4,
                        nullable: true
                    ),
                    new OA\Property(
                        property: 'comment',
                        type: 'string',
                        description: 'Izoh (ixtiyoriy, maksimum 1000 belgi)',
                        maxLength: 1000,
                        nullable: true,
                        example: 'Yangilangan izoh'
                    ),
                    new OA\Property(
                        property: 'phone',
                        type: 'string',
                        description: 'Telefon raqami (ixtiyoriy, maksimum 20 belgi)',
                        maxLength: 20,
                        nullable: true,
                        example: '+998901234567'
                    )
                ]
            )
        ),
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Review updated',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string'),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            ),
            new OA\Response(
                response: 403,
                description: 'Forbidden'
            ),
            new OA\Response(
                response: 404,
                description: 'Review not found'
            )
        ]
    )]
    public function update(UpdateReviewRequest $request, int $id): JsonResponse
    {
        $client = $request->user();
        $review = \App\Models\Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found',
            ], 404);
        }

        if ($review->client_id !== $client->id) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to edit this review',
            ], 403);
        }

        $review = $this->reviewService->updateReview($review, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully',
            'data' => new ReviewResource($review),
        ]);
    }

    #[OA\Delete(
        path: '/api/reviews/{id}',
        summary: 'Sharhni o\'chirish',
        description: 'O\'z sharhingizni o\'chirish. Faqat authenticated users uchun.',
        security: [['sanctum' => []]],
        tags: ['⭐ Sharhlar'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Review deleted',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string'),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            ),
            new OA\Response(
                response: 403,
                description: 'Forbidden'
            ),
            new OA\Response(
                response: 404,
                description: 'Review not found'
            )
        ]
    )]
    public function destroy(Request $request, int $id): JsonResponse
    {
        $client = $request->user();
        $review = \App\Models\Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found',
            ], 404);
        }

        if ($review->client_id !== $client->id) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete this review',
            ], 403);
        }

        $this->reviewService->deleteReview($review);

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully',
        ]);
    }
}
