<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CityRepository
{
    public function paginate(int $perPage = 15, ?string $search = null): LengthAwarePaginator
    {
        $query = City::withCount(['restaurants']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->latest()->paginate($perPage);
    }

    public function findById(int $id): ?City
    {
        return City::with(['restaurants'])->find($id);
    }

    public function create(array $data): City
    {
        return DB::transaction(function () use ($data) {
            return City::create([
                'name' => $data['name'],
            ]);
        });
    }

    public function update(City $city, array $data): City
    {
        return DB::transaction(function () use ($city, $data) {
            $city->update([
                'name' => $data['name'],
            ]);

            return $city->fresh();
        });
    }

    public function delete(City $city): bool
    {
        return DB::transaction(function () use ($city) {
            return $city->delete();
        });
    }
}
