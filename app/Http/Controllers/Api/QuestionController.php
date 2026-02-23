<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionCategoryResource;
use App\Models\QuestionCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class QuestionController extends Controller
{
    #[OA\Get(
        path: '/api/questions',
        summary: 'Barcha savol kategoriyalari',
        description: 'Sharh berishda ko\'rsatiladigan savollar va javob variantlari. Har bir kategoriya ko\'p variantli savolni o\'z ichiga oladi.',
        tags: ['❓ Savollar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en']),
                description: 'Tilni belgilash (uz, ru, kk, en)'
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Question categories with options',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer'),
                                    new OA\Property(property: 'key', type: 'string'),
                                    new OA\Property(property: 'title', type: 'string'),
                                    new OA\Property(property: 'description', type: 'string', nullable: true),
                                    new OA\Property(property: 'is_required', type: 'boolean'),
                                    new OA\Property(property: 'sort_order', type: 'integer'),
                                    new OA\Property(
                                        property: 'options',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(property: 'id', type: 'integer'),
                                                new OA\Property(property: 'key', type: 'string'),
                                                new OA\Property(property: 'text', type: 'string'),
                                                new OA\Property(property: 'sort_order', type: 'integer'),
                                            ]
                                        )
                                    )
                                ]
                            )
                        ),
                    ]
                )
            )
        ]
    )]
    public function index(): JsonResponse
    {
        $categories = QuestionCategory::where('is_active', true)
            ->with(['options' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => QuestionCategoryResource::collection($categories),
        ]);
    }
}
