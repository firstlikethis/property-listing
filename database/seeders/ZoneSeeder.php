<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => 'กรุงเทพชั้นใน', 'slug' => 'inner-bangkok'],
            ['name' => 'กรุงเทพชั้นกลาง', 'slug' => 'middle-bangkok'],
            ['name' => 'กรุงเทพชั้นนอก', 'slug' => 'outer-bangkok'],
            ['name' => 'ปริมณฑล', 'slug' => 'metropolitan'],
            ['name' => 'หาดใหญ่', 'slug' => 'hatyai'],
            ['name' => 'เชียงใหม่', 'slug' => 'chiang-mai'],
            ['name' => 'พัทยา', 'slug' => 'pattaya'],
            ['name' => 'ภูเก็ต', 'slug' => 'phuket'],
        ];

        foreach ($zones as $zone) {
            Zone::create([
                'name' => $zone['name'],
                'slug' => $zone['slug'],
            ]);
        }
    }
}