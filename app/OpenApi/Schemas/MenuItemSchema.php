<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "MenuItem",
    required: ["id", "name", "image_path", "base_price"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Menu item ID",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            description: "Taom nomi (tarjima qilingan)",
            example: "Burger"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            nullable: true,
            description: "Taom tavsifi (tarjima qilingan)",
            example: "Mazali beef burger kartoshka bilan"
        ),
        new OA\Property(
            property: "image_path",
            type: "string",
            format: "uri",
            description: "Taom rasmi URL (MAJBURIY - admin panel orqali yuklanadi)",
            example: "https://example.com/storage/menu-items/burger.jpg"
        ),
        new OA\Property(
            property: "base_price",
            type: "number",
            format: "decimal",
            description: "Taom bazaviy narxi (so'm)",
            example: 25000.00
        ),
        new OA\Property(
            property: "weight",
            type: "integer",
            nullable: true,
            description: "Taom og'irligi (gramm)",
            example: 350
        ),
    ]
)]
class MenuItemSchema {}
