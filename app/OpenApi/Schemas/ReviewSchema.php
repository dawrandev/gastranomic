<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Review",
    required: ["id", "restaurant_id", "device_id", "rating"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Sharh ID",
            example: 1
        ),
        new OA\Property(
            property: "restaurant_id",
            type: "integer",
            description: "Restoran ID",
            example: 1
        ),
        new OA\Property(
            property: "device_id",
            type: "string",
            description: "Qurilma ID (UUID, fingerprint yoki MAC address)",
            example: "device-uuid-123"
        ),
        new OA\Property(
            property: "ip_address",
            type: "string",
            nullable: true,
            description: "IP manzil",
            example: "192.168.1.1"
        ),
        new OA\Property(
            property: "phone",
            type: "string",
            nullable: true,
            description: "Telefon raqami (ixtiyoriy)",
            example: "+998901234567"
        ),
        new OA\Property(
            property: "email",
            type: "string",
            format: "email",
            nullable: true,
            description: "Email manzil (ixtiyoriy)",
            example: "user@example.com"
        ),
        new OA\Property(
            property: "rating",
            type: "integer",
            description: "Reyting (1-5)",
            example: 5,
            minimum: 1,
            maximum: 5
        ),
        new OA\Property(
            property: "comment",
            type: "string",
            nullable: true,
            description: "Umumiy izoh (deprecated, comments array ishlating)",
            example: "Juda zo'r restoran!"
        ),
        new OA\Property(
            property: "comments",
            type: "array",
            nullable: true,
            description: "Savolga javob izohlar (open-ended questions)",
            items: new OA\Items(
                type: "object",
                properties: [
                    new OA\Property(
                        property: "question_id",
                        type: "integer",
                        description: "Savol ID",
                        example: 8
                    ),
                    new OA\Property(
                        property: "text",
                        type: "string",
                        description: "Javob matni",
                        example: "Xizmat juda yaxshi bo'ldi"
                    )
                ]
            )
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
class ReviewSchema {}
