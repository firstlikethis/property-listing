<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'คอนโดมิเนียม',
            'อพาร์ตเมนต์',
            'หอพัก',
            'บ้านเดี่ยว',
            'บ้านแฝด',
            'ทาวน์โฮม',
            'ทาวน์เฮ้าส์',
            'โฮมออฟฟิศ',
            'อาคารพาณิชย์',
            'วิลล่า',
            'รีสอร์ท',
            'แมนชั่น'
        ];

        foreach ($types as $name) {
            Type::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}