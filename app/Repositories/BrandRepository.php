<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BrandRepository
{
    public function paginate(int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        $query = Brand::with(['translations'])->withCount(['restaurants', 'users']);

        if ($search) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function findById(int $id): ?Brand
    {
        return Brand::with(['translations', 'restaurants', 'users'])->find($id);
    }

    public function create(array $data): Brand
    {
        return DB::transaction(function () use ($data) {
            $brand = Brand::create([
                'logo' => $data['logo'] ?? null,
            ]);

            if (isset($data['translations'])) {
                foreach ($data['translations'] as $translation) {
                    $brand->translations()->create($translation);
                }
            }

            return $brand->load('translations');
        });
    }

    public function update(Brand $brand, array $data): Brand
    {
        return DB::transaction(function () use ($brand, $data) {
            $brand->update([
                'logo' => $data['logo'] ?? $brand->logo,
            ]);

            if (isset($data['translations'])) {
                $brand->translations()->delete();
                foreach ($data['translations'] as $translation) {
                    $brand->translations()->create($translation);
                }
            }

            return $brand->fresh('translations');
        });
    }

    public function delete(Brand $brand): bool
    {
        return DB::transaction(function () use ($brand) {
            $brand->translations()->delete();
            return $brand->delete();
        });
    }
}
