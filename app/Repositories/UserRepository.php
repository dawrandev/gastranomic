<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll(array $filters = [])
    {
        $query = User::query();

        $query->when(isset($filters['search']), function ($q) use ($filters) {
            $search = $filters['search'];

            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhereHas('restaurant', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });
        });

        return $query->with('restaurant')->paginate(10);
    }
}
