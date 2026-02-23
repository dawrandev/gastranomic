# Savollar uchun Blade Interfeysi - To'liq Dokumentaciya

## Amalga Oshirish Xulosa

Savollarni boshqarish uchun **Superadmin uchun** alohida Web interfeysi yaratildi. Bu interfeys savollarni CRUD operatsiyalarida boshqarish imkoniyatini beradi.

## Yaratilgan Fayllar

### 1. Web Controller
**Fayl:** `app/Http/Controllers/SuperAdmin/QuestionController.php`

**Metodlar:**
- `index()` - Barcha savollarni ro'yxat ko'rinishida ko'rsatish
- `create()` - Yangi savol shaklini ko'rsatish
- `store()` - Yangi savolni saqlash
- `edit()` - Savol tahrir shaklini ko'rsatish
- `update()` - Savol tahrirgasini saqlash
- `destroy()` - Savol o'chirish

### 2. Blade Fayllar
**Direktoriy:** `resources/views/pages/questions/`

#### `index.blade.php`
- Barcha savollarning jadvalini ko'rsatadi
- Poisk va pagination imkoniyati
- Har bir savol uchun:
  - Kaliti (key)
  - Tarjimalari (uz, ru, kk, en)
  - Majburiyligi (is_required)
  - Tartibi (sort_order)
  - Statusi (is_active)
  - Variantlar soni
  - Tahrir va o'chirish tugmalari

#### `create.blade.php`
- Yangi savol kategoriyasi yaratish forması
- Asosiy maydonlar:
  - **Kalit** (key) - Unikal identifikator
  - **Tartibi** (sort_order) - Savollar ketma-ketligi
  - **Majburi** - Agar belgilangan bo'lsa, foydalanuvchi javob berishi shart
  - **Aktiv** - API'da ko'rinish

- Tarjimakoling tabulyatsiyasi (4 til):
  - Ўзбек (uz)
  - Русский (ru)
  - Қарақалпақ (kk)
  - English (en)

- Har bir til uchun:
  - Savol nomi (majburi)
  - Izoh (ixtiyoriy)

#### `edit.blade.php`
- Mavjud savolni tahrir qilish
- `create.blade.php` bilan bir xil forma
- O'ng tomonda:
  - Variantlar ro'yxati
  - Savolning tafsilotlari (ID, yaratilgan sana, o'zgartirilgan sana)

## Routes (Web)

```php
Route::prefix('questions')
    ->middleware(['auth', 'role:superadmin'])
    ->name('questions.')
    ->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::get('/create', [QuestionController::class, 'create'])->name('create');
        Route::post('/store', [QuestionController::class, 'store'])->name('store');
        Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('edit');
        Route::put('/{question}/update', [QuestionController::class, 'update'])->name('update');
        Route::delete('/{question}/destroy', [QuestionController::class, 'destroy'])->name('destroy');
    });
```

### Xavfsizlik

✅ **`role:superadmin` middleware** - Faqat Superadmin foydalanuvchilar kirishi mumkin

## Sidebar Integratsiyasi

**Fayl:** `resources/views/components/sidebar.blade.php`

**O'zgarishi:**
- "Voprosov" (Savollar) menyu elementi qo'shildi
- Faqat Superadmin uchun ko'rinadi
- Icon: `<i data-feather="help-circle"></i>`
- Joylanishi: Kategoriyalar, Brendlar, Shaharlar ostida

```blade
<li class="sidebar-list {{ request()->routeIs('questions.*') ? 'active' : '' }}">
    <a class="sidebar-link sidebar-title link-nav" href="{{ route('questions.index') }}">
        <i data-feather="help-circle"></i><span>Вопросы</span>
    </a>
</li>
```

## Validation Qoidalari

### Savol Yaratishda:
```php
'key' => 'required|string|unique:questions_categories,key',
'sort_order' => 'required|integer|min:0',
'translations' => 'required|array',
'translations.*.lang_code' => 'required|string',
'translations.*.title' => 'required|string|max:255',
'translations.*.description' => 'nullable|string|max:1000',
```

### Savol Tahrirlashda:
```php
'key' => 'required|string|unique:questions_categories,key,' . $question->id,
// Qolgan qoidalar o'xshash
```

## Forma Xususiyatlari

### Tab-based Tarjimakoling
- 4 tab - har bir til uchun
- Birinchi tab aktiv holda ochiladi
- Har bir tab o'zining maydoni bor
- Belgilar hisobi (character count) - 0-1000

### Validation Xato'lari
- Bootstrap `is-invalid` stili
- Qizil xato xabarlari
- Field-level validation feedback

### JavaScript
- Tarjima tablarini boshqarish
- Belgilar sonini hisoblash
- Form submit validatsiyasi

## Variantlar (Options) - Tushunish

Hozir variantlarni tahrir qilish `edit.blade.php`'da o'ng tomonda ko'rsatilgan:
- Mavjud variantlar ro'yxati
- "Variant qo'shish" tugmasi (tushilgan, keyin amalga oshiriladi)

Kelvosida **alohida options management**ni amalga oshirish mumkin.

## Foydalanuvchi Tajribasi

### Superadmin Qadam-qadam:
1. **Dashboard** → **Voprosov** linkini bosadi
2. **Savollar ro'yxati** sahifasiga keladi
3. **"Yangi kategoriya"** tugmasini bosadi
4. **Yaratish formasini to'ldiradi**:
   - Kalit (masalan: `what_did_you_like`)
   - Tartibi (masalan: `1`)
   - Majburilik va Aktiv checkboxlarini belgilaydi
   - Har bir til uchun nomi va izohni yozadi
5. **"Yaratish"** tugmasini bosadi
6. **Tahrir orqali** nomi, izoh yoki statusni o'zgartirishini yoki **o'chirishi** mumkin

## Bazaviy Qator Tuzilishi

```
questions_categories
├── id
├── key (unique)
├── sort_order
├── is_required
├── is_active
├── created_at
├── updated_at

questions_category_translations
├── id
├── questions_category_id (FK)
├── lang_code (uz/ru/kk/en)
├── title
├── description

questions_options
├── id
├── questions_category_id (FK)
├── key
├── sort_order
├── is_active
├── created_at
├── updated_at

questions_option_translations
├── id
├── questions_option_id (FK)
├── lang_code
├── text
```

## Turlangan Ma'lumotlar

Jadval ko'rinishida quyidagi ma'lumotlar ko'rsatiladi:

| № | Kalit | Nomlar | Majburi | Tartibi | Statusi | Variantlar | Operatsiyalar |
|---|-------|--------|--------|--------|---------|-----------|---------------|
| 1 | what_did_you_like | UZ: Sizga nima yoqqadi? RU: Что вам понравилось? ... | Ha | 1 | Aktiv | 7 | ✏️ 🗑️ |

## Keyin Amalga Oshirilishi Mumkin

### Bosqich 1: Options Boshqarish
- Har bir savolga variantlar qo'shish/o'chirish
- Alohida modal yoki sahifa

### Bosqich 2: Statistika Paneli
- Har bir variantga nechta foydalanuvchi javob berganini ko'rsatish
- Grafik va jadvallar

### Bosqich 3: Bulk O'peraciyalar
- Ko'p savollarni o'chirish
- Savollarni ko'chirish
- Massiv tahrir

## O'rnatish / Ishga Tushirish

```bash
# 1. Migratsiyadarni ishga tushirish (mavjud bo'lsa)
php artisan migrate

# 2. Seederlarni ishga tushirish (savollar bilan to'ldirish)
php artisan migrate:fresh --seed

# 3. Superadmin login qiling

# 4. Sidebar'da "Voprosov" - "Savollar" linkini bosing

# 5. Savollarni boshqara boshlang!
```

## Masalalarni Tuzatish

### Issue: "Voprosov" linki ko'rinmaydi
**Sabab:** Superadmin bo'lmayapsiz
**Tuzatish:** Superadmin bilan login qiling

### Issue: Savol saqlanmaydi
**Tekshirish:**
- Barcha talab qilingan maydonlar to'ldirilganmi?
- Kalit unikal bo'lganmi?
- Validation xatolar mavjudmi?

### Issue: Tarjimakoling dinamik bo'lmaydi
**Tuzatish:** JavaScript ishlamayotgan bo'lishi mumkin - browser consolini tekshiring

## Kod Namunalari

### Savolni Ko'rsatish
```php
$question = QuestionCategory::with('translations', 'options.translations')->find(1);

// Tarjima olish
$ruTitle = $question->getTranslatedTitle('ru');
$uzTitle = $question->getTranslatedTitle('uz');
```

### Savolning Variantlarini Ko'rsatish
```php
foreach ($question->options as $option) {
    echo $option->getTranslatedText('ru');
}
```

## Xulosa

✅ **Yaxshi:** Admin interfeys toq Superadmin uchun himoyalangan
✅ **Yaxshi:** Tarjima tablarida 4 til uchun toq forma
✅ **Yaxshi:** Sidebar integraciyasi bosqichma-bosqich
✅ **Yaxshi:** Validation va error handling
✅ **Yaxshi:** Responsive design

---

**Status:** ✅ Blade interfeysi tamom - ishga tushgan!
