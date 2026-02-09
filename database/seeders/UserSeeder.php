<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make('password123'),
                'created_at' => '2026-01-29 05:44:04',
            ],
            [
                'id' => 2,
                'brand_id' => 1,
                'name' => 'Cake Bumer Admin',
                'login' => 'cakebumer',
                'password' => Hash::make('cakebumer'),
                'created_at' => '2026-01-29 05:45:14',
            ],
            [
                'id' => 3,
                'brand_id' => 2,
                'name' => 'Grand Lavash Admini',
                'login' => 'grand123',
                'password' => Hash::make('grand123'),
                'created_at' => '2026-01-29 06:55:54',
            ],
            [
                'id' => 4,
                'brand_id' => 3,
                'name' => 'Neo Admin',
                'login' => 'neo12345',
                'password' => Hash::make('neo12345'),
                'created_at' => '2026-01-29 07:29:44',
            ],
            [
                'id' => 5,
                'brand_id' => 4,
                'name' => 'Qaraqalpaǵım Admin',
                'login' => 'qaraqalpaq',
                'password' => Hash::make('qaraqalpaq'),
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
