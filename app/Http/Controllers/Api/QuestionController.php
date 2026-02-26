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
        summary: 'Sharh formasining savollarini olish',
        description: 'Restoran sharhi qoldirganda foydalanuvchiga ko\'rsatiladigan barcha savollar va ularning javob variantlarini qaytaradi.',
        tags: ['Savollar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en']),
                description: 'Javob tilini tanlang (default: ru). Barcha savol va option textlari bu tilda qaytariladi'
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Savollar muvaffaqiyatli qaytadi',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            description: 'Asosiy savollar ro\'yxati (4 ta savol: overall_satisfied, visit_category, would_return_again, additional_comments)',
                            items: new OA\Items(
                                type: 'object',
                                properties: [
                                    new OA\Property(
                                        property: 'id',
                                        type: 'integer',
                                        description: 'Savol ID\'si',
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: 'title',
                                        type: 'string',
                                        description: 'Savol matni (tanlangan tilga qarab)',
                                        example: 'В целом всё понравилось?'
                                    ),
                                    new OA\Property(
                                        property: 'is_required',
                                        type: 'boolean',
                                        description: 'Majburi savol (TRUE = red asterisk ko\'rsating)',
                                        example: true
                                    ),
                                    new OA\Property(
                                        property: 'allow_multiple',
                                        type: 'boolean',
                                        description: 'Bir nechta javob tanlash mumkinmi (checkbox uchun)',
                                        example: false
                                    ),
                                    new OA\Property(
                                        property: 'sort_order',
                                        type: 'integer',
                                        description: 'Ko\'rsatish tartibi (0 = birinchi)',
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: 'options',
                                        type: 'array',
                                        description: 'Javob variantlari (bo\'sh = text input, to\'li = radio/dropdown/checkbox)',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'Option ID - BUNI POST request\'da selected_option_ids\'ga kiriting',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'text',
                                                    type: 'string',
                                                    description: 'Option matni',
                                                    example: 'Завтрак'
                                                ),
                                            ]
                                        )
                                    ),
                                    new OA\Property(
                                        property: 'sub_questions',
                                        type: 'array',
                                        description: 'Shartli sub-savollar (faqat rating bo\'yicha ko\'rsatiladi)',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    example: 2
                                                ),
                                                new OA\Property(
                                                    property: 'title',
                                                    type: 'string',
                                                    example: 'A. Sizga nima yoqmadi?'
                                                ),
                                                new OA\Property(
                                                    property: 'is_required',
                                                    type: 'boolean',
                                                    example: false
                                                ),
                                                new OA\Property(
                                                    property: 'allow_multiple',
                                                    type: 'boolean',
                                                    example: true
                                                ),
                                                new OA\Property(
                                                    property: 'condition',
                                                    type: 'object',
                                                    description: 'Qachon ko\'rsatish: "rating" <= 3 yoki >= 4',
                                                    example: ['field' => 'rating', 'operator' => '<=', 'value' => 3]
                                                ),
                                                new OA\Property(
                                                    property: 'options',
                                                    type: 'array',
                                                    items: new OA\Items(type: 'object')
                                                ),
                                            ]
                                        )
                                    ),
                                ]
                            )
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Server xatosi'
            )
        ]
    )]
    public function index(): JsonResponse
    {
        $categories = QuestionCategory::where('is_active', true)
            ->whereNull('parent_category_id') // Only parent questions
            ->with([
                'options' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('sort_order');
                },
                'children' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('sort_order');
                },
                'children.options' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('sort_order');
                }
            ])
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => QuestionCategoryResource::collection($categories),
        ]);
    }
}
