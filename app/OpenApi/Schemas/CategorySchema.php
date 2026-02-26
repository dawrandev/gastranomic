<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Category",
    required: ["id", "name", "icon"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Kategoriya ID",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            description: "Kategoriya nomi (tarjima qilingan)",
            example: "Fast Food"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            nullable: true,
            description: "Kategoriya tavsifi (tarjima qilingan)",
            example: "Tez tayyorlaniladigan ovqatlar"
        ),
        new OA\Property(
            property: "icon",
            type: "string",
            format: "uri",
            description: "Kategoriya icon URL (MAJBURIY - admin panel orqali yuklanadi)",
            example: "https://example.com/storage/categories/icons/fastfood.png"
        ),
    ]
)]
class CategorySchema {}
