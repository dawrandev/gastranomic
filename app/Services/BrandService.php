<?php

namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function __construct(
        private BrandRepository $repository
    ) {}

    public function getBrands(?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $search);
    }

    public function findBrand(int $id): ?Brand
    {
        return $this->repository->findById($id);
    }

    public function createBrand(array $data): Brand
    {
        if (isset($data['logo'])) {
            $data['logo'] = $this->uploadLogo($data['logo']);
        }

        return $this->repository->create($data);
    }

    public function updateBrand(Brand $brand, array $data): Brand
    {
        if (isset($data['logo']) && $data['logo']) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $this->uploadLogo($data['logo']);
        } else {
            unset($data['logo']);
        }

        return $this->repository->update($brand, $data);
    }

    public function deleteBrand(Brand $brand): bool
    {
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        return $this->repository->delete($brand);
    }

    private function uploadLogo($file): string
    {
        return $file->store('brands/logos', 'public');
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
                        'lang_code' => $langCode,
                        'name' => $name,
                        'description' => $description,
                    ];
                }
            }
        }

        return $translations;
    }
}
