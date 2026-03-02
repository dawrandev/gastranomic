<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "MenuSection",
    required: ["id", "brand_id", "name"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Menyu bo'limi ID",
            example: 1
        ),
        new OA\Property(
            property: "brand_id",
            type: "integer",
            description: "Brand ID",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            description: "Bo'lim nomi (tarjima qilingan)",
            example: "Burgerlar"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            nullable: true,
            description: "Bo'lim tavsifi (tarjima qilingan)",
            example: "Turli xil burgerlar"
        ),
        new OA\Property(
            property: "sort_order",
            type: "integer",
            description: "Tartiblash raqami",
            example: 1
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
class MenuSectionSchema {}
