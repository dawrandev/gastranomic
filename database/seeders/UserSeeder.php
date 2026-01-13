<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Restaurant;

class UserSeeder extends Seeder
{
    public function run()
    {
        $superAdminUser = User::create([
            'name' => 'Asosiy Boshqaruvchi',
            'login' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
        $superAdminUser->assignRole('superadmin');

        $adminUser = User::create([
            'name' => 'Osh Markazi Admini',
            'login' => 'osh_admin',
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole('admin');
    }
}
