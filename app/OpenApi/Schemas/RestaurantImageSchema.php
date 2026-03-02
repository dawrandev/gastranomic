<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "RestaurantImage",
    required: ["id", "restaurant_id", "image_path"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Rasm ID",
            example: 1
        ),
        new OA\Property(
            property: "restaurant_id",
            type: "integer",
            description: "Restoran ID",
            example: 1
        ),
        new OA\Property(
            property: "image_path",
            type: "string",
            format: "uri",
            description: "Rasm URL",
            example: "https://example.com/storage/restaurants/images/restaurant-1.jpg"
        ),
        new OA\Property(
            property: "is_cover",
            type: "boolean",
            description: "Asosiy (cover) rasmmi",
            example: false
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
class RestaurantImageSchema {}
