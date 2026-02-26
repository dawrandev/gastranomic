<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Brand",
    required: ["id", "name", "logo"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Brand ID",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            description: "Brand nomi (tarjima qilingan)",
            example: "KFC"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            nullable: true,
            description: "Brand tavsifi (tarjima qilingan)",
            example: "Kentucky Fried Chicken"
        ),
        new OA\Property(
            property: "logo",
            type: "string",
            format: "uri",
            description: "Brand logotipi URL (MAJBURIY - admin panel orqali yuklanadi)",
            example: "https://example.com/storage/brands/logos/kfc.png"
        ),
        new OA\Property(
            property: "avg_rating",
            type: "number",
            format: "float",
            nullable: true,
            description: "O'rtacha reyting (agar reviewlar bo'lsa)",
            example: 4.5,
            minimum: 0,
            maximum: 5
        ),
    ]
)]
class BrandSchema {}
