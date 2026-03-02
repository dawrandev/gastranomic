<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Restaurant",
    required: ["id", "brand_id", "city_id", "branch_name", "phone", "address"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Restoran ID",
            example: 1
        ),
        new OA\Property(
            property: "user_id",
            type: "integer",
            description: "Admin foydalanuvchi ID",
            example: 1
        ),
        new OA\Property(
            property: "brand_id",
            type: "integer",
            description: "Brand ID",
            example: 1
        ),
        new OA\Property(
            property: "city_id",
            type: "integer",
            description: "Shahar ID",
            example: 1
        ),
        new OA\Property(
            property: "branch_name",
            type: "string",
            description: "Filial nomi",
            example: "Chilonzor filiali"
        ),
        new OA\Property(
            property: "phone",
            type: "string",
            description: "Telefon raqami",
            example: "+998712345678"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            nullable: true,
            description: "Restoran tavsifi",
            example: "Eng mazali taomlar"
        ),
        new OA\Property(
            property: "address",
            type: "string",
            description: "Manzil",
            example: "Chilonzor ko'chasi, 12"
        ),
        new OA\Property(
            property: "latitude",
            type: "number",
            format: "float",
            nullable: true,
            description: "Kenglik (latitude)",
            example: 41.311151
        ),
        new OA\Property(
            property: "longitude",
            type: "number",
            format: "float",
            nullable: true,
            description: "Uzunlik (longitude)",
            example: 69.240562
        ),
        new OA\Property(
            property: "is_active",
            type: "boolean",
            description: "Faolmi",
            example: true
        ),
        new OA\Property(
            property: "qr_code",
            type: "string",
            nullable: true,
            description: "QR kod URL",
            example: "https://example.com/storage/qr-codes/restaurant-1.png"
        ),
        new OA\Property(
            property: "avg_rating",
            type: "number",
            format: "float",
            nullable: true,
            description: "O'rtacha reyting",
            example: 4.5,
            minimum: 0,
            maximum: 5
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
class RestaurantSchema {}
