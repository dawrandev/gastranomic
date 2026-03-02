<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "User",
    required: ["id", "name", "login"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            description: "Foydalanuvchi ID",
            example: 1
        ),
        new OA\Property(
            property: "brand_id",
            type: "integer",
            nullable: true,
            description: "Brand ID (agar brand egasi bo'lsa)",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            description: "Ism-familiya",
            example: "Alisher Navoiy"
        ),
        new OA\Property(
            property: "login",
            type: "string",
            description: "Login (noyob)",
            example: "admin"
        ),
        new OA\Property(
            property: "fcm_token",
            type: "string",
            nullable: true,
            description: "Firebase Cloud Messaging token (push notifications uchun)",
            example: "dGhpc19pc19hX2ZjbV90b2tlbl9leGFtcGxl"
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
class UserSchema {}
