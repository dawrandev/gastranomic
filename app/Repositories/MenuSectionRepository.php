<?php

namespace App\Repositories;

use App\Models\MenuSection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class MenuSectionRepository
{
    public function getAllByBrand(int $brandId): Collection
    {
        return MenuSection::where('brand_id', $brandId)
            ->with('translations')
            ->withCount('menuItems')
            ->orderBy('sort_order')
            ->get();
    }

    public function paginate(int $brandId, int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        $query = MenuSection::where('brand_id', $brandId)
            ->with('translations')
            ->withCount('menuItems');

        if ($search) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('sort_order')->paginate($perPage);
    }

    public function findById(int $id): ?MenuSection
    {
        return MenuSection::with(['brand', 'menuItems', 'translations'])->find($id);
    }

    public function create(array $data): MenuSection
    {
        return DB::transaction(function () use ($data) {
            $menuSection = MenuSection::create([
                'brand_id' => $data['brand_id'],
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            // Create translations
            if (isset($data['translations'])) {
                foreach ($data['translations'] as $langCode => $translation) {
                    $menuSection->translations()->create([
                        'lang_code' => $langCode,
                        'name' => $translation['name'],
                    ]);
                }
            }

            return $menuSection->fresh('translations');
        });
    }

    public function update(MenuSection $menuSection, array $data): MenuSection
    {
        return DB::transaction(function () use ($menuSection, $data) {
            $menuSection->update([
                'sort_order' => $data['sort_order'] ?? $menuSection->sort_order,
            ]);

            // Update translations
            if (isset($data['translations'])) {
                foreach ($data['translations'] as $langCode => $translation) {
                    $menuSection->translations()->updateOrCreate(
                        ['lang_code' => $langCode],
                        ['name' => $translation['name']]
                    );
                }
            }

            return $menuSection->fresh('translations');
        });
    }

    public function delete(MenuSection $menuSection): bool
    {
        return DB::transaction(function () use ($menuSection) {
            return $menuSection->delete();
        });
    }
}
