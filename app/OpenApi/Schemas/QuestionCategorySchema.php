<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "QuestionCategory",
    required: ["id", "key", "is_active"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Savol kategoriyasi ID",
            example: 1
        ),
        new OA\Property(
            property: "parent_category_id",
            type: "integer",
            nullable: true,
            description: "Asosiy kategoriya ID (sub-question uchun)",
            example: null
        ),
        new OA\Property(
            property: "key",
            type: "string",
            description: "Savol kalit nomi (tarjimalar uchun)",
            example: "what_did_you_like"
        ),
        new OA\Property(
            property: "title",
            type: "string",
            description: "Savol sarlavhasi (tarjima qilingan)",
            example: "Sizga nima yoqdi?"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            nullable: true,
            description: "Savol tavsifi (tarjima qilingan)",
            example: "Iltimos, yoqqan narsalarni tanlang"
        ),
        new OA\Property(
            property: "sort_order",
            type: "integer",
            description: "Tartiblash raqami",
            example: 1
        ),
        new OA\Property(
            property: "is_required",
            type: "boolean",
            description: "Majburiy savol yoki yo'q",
            example: false
        ),
        new OA\Property(
            property: "is_active",
            type: "boolean",
            description: "Faolmi",
            example: true
        ),
        new OA\Property(
            property: "condition",
            type: "object",
            nullable: true,
            description: "Savol ko'rsatish sharti (masalan, rating <= 3 bo'lsa)",
            properties: [
                new OA\Property(
                    property: "field",
                    type: "string",
                    example: "rating"
                ),
                new OA\Property(
                    property: "operator",
                    type: "string",
                    example: "<="
                ),
                new OA\Property(
                    property: "value",
                    type: "integer",
                    example: 3
                )
            ]
        ),
        new OA\Property(
            property: "allow_multiple",
            type: "boolean",
            description: "Ko'p variant tanlash mumkinmi",
            example: true
        ),
        new OA\Property(
            property: "options",
            type: "array",
            description: "Javob variantlari (multiple choice questions uchun)",
            items: new OA\Items(ref: "#/components/schemas/QuestionOption")
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
class QuestionCategorySchema {}
