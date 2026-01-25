# 📱 RestReviews Mobile API - Foydalanish Qo'llanmasi

## 🚀 API Dokumentatsiya

### Swagger UI orqali API ni ko'rish

**Local development:**
```
http://localhost/docs
```

**Production:**
```
https://api.restreviews.uz/docs
```

Swagger UI da barcha endpointlar, request/response namunalari va testlar mavjud.

---

## 🔐 Authentication API

### 1. Tasdiqlash Kodini Yuborish

**Endpoint:** `POST /api/auth/send-code`

**Request:**
```json
{
  "phone": "998901234567"
}
```

**Response (Test Mode):**
```json
{
  "success": true,
  "message": "Tasdiqlash kodi yuborildi",
  "phone": "998901234567",
  "code": "1234"
}
```

**Response (Production Mode):**
```json
{
  "success": true,
  "message": "Tasdiqlash kodi yuborildi",
  "phone": "998901234567",
  "code": null
}
```

**Muhim:**
- Test rejimida `code` response da qaytadi, SMS da umumiy matn keladi
- Production rejimida `code` null, SMS da haqiqiy kod keladi
- Kod 5 daqiqa amal qiladi

**cURL Misol:**
```bash
curl -X POST http://localhost/api/auth/send-code \
  -H "Content-Type: application/json" \
  -d '{"phone": "998901234567"}'
```

---

### 2. Kodni Tekshirish va Login/Register

**Endpoint:** `POST /api/auth/verify-code`

#### Mavjud Foydalanuvchi (Login):
```json
{
  "phone": "998901234567",
  "code": "1234"
}
```

#### Yangi Foydalanuvchi (Register):
```json
{
  "phone": "998901234567",
  "code": "1234",
  "first_name": "Abdulla",
  "last_name": "Valiyev"
}
```

**Success Response:**
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
  "token": "1|abcdefghijklmnopqrstuvwxyz123456789"
}
```

**Error: Yangi Foydalanuvchi (Ism/Familiya kerak):**
```json
{
  "success": false,
  "message": "Ism va familiya kiritish shart",
  "requires_registration": true
}
```

**Muhim:**
- `token` ni keyingi so'rovlar uchun saqlang
- Agar `requires_registration: true` bo'lsa, `first_name` va `last_name` so'rang

**cURL Misol:**
```bash
curl -X POST http://localhost/api/auth/verify-code \
  -H "Content-Type: application/json" \
  -d '{
    "phone": "998901234567",
    "code": "1234",
    "first_name": "Abdulla",
    "last_name": "Valiyev"
  }'
```

---

### 3. Foydalanuvchi Profilini Olish

**Endpoint:** `GET /api/auth/me`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "client": {
    "id": 1,
    "first_name": "Abdulla",
    "last_name": "Valiyev",
    "full_name": "Abdulla Valiyev",
    "phone": "998901234567",
    "image_path": null
  }
}
```

**cURL Misol:**
```bash
curl -X GET http://localhost/api/auth/me \
  -H "Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz123456789"
```

---

### 4. Tizimdan Chiqish (Logout)

**Endpoint:** `POST /api/auth/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "message": "Tizimdan chiqdingiz"
}
```

**cURL Misol:**
```bash
curl -X POST http://localhost/api/auth/logout \
  -H "Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz123456789"
```

---

## 📋 Flutter/Dart Integration Misol

### 1. API Service Class

```dart
import 'package:dio/dio.dart';

class ApiService {
  final Dio _dio = Dio(
    BaseOptions(
      baseUrl: 'http://localhost/api',
      contentType: 'application/json',
    ),
  );

  String? _token;

  // Set token
  void setToken(String token) {
    _token = token;
    _dio.options.headers['Authorization'] = 'Bearer $token';
  }

  // Send verification code
  Future<Map<String, dynamic>> sendCode(String phone) async {
    final response = await _dio.post('/auth/send-code', data: {
      'phone': phone,
    });
    return response.data;
  }

  // Verify code and login/register
  Future<Map<String, dynamic>> verifyCode({
    required String phone,
    required String code,
    String? firstName,
    String? lastName,
  }) async {
    final response = await _dio.post('/auth/verify-code', data: {
      'phone': phone,
      'code': code,
      if (firstName != null) 'first_name': firstName,
      if (lastName != null) 'last_name': lastName,
    });
    return response.data;
  }

  // Get profile
  Future<Map<String, dynamic>> getProfile() async {
    final response = await _dio.get('/auth/me');
    return response.data;
  }

  // Logout
  Future<Map<String, dynamic>> logout() async {
    final response = await _dio.post('/auth/logout');
    return response.data;
  }
}
```

### 2. Login Flow

```dart
final apiService = ApiService();

// Step 1: Send code
Future<void> sendVerificationCode(String phone) async {
  try {
    final response = await apiService.sendCode(phone);

    if (response['success']) {
      // Test mode: show code from response
      if (response['code'] != null) {
        print('Test code: ${response['code']}');
      }
      // Navigate to verification screen
    }
  } catch (e) {
    print('Error: $e');
  }
}

// Step 2: Verify code
Future<void> verifyCode(String phone, String code) async {
  try {
    final response = await apiService.verifyCode(
      phone: phone,
      code: code,
    );

    if (response['success']) {
      // Save token
      apiService.setToken(response['token']);

      // Save to local storage
      await saveToken(response['token']);

      // Navigate to home screen
    } else if (response['requires_registration'] == true) {
      // Show registration form (first_name, last_name)
      showRegistrationForm(phone, code);
    }
  } catch (e) {
    print('Error: $e');
  }
}

// Step 3: Register new user
Future<void> registerUser(String phone, String code, String firstName, String lastName) async {
  try {
    final response = await apiService.verifyCode(
      phone: phone,
      code: code,
      firstName: firstName,
      lastName: lastName,
    );

    if (response['success']) {
      apiService.setToken(response['token']);
      await saveToken(response['token']);
      // Navigate to home
    }
  } catch (e) {
    print('Error: $e');
  }
}
```

---

## ⚠️ Error Handling

### Status Codes:
- `200` - Success
- `401` - Unauthorized (noto'g'ri kod yoki token)
- `404` - Kod topilmadi yoki muddati tugagan
- `422` - Validation error
- `500` - Server error

### Error Response Format:
```json
{
  "success": false,
  "message": "Xatolik tavsifi",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

---

## 🧪 Test Mode vs Production Mode

### Test Mode (hozirda):
- ✅ SMS: "Bu Eskiz dan test"
- ✅ Kod API response da qaytadi
- ✅ `code` field null emas

### Production Mode (kelajakda):
- ✅ SMS: "Sizning tasdiqlash kodingiz: 1234"
- ✅ Kod SMS da keladi
- ✅ `code` field null

**Production rejimga o'tish:**
1. Eskiz hisobini to'ldiring
2. `.env` faylda `ESKIZ_TEST_MODE=false` qiling
3. `php artisan config:clear` bajaring

---

## 📞 Telefon Raqam Formatlash

API avtomatik ravishda telefon raqamini formatlaydi:

**Qabul qilinadigan formatlar:**
- `998901234567` ✅
- `901234567` ✅ (avtomatik 998 qo'shiladi)
- `+998901234567` ✅
- `+998 90 123 45 67` ✅
- `90-123-45-67` ✅

**Saqlangan format:**
- `998901234567` (faqat raqamlar, 998 bilan boshlanadi)

---

## 🔒 Security Best Practices

1. **Token Storage:**
   - Flutter: `flutter_secure_storage` ishlatilsin
   - Token xavfsiz saqlaning
   - Token ni biror joyda log qilmang

2. **API Keys:**
   - API base URL ni config faylda saqlang
   - Hardcode qilmang

3. **Error Messages:**
   - Foydalanuvchiga faqat kerakli ma'lumotlarni ko'rsating
   - Texnik xatoliklarni log qiling

---

## 🛠 Troubleshooting

### 1. "Unauthenticated" xatosi
- Token to'g'ri yuborilganini tekshiring
- Bearer formatini tekshiring: `Authorization: Bearer {token}`
- Token muddati tugaganmi tekshiring

### 2. "Tasdiqlash kodi topilmadi"
- Kod 5 daqiqadan oshganmi?
- Telefon raqam to'g'rimi?
- Yangi kod so'rang

### 3. CORS xatosi
- Backend CORS sozlamalarini tekshiring
- Headers to'g'ri qo'yilganini tekshiring

---

## 📚 Qo'shimcha Resurslar

- **Swagger UI:** http://localhost/docs
- **API JSON:** http://localhost/api/documentation
- **Postman Collection:** Swagger dan export qilish mumkin

---

## 📝 Changelog

### v1.0.0 (2026-01-25)
- ✅ Telefon orqali authentication
- ✅ SMS verification (Eskiz)
- ✅ Auto login/register
- ✅ Profile management
- ✅ Token-based auth (Sanctum)
- ✅ Swagger documentation

---

**Savol yoki muammolar uchun:**
- Backend Developer bilan bog'laning
- Swagger dokumentatsiyasini tekshiring
