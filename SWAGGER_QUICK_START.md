# 📚 Swagger API Documentation - Quick Start

## 🎯 Swagger UI ni ko'rish

### Local Development
Brauzerda oching:
```
http://localhost/docs
```

### Production (kelajakda)
```
https://api.restreviews.uz/docs
```

---

## 🚀 Swagger da nima bor?

✅ **Barcha API endpointlar** - to'liq ro'yxat
✅ **Request/Response namunalari** - har bir endpoint uchun
✅ **Try it out** - to'g'ridan-to'g'ri Swagger dan test qilish
✅ **Authentication** - Bearer token bilan test qilish
✅ **Schema models** - data strukturalari
✅ **Error responses** - xatolik holatlari

---

## 📖 Swagger UI dan foydalanish

### 1. Swagger UI ni oching
```
http://localhost/docs
```

### 2. Endpointni tanlang
- `POST /api/auth/send-code` - Kod yuborish
- `POST /api/auth/verify-code` - Kodni tekshirish
- `GET /api/auth/me` - Profil olish (🔒 auth kerak)
- `POST /api/auth/logout` - Logout (🔒 auth kerak)

### 3. "Try it out" tugmasini bosing

### 4. Parametrlarni kiriting
```json
{
  "phone": "998901234567"
}
```

### 5. "Execute" tugmasini bosing

### 6. Response ni ko'ring
```json
{
  "success": true,
  "message": "Tasdiqlash kodi yuborildi",
  "phone": "998901234567",
  "code": "1234"
}
```

---

## 🔐 Authorization bilan test qilish

### 1. Avval login qiling
`POST /api/auth/send-code` → `POST /api/auth/verify-code`

### 2. Token ni nusxalang
Response dan `token` ni copy qiling:
```
1|abcdefghijklmnopqrstuvwxyz123456789
```

### 3. Swagger da "Authorize" tugmasini bosing
(Sahifaning yuqori o'ng qismida 🔓 belgisi)

### 4. Token ni qo'ying
```
1|abcdefghijklmnopqrstuvwxyz123456789
```

### 5. "Authorize" va "Close" bosing

### 6. Endi protected endpointlarni test qilishingiz mumkin
- `GET /api/auth/me` ✅
- `POST /api/auth/logout` ✅

---

## 📥 Export qilish

### Postman uchun
1. Swagger UI da yuqori o'ng qismdagi `/api/documentation` linkini oching
2. JSON ni download qiling
3. Postman da `Import` → `Upload Files` → JSON faylni tanlang

**Yoki:**
Ready-made Postman collection: `RestReviews-API.postman_collection.json`

### OpenAPI Spec
```
http://localhost/api/documentation
```

Bu file bilan:
- Postman import qilish
- Insomnia import qilish
- Code generation (Swagger Codegen)
- API testing tools

---

## 🛠 Swagger yangilash

Agar API o'zgartirsa, dokumentatsiyani yangilash:

```bash
php artisan l5-swagger:generate
```

Bu command:
- Controller larni scan qiladi
- OpenAPI annotations ni o'qiydi
- `storage/api-docs/api-docs.json` ni yangilaydi

---

## 📱 Mobil Dasturchi uchun

### Asosiy fayllar:
1. **Swagger UI:** http://localhost/docs (interaktiv dokumentatsiya)
2. **API Guide:** `API_MOBILE_GUIDE.md` (batafsil qo'llanma)
3. **Postman Collection:** `RestReviews-API.postman_collection.json` (ready-to-use)

### Integration namunalari:
`API_MOBILE_GUIDE.md` da Flutter/Dart kod namunalari mavjud:
- API Service class
- Login flow
- Error handling
- Token management

---

## 🎨 Swagger UI Features

### Schema Models
Pastki qismda "Schemas" bo'limida barcha data modellari ko'rsatilgan:
- Client model
- Request bodies
- Response structures

### Response Examples
Har bir endpoint uchun:
- Success responses (200, 201)
- Error responses (400, 401, 404, 422, 500)
- Schema definitions

### Request Body Examples
Har bir POST/PUT endpoint da:
- Required fields (qizil yulduzcha bilan)
- Optional fields
- Data types
- Example values

---

## ⚡ Pro Tips

1. **Test ketma-ketligi:**
   - Send Code → Verify Code → Get Profile → Logout

2. **Token saqlash:**
   - Login qilganda tokenni nusxalang
   - "Authorize" qiling
   - Barcha protected endpointlarni test qiling

3. **Error testing:**
   - Noto'g'ri kod kiriting → 401 ko'rasiz
   - Token bermasdan `/me` ni test qiling → 401
   - Telefon raqamsiz send-code → 422

4. **Refresh qiling:**
   - API o'zgarganda `php artisan l5-swagger:generate`
   - Brauzerda F5 bosing

---

## 🔍 Swagger vs Postman

| Feature | Swagger UI | Postman |
|---------|-----------|---------|
| Interaktiv test | ✅ | ✅ |
| Auto-generated | ✅ | ❌ |
| Always updated | ✅ | Manual |
| Collections | ❌ | ✅ |
| Environments | ❌ | ✅ |
| Team sharing | Easy (URL) | Export/Import |

**Tavsiya:** Ikkalasidan ham foydalaning!
- Swagger: Quick testing va dokumentatsiya
- Postman: Complex workflows va teamwork

---

## 📞 Support

Agar Swagger UI ishlamasa:

```bash
# Cache ni tozalang
php artisan config:clear
php artisan cache:clear

# Dokumentatsiyani qayta generate qiling
php artisan l5-swagger:generate

# Development server ni qayta ishga tushiring
php artisan serve
```

Swagger UI: http://localhost:8000/docs

---

**Happy Testing! 🚀**
