<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'คอนโดมิเนียม', 'slug' => 'condominium'],
            ['name' => 'อพาร์ทเมนท์', 'slug' => 'apartment'],
            ['name' => 'หอพัก', 'slug' => 'dormitory'],
            ['name' => 'บ้านเดี่ยว', 'slug' => 'single-house'],
            ['name' => 'บ้านแฝด', 'slug' => 'duplex-house'],
            ['name' => 'ทาวน์โฮม', 'slug' => 'townhome'],
            ['name' => 'ทาวน์เฮ้าส์', 'slug' => 'townhouse'],
            ['name' => 'โฮมออฟฟิศ', 'slug' => 'home-office'],
            ['name' => 'โรงแรม', 'slug' => 'hotel'],
            ['name' => 'รีสอร์ท', 'slug' => 'resort'],
            ['name' => 'พูลวิลล่า', 'slug' => 'pool-villa']
        ];

        foreach ($types as $type) {
            Type::create([
                'name' => $type['name'],
                'slug' => $type['slug']
            ]);
        }
    }
}