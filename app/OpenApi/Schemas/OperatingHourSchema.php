<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OperatingHour",
    required: ["id", "restaurant_id", "day_of_week"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Ish vaqti ID",
            example: 1
        ),
        new OA\Property(
            property: "restaurant_id",
            type: "integer",
            description: "Restoran ID",
            example: 1
        ),
        new OA\Property(
            property: "day_of_week",
            type: "integer",
            description: "Hafta kuni (0=Yakshanba, 1=Dushanba, ..., 6=Shanba)",
            example: 1,
            minimum: 0,
            maximum: 6
        ),
        new OA\Property(
            property: "opening_time",
            type: "string",
            format: "time",
            nullable: true,
            description: "Ochilish vaqti (HH:MM format)",
            example: "09:00"
        ),
        new OA\Property(
            property: "closing_time",
            type: "string",
            format: "time",
            nullable: true,
            description: "Yopilish vaqti (HH:MM format)",
            example: "22:00"
        ),
        new OA\Property(
            property: "is_closed",
            type: "boolean",
            description: "Dam olish kunimi",
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
class OperatingHourSchema {}
