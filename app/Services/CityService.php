<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CityService
{
    public function __construct(
        private CityRepository $repository
    ) {}

    public function getCities(?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $search);
    }

    public function findCity(int $id): ?City
    {
        return $this->repository->findById($id);
    }

    public function createCity(array $data): City
    {
        return $this->repository->create($data);
    }

    public function updateCity(City $city, array $data): City
    {
        return $this->repository->update($city, $data);
    }

    public function deleteCity(City $city): bool
    {
        return $this->repository->delete($city);
    }
}
