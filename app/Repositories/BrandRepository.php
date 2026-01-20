<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BrandRepository
{
    public function paginate(int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        $query = Brand::withCount(['restaurants', 'users']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function findById(int $id): ?Brand
    {
        return Brand::with(['restaurants', 'users'])->find($id);
    }

    public function create(array $data): Brand
    {
        return DB::transaction(function () use ($data) {
            return Brand::create([
                'name' => $data['name'],
                'logo' => $data['logo'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
        });
    }

    public function update(Brand $brand, array $data): Brand
    {
        return DB::transaction(function () use ($brand, $data) {
            $brand->update([
                'name' => $data['name'],
                'logo' => $data['logo'] ?? $brand->logo,
                'description' => $data['description'] ?? $brand->description,
            ]);

            return $brand->fresh();
        });
    }

    public function delete(Brand $brand): bool
    {
        return DB::transaction(function () use ($brand) {
            return $brand->delete();
        });
    }
}
