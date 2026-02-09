<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'brand_id' => null,
                'name' => 'Asosiy Boshqaruvchi',
                'login' => 'superadmin',
                'password' => '$2y$12$QYl46CiuNyG.PoCR2opCQ.njghPlkEM.naP4eYu4Nb7.vhqrdFQ8u',
                'created_at' => '2026-01-29 05:44:04',
            ],
            [
                'id' => 2,
                'brand_id' => 1,
                'name' => 'Cake Bumer Admin',
                'login' => 'cakebumer',
                'password' => '$2y$12$/kCtgNZyXKRB9QmTe1X5seT0oT6Q4epglOWEAthwOFLtdvJ.ox7ti',
                'created_at' => '2026-01-29 05:45:14',
            ],
            [
                'id' => 3,
                'brand_id' => 2,
                'name' => 'Grand Lavash Admini',
                'login' => 'grand123',
                'password' => '$2y$12$Jq.TTp1BlYtAfu9WU6bHU.HO8EJb2AKh5Nf1WEKRrOuLJWR0O372W',
                'created_at' => '2026-01-29 06:55:54',
            ],
            [
                'id' => 4,
                'brand_id' => 3,
                'name' => 'Neo Admin',
                'login' => 'neo12345',
                'password' => '$2y$12$0T3aGDsQy80poqh70phABuU5ErtVXBVRYpPv8EnvEG0apGV4GU3DK',
                'created_at' => '2026-01-29 07:29:44',
            ],
            [
                'id' => 5,
                'brand_id' => 4,
                'name' => 'Qaraqalpaǵım Admin',
                'login' => 'qaraqalpaq',
                'password' => '$2y$12$RsFDQT/0NQMT1MJ89iK2vuuxWMEPiO5DmVVlmT0n6d6x4zVY2mHj2',
                'created_at' => '2026-01-29 07:35:51',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['id' => $user['id']],
                [
                    'brand_id'      => $user['brand_id'],
                    'name'          => $user['name'],
                    'login'         => $user['login'],
                    'password'      => $user['password'],
                    'remember_token' => null,
                    'created_at'    => $user['created_at'],
                    'updated_at'    => $user['created_at'],
                ]
            );
        }
    }
}
