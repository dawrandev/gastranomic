# 🍽️ RestReviews API - To'liq Dokumentatsiya

## 📱 **BASE URL**
```
https://gastronomic.webclub.uz/api
```

## 🔐 **AUTENTIFIKATSIYA**

### 1. SMS kod yuborish
**POST** `/auth/send-code`

Telefon raqamiga 4 raqamli tasdiqlash kodini yuboradi.

**Request:**
```json
{
  "phone": "998901234567"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Tasdiqlash kodi yuborildi",
  "phone": "998901234567",
  "code": "1234"  // faqat test rejimida
}
```

---

### 2. Kodni tasdiqlash va login/register
**POST** `/auth/verify-code`

Kodni tekshiradi va token qaytaradi. Guest data larni client ga bog'laydi.

**Request:**
```json
{
  "phone": "998901234567",
  "code": "1234",
  "first_name": "Abdulla",    // yangi users uchun
  "last_name": "Valiyev",     // yangi users uchun
  "device_id": "uuid-here"    // guest dataларни migrate qilish uchun
}
```

**Response:**
```json
{
  "success": true,
  "message": "Tizimga kirdingiz",
  "is_new_user": false,
  "client": {
    "id": 1,
    "first_name": "Abdulla",
    "last_name": "Valiyev",
    "full_name": "Abdulla Valiyev",
    "phone": "998901234567",
    "image_path": null
  },
  "token": "1|abcdefgh..."
}
```

---

### 3. Profil ma'lumotlari 🔒
**GET** `/auth/me`

**Headers:**
```
Authorization: Bearer {token}
```

---

### 4. Logout 🔒
**POST** `/auth/logout`

---

## 🏠 **RESTORANLARNI KASHF QILISH**

### 5. Barcha restoranlar
**GET** `/restaurants`

**Query Parameters:**
- `page` - Sahifa raqami
- `per_page` - Sahifadagi elementlar (default: 15)
- `category_id` - Kategoriya ID
- `city_id` - Shahar ID
- `brand_id` - Brend ID
- `menu_section_id` - Menyu bo'limi ID
- `min_rating` - Minimal reyting
- `max_rating` - Maksimal reyting
- `sort_by` - `rating` yoki `latest`

**Headers:**
```
Accept-Language: uz|ru|kk|en
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "branch_name": "Grand Lavash 26",
      "address": "Nukus ko'chasi 26",
      "phone": "+998901234567",
      "brand": {
        "id": 1,
        "name": "Grand Lavash",
        "logo": "https://..."
      },
      "city": {
        "id": 1,
        "name": "Nukus"
      },
      "cover_image": "https://...",
      "categories": [
        {
          "id": 1,
          "name": "Fast Food"
        }
      ],
      "category_name": "Fast Food",
      "average_rating": 4.5,
      "reviews_count": 150,
      "operating_hours": [
        {
          "day_of_week": 0,
          "opening_time": "09:00:00",
          "closing_time": "23:00:00",
          "is_closed": false
        }
      ]
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 75
  }
}
```

---

### 6. Eng yaqin 5 ta restoran ⭐ **YANGI**
**GET** `/restaurants/nearest`

Foydalanuvchi lokatsiyasiga eng yaqin 5 ta restoranni qaytaradi.

**Query Parameters:**
- `lat` **(majburiy)** - Latitude
- `lng` **(majburiy)** - Longitude

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "branch_name": "Grand Lavash 26",
      "category_name": "Fast Food",
      "average_rating": 4.5,
      "reviews_count": 150,
      "distance": 0.5,  // km da
      "operating_hours": [...]
    }
  ]
}
```

---

### 7. Yaqin atrofdagi restoranlar (pagination bilan)
**GET** `/restaurants/nearby`

**Query Parameters:**
- `lat` **(majburiy)**
- `lng` **(majburiy)**
- `radius` - Qidiruv radiusi km (default: 5, max: 50)
- `page`
- `per_page`

---

### 8. Kategoriya bo'yicha top restoranlar ⭐ **YANGI**
**GET** `/categories/{id}/top-restaurants`

UI carousel uchun: "Ommabop fast foodlar", "Ommabop restoranlar"

**Query Parameters:**
- `limit` - Natijalar soni (default: 10)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "branch_name": "Grand Lavash 26",
      "category_name": "Fast Food",
      "average_rating": 4.8,
      "reviews_count": 250,
      "operating_hours": [...]
    }
  ]
}
```

---

### 9. Restoran batafsil ma'lumotlari
**GET** `/restaurants/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "branch_name": "Grand Lavash 26",
    "phone": "+998901234567",
    "description": "Eng yaxshi fast food...",
    "address": "Nukus ko'chasi 26",
    "latitude": 42.4653,
    "longitude": 59.6112,
    "is_active": true,
    "qr_code": "https://gastronomic.webclub.uz/storage/qrcodes/...",
    "brand": {
      "id": 1,
      "name": "Grand Lavash",
      "logo": "https://...",
      "image": "https://...",
      "description": "..."
    },
    "city": {
      "id": 1,
      "name": "Nukus"
    },
    "categories": [...],
    "images": [
      {
        "id": 1,
        "image_path": "https://...",
        "is_cover": true
      }
    ],
    "operating_hours": [...],
    "average_rating": 4.5,
    "reviews_count": 150,
    "is_favorited": false,
    "created_at": "2026-01-20 10:00:00"
  }
}
```

---

### 10. Xarita uchun restoranlar
**GET** `/restaurants/map`

**Query Parameters:**
- `category_id`
- `city_id`
- `min_rating`
- `max_rating`

---

## 🍔 **MENYU**

### 11. Restoran menyusi
**GET** `/restaurants/{id}/menu`

Menu section lar bilan guruhlanган holda.

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Salatlar",
      "description": "Yangi salatlar",
      "items": [
        {
          "id": 101,
          "name": "Caesar salat",
          "description": "Tovuq go'shti bilan",
          "image_path": "https://...",
          "base_price": 35000,
          "weight": "250g",
          "restaurant_price": 35000,
          "is_available": true
        }
      ]
    }
  ]
}
```

---

### 12. Taom batafsil
**GET** `/menu-items/{id}`

---

## ⭐ **SHARHLAR (REVIEWS)**

### 13. Restoran sharhlari
**GET** `/restaurants/{id}/reviews`

**Query Parameters:**
- `page`
- `per_page` (default: 15)

**Response:**
```json
{
  "success": true,
  "data": [...],
  "statistics": {
    "average_rating": 4.5,
    "total_reviews": 150,
    "rating_distribution": {
      "5": 80,
      "4": 40,
      "3": 20,
      "2": 7,
      "1": 3
    }
  },
  "meta": {...}
}
```

---

### 14. Sharh qoldirish (Guest-friendly!)
**POST** `/restaurants/{id}/reviews`

Login **shart emas**! Device ID orqali kuzatiladi.

**Request:**
```json
{
  "device_id": "uuid-here",
  "rating": 5,
  "comment": "Juda zo'r!"  // ixtiyoriy
}
```

**Rate Limit:**
- 10 requests/min
- 3 sharh/kun per restaurant per device

---

### 15. Sharhni yangilash 🔒
**PUT** `/reviews/{id}`

---

### 16. Sharhni o'chirish 🔒
**DELETE** `/reviews/{id}`

---

## ❤️ **SEVIMLILAR**

### 17. Sevimlilar ro'yxati 🔒
**GET** `/favorites`

---

### 18. Sevimliga qo'shish/o'chirish 🔒 ⭐ **O'ZGARGAN**
**POST** `/restaurants/{id}/favorite`

**Muhim:** Endi faqat authenticated users uchun!

**Response:**
```json
{
  "success": true,
  "message": "Sevimlilar ro'yxatiga qo'shildi",
  "data": {
    "is_favorited": true
  }
}
```

---

### 19. Sevimlilar xaritada 🔒 ⭐ **YANGI**
**GET** `/favorites/map`

Client sevimli restoranlarining koordinatalarini qaytaradi.

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "branch_name": "Grand Lavash 26",
      "latitude": 42.4653,
      "longitude": 59.6112,
      "brand": {
        "id": 1,
        "name": "Grand Lavash"
      }
    }
  ]
}
```

---

## 👤 **PROFIL** ⭐ **YANGI**

### 20. Profil ma'lumotlari 🔒
**GET** `/profile`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "first_name": "Abdulla",
    "last_name": "Valiyev",
    "full_name": "Abdulla Valiyev",
    "phone": "998901234567",
    "image_path": "https://...",
    "statistics": {
      "total_reviews": 15,
      "five_star_reviews": 8,
      "favorites_count": 5
    },
    "reviews": [...]
  }
}
```

---

### 21. Profilni yangilash 🔒
**POST** `/profile`

**Request (multipart/form-data):**
```
first_name: Abdulla
last_name: Valiyev
image: [file]
```

---

## 🔍 **QIDIRUV**

### 22. Global qidiruv
**GET** `/search`

Restoranlar va taomlar bo'yicha qidiruv.

**Query Parameters:**
- `q` **(majburiy)** - Qidiruv so'zi (min 2 ta belgi)
- `page`
- `per_page`

**Response:**
```json
{
  "success": true,
  "data": {
    "restaurants": {
      "data": [...],
      "meta": {...}
    },
    "menu_items": {
      "data": [...],
      "total": 25
    }
  }
}
```

---

## 🔒 **AUTENTIFIKATSIYA**

Protected API lar uchun:

```http
Authorization: Bearer {token}
```

---

## 🌍 **KO'P TILLILIK**

Barcha API lar 4 ta tilni qo'llab-quvvatlaydi:

```http
Accept-Language: uz|ru|kk|en
```

Default: `kk`

---

## ⚡ **RATE LIMITING**

| API | Limit |
|-----|-------|
| POST `/restaurants/{id}/reviews` | 10 req/min |
| POST `/restaurants/{id}/favorite` | 20 req/min |
| Review yaratish per restaurant | 3 sharh/kun |

---

## 📊 **YANGI XUSUSIYATLAR**

### ✅ **Auth qilganda Guest Data Migration**

Agar guest sifatida sharh qoldirgan yoki favorite qo'shgan bo'lsa, auth paytida `device_id` yuborsa, barcha guest datalari client_id ga avtomatik bog'lanadi.

```json
{
  "phone": "998901234567",
  "code": "1234",
  "first_name": "Abdulla",
  "last_name": "Valiyev",
  "device_id": "uuid-here"  // Bu muhim!
}
```

### ✅ **Favorites Auth Requirement**

Sevimlilar endi faqat authenticated users uchun. Guest users sevimlilar qo'sha olmaydi.

### ✅ **Operating Hours**

Restaurant list va detail response larda operating hours qo'shildi.

### ✅ **Category Name**

Restaurant list da primary category name qo'shildi (UI da ko'rsatish uchun).

### ✅ **Brand Image**

Restaurant detail da brand image/logo qo'shildi.

---

## 📱 **Android Dasturchi uchun muhim**

1. **Base URL:** `https://gastronomic.webclub.uz/api`
2. **Token Storage:** Secure storage da saqlash (KeyStore/DataStore)
3. **Device ID:** UUID generate qilib saqlash
4. **Language:** `Accept-Language` header ni har doim yuborish
5. **Error Handling:** 401 da logout, 422 da validation errors ko'rsatish
6. **Rate Limiting:** 429 response da retry-after ni tekshirish
7. **Guest to Auth Migration:** Auth paytida device_id ni yuborish esdan chiqmasin!

---

## 🎯 **SWAGGER DOCUMENTATION**

To'liq interaktiv dokumentatsiya:
```
https://gastronomic.webclub.uz/api/documentation
```

---

**Loyiha holati:** ✅ **TUGALLANDI**
**Versiya:** 1.0.0
**Sanasi:** 2026-01-29

---

Barcha API lar tayyor va ishga tayyor! 🚀
