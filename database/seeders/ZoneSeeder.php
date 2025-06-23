<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            'กรุงเทพกลาง',
            'กรุงเทพเหนือ',
            'กรุงเทพใต้',
            'กรุงเทพตะวันออก',
            'กรุงเทพตะวันตก',
            'ปริมณฑล',
            'เชียงใหม่',
            'พัทยา',
            'หัวหิน',
            'ภูเก็ต',
        ];

        foreach ($zones as $name) {
            Zone::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}