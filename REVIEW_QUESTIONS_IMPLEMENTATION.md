# Review Questions & Answers Implementation - COMPLETE

## Summary of Implementation

All 6 required phases have been successfully implemented:

### ✅ Phase 1: Database Seeding
- **File Modified:** `database/seeders/DatabaseSeeder.php`
- **Change:** Registered `ReviewQuestionsSeeder::class` in the seeder call list
- **Status:** Ready to run with `php artisan migrate:fresh --seed`

### ✅ Phase 2: API Resources
- **Files Created:**
  - `app/Http/Resources/QuestionCategoryResource.php` - Transforms QuestionCategory with locale-aware translations
  - `app/Http/Resources/QuestionOptionResource.php` - Transforms QuestionOption with locale-aware translations
- **Features:**
  - Supports all 4 languages (kk, uz, ru, en)
  - Uses current app locale via `app()->getLocale()`
  - Includes nested options in category resource

### ✅ Phase 3: API Controller
- **File Created:** `app/Http/Controllers/Api/QuestionController.php`
- **Endpoint:** `GET /api/questions`
- **Features:**
  - Filters by active categories and options
  - Eager loads options with translations
  - Ordered by sort_order
  - Includes complete Swagger documentation with OA attributes
  - Supports language negotiation via Accept-Language header

### ✅ Phase 4: Review Submission Integration

#### 4.1 Updated `app/Http/Requests/StoreReviewRequest.php`
- Added validation for `selected_option_ids`:
  ```php
  'selected_option_ids' => ['nullable', 'array'],
  'selected_option_ids.*' => ['integer', 'exists:questions_options,id'],
  ```

#### 4.2 Updated `app/Services/ReviewService.php`
- Modified `createOrUpdateReview()` method to:
  - Extract `selected_option_ids` from data
  - Create review record
  - Sync selected options to review via many-to-many relationship
  - Maintain backward compatibility (answers are optional)

#### 4.3 Updated `app/Http/Controllers/Api/ReviewController.php`
- Added `selected_option_ids` to POST /api/restaurants/{id}/reviews Swagger documentation
- Passes all validated data to ReviewService (including selected_option_ids)

#### 4.4 Updated `app/Http/Resources/ReviewResource.php`
- Added `selected_answers` field with:
  - Locale-aware option text
  - Option id and key
  - Only included if relationship is loaded

#### 4.5 Updated `app/Repositories/ReviewRepository.php`
- Modified `getByRestaurantId()` to eager load `selectedOptions.translations`
- Ensures translations are available when building review resource

### ✅ Phase 5: API Routes
- **File Modified:** `routes/api.php`
- **Route Added:** `GET /api/questions` → `QuestionController@index`
- **Location:** Public routes section (no auth required)
- **Import Added:** `QuestionController` use statement

### ✅ Phase 6: Swagger Documentation
- **GET /api/questions** - Complete documentation with:
  - Summary in Uzbek: "Barcha savol kategoriyalari"
  - Description with use case
  - Accept-Language header parameter documentation
  - Full response schema with nested options
  - Tag: ❓ Savollar

- **POST /api/restaurants/{id}/reviews** - Updated with:
  - `selected_option_ids` field in request body schema
  - Documented as optional array of integers
  - Example showing usage: `[1, 15, 22]`

---

## API Specification

### GET /api/questions
**Description:** Fetch all active question categories with their options
**Authentication:** Not required
**Request Headers:**
- `Accept-Language: uz|ru|kk|en` (optional, defaults to app locale)

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "key": "what_did_you_like",
      "title": "Sizge ne jaqpadı?",
      "description": null,
      "is_required": true,
      "sort_order": 1,
      "options": [
        {
          "id": 1,
          "key": "good_service",
          "text": "Baqaw xızmet",
          "sort_order": 0
        },
        {
          "id": 2,
          "key": "poor_service",
          "text": "Qolaylı emes xızmetkerler",
          "sort_order": 1
        }
      ]
    }
  ]
}
```

### POST /api/restaurants/{id}/reviews
**Updated Request Body:**
```json
{
  "device_id": "550e8400-e29b-41d4-a716-446655440000",
  "rating": 5,
  "comment": "Отличный ресторан!",
  "phone": "+998901234567",
  "selected_option_ids": [1, 15, 22]
}
```

**Updated Response:**
```json
{
  "success": true,
  "message": "Review submitted successfully",
  "data": {
    "id": 42,
    "rating": 5,
    "comment": "Отличный ресторан!",
    "selected_answers": [
      {"id": 1, "key": "good_service", "text": "Baqaw xızmet"},
      {"id": 15, "key": "breakfast", "text": "Taňgilik"}
    ],
    "created_at": "2024-01-15 10:30:00"
  }
}
```

---

## Database Schema

The following tables are used (created by migrations, seeded by ReviewQuestionsSeeder):

1. **questions_categories** - Question category definitions
   - Fields: id, key, sort_order, is_required, is_active
   - Contains 4 categories (what_did_you_like, what_caused_dissatisfaction, meal_category, would_return)

2. **questions_category_translations** - Category translations (4 languages each)
   - Fields: id, questions_category_id, lang_code, title, description

3. **questions_options** - Answer options for categories
   - Fields: id, questions_category_id, key, sort_order, is_active
   - Contains 25 options total (7+8+6+4)

4. **questions_option_translations** - Option translations (4 languages each)
   - Fields: id, questions_option_id, lang_code, text

5. **review_answers** - Junction table (many-to-many)
   - Fields: id, review_id, questions_option_id, created_at, updated_at
   - Links reviews to their selected question options

---

## Backward Compatibility

✅ **All changes are backward compatible:**
- `selected_option_ids` is optional in review submission
- `selected_answers` is only included in response if relationship is loaded
- Existing reviews without answers will have empty `selected_answers` array
- Rate limiting and other validation remains unchanged
- Guest reviews continue to work without authentication

---

## Verification Steps

### 1. Database Setup
```bash
# Run migrations and seeders
php artisan migrate:fresh --seed

# Verify question data was seeded
php artisan tinker
>>> \App\Models\QuestionCategory::count()  # Should return 4
>>> \App\Models\QuestionOption::count()     # Should return 25
```

### 2. Test GET /api/questions
```bash
# Test with default locale
curl http://localhost:8000/api/questions

# Test with specific language
curl -H "Accept-Language: ru" http://localhost:8000/api/questions
curl -H "Accept-Language: uz" http://localhost:8000/api/questions

# Verify response structure
# - success: true
# - data array with 4 categories
# - each category has options array with correct translations
```

### 3. Test POST /api/restaurants/{id}/reviews with answers
```bash
curl -X POST http://localhost:8000/api/restaurants/1/reviews \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": "test-device-123",
    "rating": 5,
    "comment": "Great food!",
    "selected_option_ids": [1, 15, 22]
  }'

# Verify response includes:
# - selected_answers with translated text
# - All 3 selected options in response
```

### 4. Test Answer Storage
```bash
php artisan tinker
>>> \App\Models\Review::find(1)->selectedOptions()->get()
# Should return 3 QuestionOption models

>>> \App\Models\Review::find(1)->selectedOptions->count()  # Should be 3
```

### 5. Test Language-Aware Display
```bash
# In tinker with different locales
>>> app()->setLocale('kk')
>>> \App\Models\QuestionOption::find(1)->getTranslatedText()  # Kazakh text

>>> app()->setLocale('ru')
>>> \App\Models\QuestionOption::find(1)->getTranslatedText()  # Russian text
```

### 6. Verify Swagger Documentation
```bash
# Regenerate Swagger docs
php artisan l5-swagger:generate

# Open in browser: http://localhost:8000/api/documentation
# Verify:
# - New "❓ Savollar" tag appears
# - GET /api/questions endpoint is documented
# - POST /api/restaurants/{id}/reviews shows selected_option_ids field
```

### 7. Test Required/Optional Validation
```bash
# Test submit without answers (should work - answers are optional)
curl -X POST http://localhost:8000/api/restaurants/1/reviews \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": "test-device-456",
    "rating": 3,
    "comment": "Okay food"
  }'

# Test with invalid option ID (should return 422)
curl -X POST http://localhost:8000/api/restaurants/1/reviews \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": "test-device-789",
    "rating": 4,
    "selected_option_ids": [99999]
  }'
```

---

## Files Modified/Created

### Created Files:
1. ✅ `app/Http/Controllers/Api/QuestionController.php` - API endpoint
2. ✅ `app/Http/Resources/QuestionCategoryResource.php` - Category transformation
3. ✅ `app/Http/Resources/QuestionOptionResource.php` - Option transformation

### Modified Files:
1. ✅ `database/seeders/DatabaseSeeder.php` - Register seeder
2. ✅ `app/Http/Requests/StoreReviewRequest.php` - Add selected_option_ids validation
3. ✅ `app/Services/ReviewService.php` - Handle answer sync
4. ✅ `app/Http/Controllers/Api/ReviewController.php` - Update Swagger docs
5. ✅ `app/Http/Resources/ReviewResource.php` - Add selected_answers field
6. ✅ `app/Repositories/ReviewRepository.php` - Eager load answers
7. ✅ `routes/api.php` - Add questions route

### Total: 10 files (3 new, 7 modified)

---

## Implementation Details

### Locale-Aware Translations
Both `QuestionCategoryResource` and `QuestionOptionResource` use:
```php
$locale = app()->getLocale();
$title = $this->getTranslatedTitle($locale);
```

This ensures the correct language is returned based on the current application locale or Accept-Language header.

### Answer Syncing
When a review is created with `selected_option_ids`:
1. ServiceProvider extracts the IDs array
2. Review is created normally
3. `sync()` is called on the `selectedOptions()` BelongsToMany relationship
4. The many-to-many junction table (`review_answers`) is populated

### Data Integrity
- Options must exist in database (validated by `exists:questions_options,id`)
- Only active questions and options are returned via API
- Reviews can be created without answers (backward compatible)
- All answers are properly translated based on locale

---

## Next Steps (Optional Features)

These phases were marked as optional in the plan but can be implemented:

### Phase 7: Admin Blade Interface
- CRUD operations for managing questions and options
- Answer statistics dashboard
- Translation management with tab-based forms

### Phase 8: Review Display Enhancement
- Frontend display of selected answers in review list
- Visual badges/pills for answers
- Answer filtering in admin review management

---

## Testing Checklist

- [ ] Database migrations run without errors
- [ ] Seeder populates 4 categories with 25 options
- [ ] GET /api/questions returns all categories with nested options
- [ ] Language switching works with Accept-Language header
- [ ] POST review with selected_option_ids stores answers correctly
- [ ] POST review without answers works (backward compatible)
- [ ] Invalid option IDs return 422 validation error
- [ ] ReviewResource includes translated selected_answers
- [ ] Swagger documentation regenerates and displays correctly
- [ ] Rate limiting still works for reviews
- [ ] Guest reviews work without authentication
