<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "QuestionOption",
    required: ["id", "questions_category_id", "key"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Javob varianti ID",
            example: 1
        ),
        new OA\Property(
            property: "questions_category_id",
            type: "integer",
            description: "Savol kategoriyasi ID",
            example: 1
        ),
        new OA\Property(
            property: "key",
            type: "string",
            description: "Javob kalit nomi (tarjimalar uchun)",
            example: "delicious_food"
        ),
        new OA\Property(
            property: "text",
            type: "string",
            description: "Javob matni (tarjima qilingan)",
            example: "Mazali taomlar"
        ),
        new OA\Property(
            property: "sort_order",
            type: "integer",
            description: "Tartiblash raqami",
            example: 1
        ),
        new OA\Property(
            property: "is_active",
            type: "boolean",
            description: "Faolmi",
            example: true
        ),
        new OA\Property(
            property: "created_at",
            type: "string",
            format: "date-time",
            description: "Yaratilgan vaqt",
            example: "2024-01-15T10:30:00.000000Z"
        ),
        new OA\Property(
            property: "updated_at",
            type: "string",
            format: "date-time",
            description: "Yangilangan vaqt",
            example: "2024-01-15T10:30:00.000000Z"
        ),
    ]
)]
class QuestionOptionSchema {}
