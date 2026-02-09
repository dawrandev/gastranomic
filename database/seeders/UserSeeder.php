<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
                'role' => 'superadmin',
            ],
            [
                'id' => 2,
                'brand_id' => 1,
                'name' => 'Cake Bumer Admin',
                'login' => 'cakebumer',
                'password' => Hash::make('cakebumer'),
                'created_at' => '2026-01-29 05:45:14',
                'role' => 'admin',
            ],
            [
                'id' => 3,
                'brand_id' => 2,
                'name' => 'Grand Lavash Admini',
                'login' => 'grand123',
                'password' => Hash::make('grand123'),
                'created_at' => '2026-01-29 06:55:54',
                'role' => 'admin',
            ],
            [
                'id' => 4,
                'brand_id' => 3,
                'name' => 'Neo Admin',
                'login' => 'neo12345',
                'password' => Hash::make('neo12345'),
                'created_at' => '2026-01-29 07:29:44',
                'role' => 'admin',
            ],
            [
                'id' => 5,
                'brand_id' => 4,
                'name' => 'Qaraqalpaǵım Admin',
                'login' => 'qaraqalpaq',
                'password' => Hash::make('qaraqalpaq'),
                'created_at' => '2026-01-29 07:35:51',
                'role' => 'admin',
            ],
        ];

        foreach ($users as $userData) {
            // Extract role from user data
            $role = $userData['role'];
            unset($userData['role']);

            // Create or update user
            $user = User::updateOrCreate(
                ['id' => $userData['id']],
                [
                    'brand_id'      => $userData['brand_id'],
                    'name'          => $userData['name'],
                    'login'         => $userData['login'],
                    'password'      => $userData['password'],
                    'created_at'    => $userData['created_at'],
                    'updated_at'    => $userData['created_at'],
                ]
            );

            // Assign role to user
            if (!$user->hasRole($role)) {
                $user->assignRole($role);
            }
        }

        $this->command->info('Users created and roles assigned successfully!');
    }
}
