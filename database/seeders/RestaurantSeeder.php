<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $oshAdmin = User::where('login', 'osh_admin')->first();
        $cityAdmin = User::where('login', 'city_admin')->first();

        $oshBrand = Brand::where('name', 'Osh Markazi Tarmog\'i')->first();
        $cityBrand = Brand::where('name', 'City Cafe Chain')->first();
        $tashkent = City::where('name', 'Toshkent')->first();

        if ($oshAdmin && $oshBrand && $tashkent) {
            Restaurant::create([
                'user_id'     => $oshAdmin->id,
                'brand_id'    => $oshBrand->id,
                'city_id'     => $tashkent->id,
                'branch_name' => 'Buxoro Filiali', // Migratsiyangizda branch_name
                'phone'       => '998901234567',
                'description' => 'Eng mazali Buxoro oshi',
                'address'     => 'Toshkent sh., O\'zbekiston ko\'chasi, 15-uy',
                'location'    => DB::raw("ST_GeomFromText('POINT(69.2401 41.2995)')"),
                'is_active'   => true,
            ]);
        }

        if ($cityAdmin && $cityBrand && $tashkent) {
            Restaurant::create([
                'user_id'     => $cityAdmin->id,
                'brand_id'    => $cityBrand->id,
                'city_id'     => $tashkent->id,
                'branch_name' => 'Markaziy Filial',
                'phone'       => '998939876543',
                'description' => 'Shahar markazidagi shinam kafe',
                'address'     => 'Toshkent sh., Amir Temur xiyoboni, 5-uy',
                'location'    => DB::raw("ST_GeomFromText('POINT(69.2831 41.3111)')"),
                'is_active'   => true,
            ]);
        }
    }
}
