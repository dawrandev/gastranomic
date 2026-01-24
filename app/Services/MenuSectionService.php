<?php

namespace App\Services;

use App\Models\MenuSection;
use App\Repositories\MenuSectionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuSectionService
{
    public function __construct(
        protected MenuSectionRepository $repository
    ) {}

    public function getAllByBrand(int $brandId): Collection
    {
        return $this->repository->getAllByBrand($brandId);
    }

    public function getMenuSections(int $brandId, ?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($brandId, $perPage, $search);
    }

    public function findMenuSection(int $id): ?MenuSection
    {
        return $this->repository->findById($id);
    }

    public function createMenuSection(array $data): MenuSection
    {
        return $this->repository->create($data);
    }

    public function updateMenuSection(MenuSection $menuSection, array $data): MenuSection
    {
        return $this->repository->update($menuSection, $data);
    }

    public function deleteMenuSection(MenuSection $menuSection): bool
    {
        return $this->repository->delete($menuSection);
    }
}
