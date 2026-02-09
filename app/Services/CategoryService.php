<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {}

    public function getCategories(?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->categoryRepository->paginate($perPage, $search);
    }

    public function findCategory(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function createCategory(array $data): Category
    {
        if (isset($data['icon'])) {
            $data['icon'] = $this->uploadIcon($data['icon']);
        }

        return $this->categoryRepository->create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        if (isset($data['icon']) && $data['icon']) {
            // Delete old icon
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $data['icon'] = $this->uploadIcon($data['icon']);
        } else {
            unset($data['icon']);
        }

        return $this->categoryRepository->update($category, $data);
    }

    public function deleteCategory(Category $category): bool
    {
        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        return $this->categoryRepository->delete($category);
    }

    private function uploadIcon($file): string
    {
        return $file->store('categories/icons', 'public');
    }

    public function prepareTranslations(array $requestData): array
    {
        $translations = [];

        if (isset($requestData['translations'])) {
            foreach ($requestData['translations'] as $langCode => $translation) {
                // Handle both new nested format and legacy flat format
                if (is_array($translation)) {
                    // New format: ['name' => '...', 'description' => '...']
                    $name = $translation['name'] ?? null;
                    $description = $translation['description'] ?? null;
                } else {
                    // Legacy format: direct string value
                    $name = $translation;
                    $description = null;
                }

                if (!empty($name)) {
                    $translations[] = [
                        'code' => $langCode,
                        'name' => $name,
                        'description' => $description,
                    ];
                }
            }
        }

        return $translations;
    }
}
