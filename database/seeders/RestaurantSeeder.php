<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oshAdmin = User::where('login', 'osh_admin')->first();
        $cityAdmin = User::where('login', 'city_admin')->first();

        if ($oshAdmin) {
            Restaurant::create([
                'user_id' => $oshAdmin->id,
                'name' => 'Osh Markazi "Buxoro"',
                'phone' => '998901234567',
                'address' => 'Toshkent sh., O\'zbekiston ko\'chasi, 15-uy',
                'is_active' => true,
            ]);
        }

        if ($cityAdmin) {
            Restaurant::create([
                'user_id' => $cityAdmin->id,
                'name' => 'City Cafe',
                'phone' => '998939876543',
                'address' => 'Toshkent sh., Amir Temur xiyoboni, 5-uy',
                'is_active' => true,
            ]);
        }
    }
}
