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
                'password' => '$2y$12$iciKt8Q26TF5R2j8QNTJKemaBK.pBxCxJnoZCDPMN/XVg0retsVmG',
                'created_at' => '2026-01-29 00:44:04',
                'role' => 'superadmin',
            ],
            [
                'id' => 2,
                'brand_id' => 1,
                'name' => 'Cake Bumer Admin',
                'login' => 'cakebumer',
                'password' => '$2y$12$nRXMEWySSxzl/tbDHblghe9r7vA0UA7cIoFNPy8zt9dd8QVtVPL8C',
                'created_at' => '2026-01-29 00:45:14',
                'role' => 'admin',
            ],
            [
                'id' => 3,
                'brand_id' => 2,
                'name' => 'Grand Lavash Admini',
                'login' => 'grand123',
                'password' => '$2y$12$mX2XUHqJaEupp6fJW0SGdOEzM0LCed.cssnMtMwAWNd7s/iEFvIoK',
                'created_at' => '2026-01-29 01:55:54',
                'role' => 'admin',
            ],
            [
                'id' => 4,
                'brand_id' => 3,
                'name' => 'Neo Admin',
                'login' => 'neo12345',
                'password' => '$2y$12$PJNusANyMe4u7mblVlYAGOYAtNXCyt.uELHOvC//zn4Wl/I1OAtQu',
                'created_at' => '2026-01-29 02:29:44',
                'role' => 'admin',
            ],
            [
                'id' => 5,
                'brand_id' => 4,
                'name' => 'Qaraqalpaǵım Admin',
                'login' => 'qaraqalpaq',
                'password' => '$2y$12$DqGRxXI0xEJYYUSbe5F8Xew4XXVDWAzCL6z8MJe2QZXTzu/gKxLvy',
                'created_at' => '2026-01-29 02:35:51',
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
