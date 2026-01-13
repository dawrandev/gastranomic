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

        $adminOsh = User::create([
            'name' => 'Osh Markazi Admini',
            'login' => 'osh_admin',
            'password' => Hash::make('password'),
        ]);
        $adminOsh->assignRole('admin');

        $adminCity = User::create([
            'name' => 'City Cafe Admini',
            'login' => 'city_admin',
            'password' => Hash::make('password'),
        ]);
        $adminCity->assignRole('admin');
    }
}
