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
        summary: 'Savollarni olish',
        description: 'Restoran sharhi qoldirganda foydalanuvchiga ko\'rsatiladigan barcha savollar va ularning javob variantlarini qaytaradi. Har bir savol options arrayida bo\'sh (open-ended) yoki to\'li (multiple-choice) bo\'ladi. is_required field\'i majburi yoki ixtiyoriy ekanligini ko\'rsatadi.',
        tags: ['Savollar'],
        parameters: [
            new OA\Parameter(
                name: 'Accept-Language',
                in: 'header',
                required: false,
                schema: new OA\Schema(type: 'string', enum: ['uz', 'ru', 'kk', 'en']),
                description: 'Til tanlang. Qiymatlari: uz, ru, kk, en. Default: ru'
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
                            description: 'Savol kategoriyalarining massivi',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: 'id',
                                        type: 'integer',
                                        description: 'Savol ID\'si',
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: 'key',
                                        type: 'string',
                                        description: 'Savolning unikal kaliti. Frontend POST request\'da selected_option_ids\'ni jo\'natishda ishlatiladi',
                                        example: 'overall_satisfied'
                                    ),
                                    new OA\Property(
                                        property: 'title',
                                        type: 'string',
                                        description: 'Savolning tarjimali nomi (Accept-Language bo\'yicha)',
                                        example: 'В целом всё понравилось?'
                                    ),
                                    new OA\Property(
                                        property: 'description',
                                        type: 'string',
                                        nullable: true,
                                        description: 'Savolning qo\'shimcha izohи (agar mavjud bo\'lsa)',
                                        example: null
                                    ),
                                    new OA\Property(
                                        property: 'is_required',
                                        type: 'boolean',
                                        description: 'Majburi savol - TRUE bo\'lsa, RED * asterisk ko\'rsating. FALSE bo\'lsa, asterisk ko\'rsatmang',
                                        example: true
                                    ),
                                    new OA\Property(
                                        property: 'sort_order',
                                        type: 'integer',
                                        description: 'Savol taribi (qaysi ketma-ketlikda ko\'rsatish kerak)',
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: 'options',
                                        type: 'array',
                                        description: 'Javob variantlari. BOŠ bo\'lsa - text input ko\'rsating. TO\'LI bo\'lsa - radio/dropdown ko\'rsating',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'Javob variantining ID\'si. POST request\'da selected_option_ids\'ga kiriting',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'key',
                                                    type: 'string',
                                                    description: 'Variantning unikal kaliti',
                                                    example: 'breakfast'
                                                ),
                                                new OA\Property(
                                                    property: 'text',
                                                    type: 'string',
                                                    description: 'Variantning tarjimali nomi',
                                                    example: 'Завтрак'
                                                ),
                                                new OA\Property(
                                                    property: 'sort_order',
                                                    type: 'integer',
                                                    description: 'Variantni ko\'rsatish taribi',
                                                    example: 0
                                                ),
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
