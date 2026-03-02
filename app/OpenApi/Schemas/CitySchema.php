<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "City",
    required: ["id", "name"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Shahar ID",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            description: "Shahar nomi (tarjima qilingan)",
            example: "Toshkent"
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
class CitySchema {}
