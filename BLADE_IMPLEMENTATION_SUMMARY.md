# Savollar Blade Interfeysi - Xulosa

## ✅ Amalga Oshiruvchilar

Superadmin uchun savollarni boshqarish uchun to'liq Blade interfeysi yaratildi.

### Yaratilgan Fayllar (5ta)

**Web Controller:**
- ✅ `app/Http/Controllers/SuperAdmin/QuestionController.php` - CRUD operatsiyalari

**Blade Shablonlar (3ta):**
- ✅ `resources/views/pages/questions/index.blade.php` - Savollar ro'yxati
- ✅ `resources/views/pages/questions/create.blade.php` - Yangi savol
- ✅ `resources/views/pages/questions/edit.blade.php` - Savol tahrir

**O'zgartirilgan Fayllar (2ta):**
- ✅ `routes/web.php` - Savollar routelari qo'shildi
- ✅ `resources/views/components/sidebar.blade.php` - "Savollar" menyu qo'shildi

## 🔒 Xavfsizlik

**`role:superadmin` middleware** - Faqat Superadmin foydalanuvchilar kirishi mumkin

```php
Route::prefix('questions')->middleware(['auth', 'role:superadmin'])->name('questions.')->group(...)
```

## 📋 CRUD Operatsiyalari

| Operaciya | URL | Method | Blade |
|-----------|-----|--------|-------|
| **Ro'yxat** | `/questions` | GET | `index.blade.php` |
| **Yaratish** | `/questions/create` | GET | `create.blade.php` |
| **Saqlash** | `/questions/store` | POST | - |
| **Tahrir** | `/questions/{id}/edit` | GET | `edit.blade.php` |
| **O'zgarishi** | `/questions/{id}/update` | PUT | - |
| **O'chirish** | `/questions/{id}/destroy` | DELETE | - |

## 🎨 Interfeys Xususiyatlari

### `index.blade.php` - Savollar Ro'yxati
- Jadval shaklida barcha savollar
- Qidiruv funksiyasi
- Pagination
- Har savol uchun:
  - Kalit (key) - identifikator
  - Tarjimalari (uz/ru/kk/en)
  - Majburiyligi (checkbox)
  - Tartibi (sort_order)
  - Statusi (aktiv/neaktiv)
  - Variantlar soni
  - Tahrir/o'chirish tugmalari

### `create.blade.php` - Yangi Savol
- Asosiy maydonlar:
  - Kalit (unique)
  - Tartibi (sort_order)
  - Majburi checkbox
  - Aktiv checkbox
- **Tab-based tarjimakoling:**
  - 4 tab (uz, ru, kk, en)
  - Har bir til uchun:
    - Savol nomi (majburi)
    - Izoh (ixtiyoriy)
- Belgilar hisobi (character counter)
- Right sidebar'da tusk va qo'llanma

### `edit.blade.php` - Savol Tahrir
- `create.blade.php` kabi forma
- Right sidebar:
  - Mavjud variantlar ro'yxati
  - Savolning metadata (ID, sana, vaqt)

## 🎯 Validation

```php
// Kalit - unikal, majburi
'key' => 'required|string|unique:questions_categories,key'

// Tartibi - son, 0 dan yuqori
'sort_order' => 'required|integer|min:0'

// Tarjimalar - majburi array
'translations' => 'required|array'
'translations.*.lang_code' => 'required|string'
'translations.*.title' => 'required|string|max:255'
'translations.*.description' => 'nullable|string|max:1000'
```

## 📱 Sidebar Integratsiyasi

Sidebar'da yangi menyu elementi:

```blade
<li class="sidebar-list {{ request()->routeIs('questions.*') ? 'active' : '' }}">
    <a class="sidebar-link sidebar-title link-nav" href="{{ route('questions.index') }}">
        <i data-feather="help-circle"></i><span>Вопросы</span>
    </a>
</li>
```

**Joylanishi:** Kategoriyalar, Brendlar, Shaharlar ostida (Superadmin menusida)

## 🚀 Foydalanish

### 1. Superadmin login qiladi

### 2. Sidebar'da "Voprosov" - "Savollar" bosadi

### 3. Savollar ro'yxatiga o'tadi
- Mavjud savollarni ko'radi
- Tahrir/o'chirish qiladi

### 4. "Yangi kategoriya" tugmasini bosadi

### 5. Forma to'ldirir
- Kalit: `what_did_you_like`
- Tartibi: `1`
- Majburi: ☑️
- Aktiv: ☑️
- Tarjimalar:
  - **Ўзбек:** Sizga nima yoqqadi?
  - **Русский:** Что вам понравилось?
  - **Қарақалпақ:** Sizge ne jaqpadı?
  - **English:** What did you like?

### 6. "Yaratish" tugmasini bosadi

### 7. Keyin variantlarni qo'shadi (imkon bilan keyin)

## 📊 Maydonlar va Tartib

```
SAVOLLAR JADVAL (index.blade.php)
├── № (counter)
├── Kalit (key)
├── Tarjimalar (badges)
├── Majburi (badge)
├── Tartibi (number)
├── Statusi (badge)
├── Variantlar (count)
└── Operatsiyalar (edit, delete)

YARATISH/TAHRIR FORMASI
├── Asosiy Maydonlar
│   ├── Kalit (text input)
│   ├── Tartibi (number input)
│   └── Checkboxlar
│       ├── Majburi
│       └── Aktiv
├── Tarjimakoling (Tabs)
│   ├── Ўзбек (uz)
│   │   ├── Nomi
│   │   └── Izoh
│   ├── Русский (ru)
│   ├── Қарақалпақ (kk)
│   └── English (en)
└── Sidebar (o'ng)
    ├── Variantlar (ro'yxat)
    └── Metadata
```

## 🔍 Tekshiruv

Yaratilgan barcha fayllar syntax bilan tekshirildi:
```
✓ QuestionController syntax OK
✓ Blade fayllar valid
✓ Routes va sidebar integratsiyasi
```

## 📁 File Struktura

```
app/Http/Controllers/SuperAdmin/
└── QuestionController.php          (133 lines)

routes/
└── web.php                         (routes qo'shildi)

resources/views/
├── components/
│   └── sidebar.blade.php           (menyu qo'shildi)
└── pages/questions/
    ├── index.blade.php             (212 lines)
    ├── create.blade.php            (161 lines)
    └── edit.blade.php              (191 lines)
```

## ⚙️ O'rnatish

```bash
# 1. Database o'rnatish (agar kerak bo'lsa)
php artisan migrate

# 2. Seederlarni ishga tushirish
php artisan migrate:fresh --seed

# 3. Laravel ishga tushirish
php artisan serve

# 4. Superadmin login qilish
# http://localhost:8000

# 5. Sidebar'da "Voprosov" - "Savollar" bosish
```

## 🎓 Qanday Ishlaydi?

### Index (Ro'yxat)
1. `QuestionController@index()` - Savollarni yuklaydii
2. `with()` method - Tarjimalar va variantlarni eager load qiladi
3. Pagination - 15 ta savol har sahifada
4. Blade template - Jadvalda ko'rsatadi

### Create (Yaratish)
1. `GET /questions/create` - Create formasini ko'rsatadi
2. Form submit → `POST /questions/store`
3. Validation qiladi
4. Senariy - `categories()` va `translations()` yaratadi
5. Redirect → index with success message

### Edit (Tahrir)
1. `GET /questions/{id}/edit` - Edit formasini ko'rsatadi
2. Mavjud ma'lumotlarini preli-fill qiladi
3. Form submit → `PUT /questions/{id}/update`
4. Validation qiladi
5. Transactions() o'chiradi va yangilarni yaratadi
6. Redirect → index with success message

### Delete (O'chirish)
1. `DELETE /questions/{id}/destroy` - Confirm so'radi
2. Savol va uning barcha ma'lumotlarini o'chiradi
3. Redirect → index with success message

## 🎉 Tugallangan!

✅ Superadmin interfeysi
✅ CRUD operatsiyalari
✅ Sidebar integratsiyasi
✅ Tab-based tarjimakoling
✅ Validation va error handling
✅ Responsive design

**Siz hozir savollarni to'lik boshqara olasiz!**
