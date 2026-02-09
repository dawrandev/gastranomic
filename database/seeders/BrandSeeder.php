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
                'name' => 'Cake Bumer',
                'logo' => 'brands/logos/5dMqFqk7p7tAXhMIOrN590fIrsbEaAQi6vmBVECs.jpg',
                'description' => 'Роскошные десерты из свежих ингредиентов и сытный Fastfood',
                'created_at' => '2026-01-29 05:44:25',
                'updated_at' => '2026-01-29 07:27:07',
            ],
            [
                'id' => 2,
                'name' => 'Grand Lavash',
                'logo' => 'brands/logos/39TnmeysQsR2AFsJuAe2PzG59akezGGR5xGVjwSS.png',
                'description' => 'Nókis qalasındaǵı eń mazalı fast food',
                'created_at' => '2026-01-29 06:54:57',
                'updated_at' => '2026-01-29 06:58:19',
            ],
            [
                'id' => 3,
                'name' => 'Neo',
                'logo' => 'brands/logos/8nGRKsbI5Fvx8hzyiCbKWc3IFktCnj4VSJ12ycBV.jpg',
                'description' => 'Ресторан • Караоке • Танцпол',
                'created_at' => '2026-01-29 07:28:58',
                'updated_at' => '2026-01-29 07:28:58',
            ],
            [
                'id' => 4,
                'name' => 'Qaraqalpaǵım',
                'logo' => 'brands/logos/Z3FiOAGPKv9wD7XUobiu8VxEBLL8bzshtPiGYz3S.jpg',
                'description' => 'Каракалпагым Кафе',
                'created_at' => '2026-01-29 07:35:18',
                'updated_at' => '2026-01-29 07:35:18',
            ],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->updateOrInsert(
                ['id' => $brand['id']], // ID bo'yicha tekshiradi
                $brand                  // Ma'lumotlarni kiritadi yoki yangilaydi
            );
        }
    }
}
