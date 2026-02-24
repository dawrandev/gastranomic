<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

class ProfileController extends Controller
{
    #[OA\Get(
        path: '/api/profile',
        summary: 'Client profil ma\'lumotlari',
        description: 'Login qilgan clientning to\'liq profil ma\'lumotlari va statistikasi',
        security: [['bearerAuth' => []]],
        tags: ['Profil'],
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
                description: 'Profil ma\'lumotlari',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                new OA\Property(property: 'first_name', type: 'string', example: 'Abdulla'),
                                new OA\Property(property: 'last_name', type: 'string', example: 'Valiyev'),
                                new OA\Property(property: 'full_name', type: 'string', example: 'Abdulla Valiyev'),
                                new OA\Property(property: 'phone', type: 'string', example: '998901234567'),
                                new OA\Property(property: 'image_path', type: 'string', nullable: true, example: 'https://example.com/storage/clients/photo.jpg'),
                                new OA\Property(
                                    property: 'statistics',
                                    type: 'object',
                                    properties: [
                                        new OA\Property(property: 'total_reviews', type: 'integer', example: 15),
                                        new OA\Property(property: 'five_star_reviews', type: 'integer', example: 8),
                                        new OA\Property(property: 'favorites_count', type: 'integer', example: 5),
                                    ]
                                ),
                                new OA\Property(property: 'reviews', type: 'array', items: new OA\Items(type: 'object')),
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Autentifikatsiya xatosi'
            )
        ]
    )]
    public function show(Request $request): JsonResponse
    {
        $client = $request->user();

        // Get statistics
        $totalReviews = $client->reviews()->count();
        $fiveStarReviews = $client->reviews()->where('rating', 5)->count();
        $favoritesCount = $client->favorites()->count();

        // Get all reviews with restaurant info
        $reviews = $client->reviews()
            ->with(['restaurant:id,branch_name', 'restaurant.coverImage:id,restaurant_id,image_path'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'full_name' => $client->full_name,
                'phone' => $client->phone,
                'image_path' => $client->image_path ? asset('storage/' . $client->image_path) : null,
                'statistics' => [
                    'total_reviews' => $totalReviews,
                    'five_star_reviews' => $fiveStarReviews,
                    'favorites_count' => $favoritesCount,
                ],
                'reviews' => ReviewResource::collection($reviews),
            ],
        ]);
    }

    #[OA\Post(
        path: '/api/profile',
        summary: 'Profil ma\'lumotlarini yangilash',
        description: 'Client ism, familiya va rasmini yangilash',
        security: [['bearerAuth' => []]],
        tags: ['Profil'],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: 'first_name',
                            type: 'string',
                            description: 'Ism',
                            example: 'Abdulla',
                            nullable: true
                        ),
                        new OA\Property(
                            property: 'last_name',
                            type: 'string',
                            description: 'Familiya',
                            example: 'Valiyev',
                            nullable: true
                        ),
                        new OA\Property(
                            property: 'image',
                            type: 'string',
                            format: 'binary',
                            description: 'Profil rasmi (maksimum 2MB)',
                            nullable: true
                        ),
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profil muvaffaqiyatli yangilandi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Profil muvaffaqiyatli yangilandi'),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validatsiya xatosi'
            )
        ]
    )]
    public function update(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validatsiya xatosi',
                'errors' => $validator->errors()
            ], 422);
        }

        $client = $request->user();
        $data = [];

        if ($request->filled('first_name')) {
            $data['first_name'] = $request->first_name;
        }

        if ($request->filled('last_name')) {
            $data['last_name'] = $request->last_name;
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($client->image_path) {
                Storage::disk('public')->delete($client->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('clients', 'public');
            $data['image_path'] = $imagePath;
        }

        $client->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'full_name' => $client->full_name,
                'phone' => $client->phone,
                'image_path' => $client->image_path ? asset('storage/' . $client->image_path) : null,
            ],
        ]);
    }
}
