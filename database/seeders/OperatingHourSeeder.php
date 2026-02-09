<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperatingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operatingHours = [
            // Restaurant 1: 09:00 - 23:00 (Hafta davomida)
            ['restaurant_id' => 1, 'open' => '09:00:00', 'close' => '23:00:00', 'created' => '2026-01-29 05:46:17'],

            // Restaurant 2: 10:00 - 03:00
            ['restaurant_id' => 2, 'open' => '10:00:00', 'close' => '03:00:00', 'created' => '2026-01-29 07:02:50'],

            // Restaurant 4: 10:00 - 03:00
            ['restaurant_id' => 4, 'open' => '10:00:00', 'close' => '03:00:00', 'created' => '2026-01-29 07:26:28'],

            // Restaurant 5: 09:00 - 02:00
            ['restaurant_id' => 5, 'open' => '09:00:00', 'close' => '02:00:00', 'created' => '2026-01-29 07:32:19'],

            // Restaurant 6: 09:00 - 00:00
            ['restaurant_id' => 6, 'open' => '09:00:00', 'close' => '00:00:00', 'created' => '2026-01-29 07:38:39'],
        ];

        foreach ($operatingHours as $config) {
            // Har bir restoran uchun 0 dan 6 gacha (Dushanbadan Yakshangabagacha) kunlarni yaratamiz
            foreach (range(0, 6) as $day) {
                DB::table('operating_hours')->insert([
                    'restaurant_id' => $config['restaurant_id'],
                    'day_of_week'   => $day,
                    'opening_time'  => $config['open'],
                    'closing_time'  => $config['close'],
                    'is_closed'     => 0,
                    'created_at'    => $config['created'],
                    'updated_at'    => $config['created'],
                ]);
            }
        }
    }
}
