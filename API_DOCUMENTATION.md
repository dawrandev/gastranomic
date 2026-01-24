# RestReviews API Documentation

## Base URL
```
http://localhost/api
```

## Authentication
Bu API telefon raqam orqali OTP (One-Time Password) autentifikatsiya qiladi va Laravel Sanctum token ishlatadi.

---

## Endpoints

### 1. Send Verification Code
Telefon raqamga tasdiqlash kodini yuboradi.

**Endpoint:** `POST /auth/send-code`

**Request Body:**
```json
{
  "phone": "998901234567"
}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Tasdiqlash kodi yuborildi",
  "phone": "998901234567",
  "code": "1234"  // Faqat development mode da ko'rinadi (APP_DEBUG=true)
}
```

**Error Response (422):**
```json
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "phone": ["The phone field is required."]
  }
}
```

**Error Response (500):**
```json
{
  "success": false,
  "message": "SMS yuborishda xatolik yuz berdi. Qaytadan urinib ko'ring."
}
```

---

### 2. Verify Code & Login/Register
Tasdiqlash kodini tekshiradi va client login/register qiladi.

**Endpoint:** `POST /auth/verify-code`

**Request Body (Mavjud client uchun):**
```json
{
  "phone": "998901234567",
  "code": "1234"
}
```

**Request Body (Yangi client uchun):**
```json
{
  "phone": "998901234567",
  "code": "1234",
  "first_name": "John",
  "last_name": "Doe"
}
```

**Success Response - Existing Client (200):**
```json
{
  "success": true,
  "message": "Tizimga kirdingiz",
  "is_new_user": false,
  "client": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "full_name": "John Doe",
    "phone": "998901234567",
    "image_path": null
  },
  "token": "1|abc123..."
}
```

**Success Response - New Client (200):**
```json
{
  "success": true,
  "message": "Ro'yxatdan o'tdingiz",
  "is_new_user": true,
  "client": {
    "id": 2,
    "first_name": "Jane",
    "last_name": "Smith",
    "full_name": "Jane Smith",
    "phone": "998907654321",
    "image_path": null
  },
  "token": "2|xyz789..."
}
```

**Error Response - New User without name (422):**
```json
{
  "success": false,
  "message": "Ism va familiya kiritish shart",
  "requires_registration": true
}
```

**Error Response - Invalid Code (401):**
```json
{
  "success": false,
  "message": "Noto'g'ri tasdiqlash kodi"
}
```

**Error Response - Expired Code (404):**
```json
{
  "success": false,
  "message": "Tasdiqlash kodi topilmadi yoki muddati tugagan"
}
```

---

### 3. Get Current Client Profile
Autentifikatsiya qilingan clientning ma'lumotlarini olish.

**Endpoint:** `GET /auth/me`

**Headers:**
```
Authorization: Bearer {token}
```

**Success Response (200):**
```json
{
  "success": true,
  "client": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "full_name": "John Doe",
    "phone": "998901234567",
    "image_path": null
  }
}
```

**Error Response - Unauthenticated (401):**
```json
{
  "message": "Unauthenticated."
}
```

---

### 4. Logout
Clientni logout qiladi (tokenni bekor qiladi).

**Endpoint:** `POST /auth/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Tizimdan chiqdingiz"
}
```

---

## Workflow Example

### 1. Send Code
```bash
curl -X POST http://localhost/api/auth/send-code \
  -H "Content-Type: application/json" \
  -d '{"phone":"998901234567"}'
```

### 2. Verify Code (New User)
```bash
curl -X POST http://localhost/api/auth/verify-code \
  -H "Content-Type: application/json" \
  -d '{
    "phone": "998901234567",
    "code": "1234",
    "first_name": "John",
    "last_name": "Doe"
  }'
```

### 3. Get Profile
```bash
curl -X GET http://localhost/api/auth/me \
  -H "Authorization: Bearer 1|abc123..."
```

### 4. Logout
```bash
curl -X POST http://localhost/api/auth/logout \
  -H "Authorization: Bearer 1|abc123..."
```

---

## Error Codes

| Status Code | Meaning |
|-------------|---------|
| 200 | Success |
| 401 | Unauthorized (invalid token or wrong code) |
| 404 | Not Found (code expired) |
| 422 | Validation Error |
| 500 | Server Error (SMS service failed) |

---

## Notes

1. **Phone Format:** Telefon raqamlar avtomatik tarzda tozalanadi va 998 bilan boshlanadi
2. **Code Expiration:** Tasdiqlash kodlari 5 daqiqadan keyin amal qilmaydi
3. **Token:** Token `Authorization: Bearer {token}` headerda yuboriladi
4. **Development Mode:** `APP_DEBUG=true` bo'lganda, `send-code` response ichida kod ham qaytadi

---

## Configuration

`.env` faylida quyidagi konfiguratsiyalarni to'ldiring:

```env
# Eskiz SMS Gateway
ESKIZ_EMAIL=your-email@example.com
ESKIZ_PASSWORD=your-password
```

---

## Security

- ✅ Kodlar 5 daqiqadan keyin amal qilmaydi
- ✅ Ishlatilgan kodlar qayta ishlatilmaydi
- ✅ Token-based autentifikatsiya (Laravel Sanctum)
- ✅ Telefon raqamlar avtomatik tozalanadi va validatsiya qilinadi
