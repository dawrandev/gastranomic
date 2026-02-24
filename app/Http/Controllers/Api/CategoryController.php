<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    #[OA\Get(
        path: '/api/categories',
        summary: 'Barcha kategoriyalar ro\'yxati',
        description: 'Accept-Language header orqali berilgan tildagi barcha kategoriya tarjimalarini qaytaradi',
        tags: ['Kategoriyalar'],
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
                description: 'Kategoriyalar ro\'yxati',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', example: 1),
                                    new OA\Property(property: 'name', type: 'string', example: 'Fast Food'),
                                    new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Tez tayyorlaniladigan ovqat'),
                                    new OA\Property(property: 'icon', type: 'string', nullable: true, example: 'https://example.com/storage/categories/icons/icon.png'),
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
        $categories = Category::with('translations')->get();

        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection($categories),
        ]);
    }
}
