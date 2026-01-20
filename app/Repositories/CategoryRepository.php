<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function paginate(int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        $query = Category::with(['translations']);

        if ($search) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function findById(int $id): ?Category
    {
        return Category::with(['translations', 'restaurants'])->find($id);
    }

    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $category = Category::create([
                'icon' => $data['icon'] ?? null,
            ]);

            if (isset($data['translations'])) {
                foreach ($data['translations'] as $translation) {
                    $category->translations()->create($translation);
                }
            }

            return $category->load('translations');
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {
            $category->update([
                'icon' => $data['icon'] ?? $category->icon,
            ]);

            if (isset($data['translations'])) {
                $category->translations()->delete();
                foreach ($data['translations'] as $translation) {
                    $category->translations()->create($translation);
                }
            }

            return $category->fresh('translations');
        });
    }

    public function delete(Category $category): bool
    {
        return DB::transaction(function () use ($category) {
            $category->translations()->delete();
            $category->restaurants()->detach();
            return $category->delete();
        });
    }
}
