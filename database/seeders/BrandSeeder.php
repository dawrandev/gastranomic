<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'id' => 1,
                'logo' => 'brands/logos/9HmgIpTfGmKI4lBDSltXtaYhuksoVlztGQpiO99F.png',
                'created_at' => '2026-01-29 00:44:25',
                'updated_at' => '2026-01-29 02:27:07',
            ],
            [
                'id' => 2,
                'logo' => 'brands/logos/9jjJ4N0RZvydpA1eou2xHrJPS1shNs6WHyOcnc6v.png',
                'created_at' => '2026-01-29 01:54:57',
                'updated_at' => '2026-01-29 01:58:19',
            ],
            [
                'id' => 3,
                'logo' => 'brands/logos/9kRULfr5hKBKTDunjZEYBrNt1uYMa1fLu4jBpeSM.png',
                'created_at' => '2026-01-29 02:28:58',
                'updated_at' => '2026-01-29 02:28:58',
            ],
            [
                'id' => 4,
                'logo' => 'brands/logos/ag61sJUwjBLn3AeDgLkOaXHcbiR6IUVoRPgr0BsI.png',
                'created_at' => '2026-01-29 02:35:18',
                'updated_at' => '2026-01-29 02:35:18',
            ],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->updateOrInsert(
                ['id' => $brand['id']], // ID bo'yicha tekshiradi
                [
                    'logo' => $brand['logo'],
                    'created_at' => $brand['created_at'],
                    'updated_at' => $brand['updated_at'],
                ]
            );
        }
    }
}
