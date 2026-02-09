# Brand API Guide

## Yaratilgan yangi funksiyalar

### 1. Database struktura
- **BrandTranslation** model yaratildi
- **brand_translations** jadvali migration yaratildi
- **Brand** modeli yangilandi - tarjima funksiyalari qo'shildi

### 2. API Endpoints

#### 2.1 Barcha brandlarni olish
```
GET /api/brands
```

**Headers:**
```
Accept-Language: uz | ru | kk | en (default: kk)
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "KFC",
      "description": "Кентукки Қуырылған Тауық",
      "logo": "https://example.com/storage/brands/logos/kfc.png"
    },
    {
      "id": 2,
      "name": "McDonald's",
      "description": "Тез тамақтану мекемелер желісі",
      "logo": null
    }
  ]
}
```

#### 2.2 Brand bo'yicha restaurantlar
```
GET /api/restaurants/brand/{brand_id}
```

**Headers:**
```
Accept-Language: uz | ru | kk | en (default: kk)
```

**Response:**
```json
{
  "success": true,
  "data": {
    "brand_id": 1,
    "brand_name": "KFC",
    "restaurants": [
      {
        "id": 1,
        "name": "KFC Mega Planet",
        "images": [
          {
            "id": 1,
            "image_url": "https://example.com/storage/restaurants/image.jpg",
            "is_cover": true
          }
        ],
        "avg_rating": 4.5,
        "reviews_count": 120,
        "address": "Mega Planet, Almaty",
        "operating_hours": [
          {
            "day_of_week": 1,
            "opening_time": "09:00:00",
            "closing_time": "23:00:00",
            "is_closed": false
          }
        ]
      }
    ]
  }
}
```

**Restaurant Field Descriptions:**
- `id` - Restaurant ID
- `name` - Restaurant branch nomi
- `images` - Restaurantning barcha rasmlari (cover image birinchi bo'ladi)
  - `image_url` - To'liq rasm URL
  - `is_cover` - Asosiy rasm (true/false)
- `avg_rating` - O'rtacha reyting (0-5)
- `reviews_count` - Reviewlar soni
- `address` - Manzil
- `operating_hours` - Ish vaqti (hafta kunlari bo'yicha)
  - `day_of_week` - Hafta kuni (1=Dushanba, 7=Yakshanba)
  - `opening_time` - Ochilish vaqti
  - `closing_time` - Yopilish vaqti
  - `is_closed` - Yopiq kunmi (true/false)

**Error Response (404):**
```json
{
  "success": false,
  "message": "Brand not found"
}
```

## O'rnatish va ishga tushirish

### 1. Database ni ishga tushiring
Laragon'da MySQL serverini ishga tushiring.

### 2. Migration va Seeder
```bash
# Migration ni ishga tushirish
php artisan migrate

# Brand tarjimalarini seeder orqali to'ldirish
php artisan db:seed --class=BrandTranslationSeeder
```

### 3. APIni test qilish

#### cURL orqali test
```bash
# Barcha brandlar (Qozoq tilida)
curl -X GET http://localhost/api/brands \
  -H "Accept-Language: kk"

# Barcha brandlar (O'zbek tilida)
curl -X GET http://localhost/api/brands \
  -H "Accept-Language: uz"

# Barcha brandlar (Rus tilida)
curl -X GET http://localhost/api/brands \
  -H "Accept-Language: ru"

# Brand bo'yicha restaurantlar
curl -X GET http://localhost/api/restaurants/brand/1 \
  -H "Accept-Language: kk"
```

#### Postman orqali test
1. **GET** request yarating: `http://localhost/api/brands`
2. **Headers** qismiga qo'shing:
   - Key: `Accept-Language`
   - Value: `kk` (yoki `uz`, `ru`, `en`)

## Fayllar ro'yxati

### Yangi yaratilgan fayllar:
1. `app/Models/BrandTranslation.php` - Brand tarjima modeli
2. `app/Http/Controllers/Api/BrandController.php` - API controller
3. `database/migrations/2026_02_09_101933_create_brand_translations_table.php` - Migration
4. `database/seeders/BrandTranslationSeeder.php` - Test ma'lumotlar

### Yangilangan fayllar:
1. `app/Models/Brand.php` - tarjima funksiyalari qo'shildi
2. `routes/api.php` - yangi API marshrutlar qo'shildi

## Tillar

API quyidagi tillarni qo'llab-quvvatlaydi:
- `uz` - O'zbek tili
- `ru` - Rus tili
- `kk` - Qozoq tili (default)
- `en` - Ingliz tili

## Xususiyatlar

- ✅ Til bo'yicha brand nomlari va tavsiflarini qaytaradi
- ✅ Logo URL'larini to'liq ko'rinishda qaytaradi
- ✅ Brand bo'yicha restaurantlarni filtrlaydi
- ✅ OpenAPI (Swagger) dokumentatsiya mavjud
- ✅ N+1 query muammo oldini olish uchun eager loading ishlatilgan

## Keyingi qadamlar

Agar mavjud brandlarga tarjima qo'shmoqchi bo'lsangiz:

```php
use App\Models\Brand;
use App\Models\BrandTranslation;

$brand = Brand::find(1);

// Har bir til uchun tarjima qo'shish
BrandTranslation::create([
    'brand_id' => $brand->id,
    'code' => 'uz',
    'name' => 'Brand nomi',
    'description' => 'Brand tavsifi',
]);
```
