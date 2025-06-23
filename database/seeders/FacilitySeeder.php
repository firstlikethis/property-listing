<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'เครื่องปรับอากาศ', 'icon' => 'air-conditioner'],
            ['name' => 'เฟอร์นิเจอร์', 'icon' => 'furniture'],
            ['name' => 'ที่จอดรถ', 'icon' => 'parking'],
            ['name' => 'สระว่ายน้ำ', 'icon' => 'swimming-pool'],
            ['name' => 'ฟิตเนส', 'icon' => 'fitness'],
            ['name' => 'รักษาความปลอดภัย 24 ชม.', 'icon' => 'security'],
            ['name' => 'กล้องวงจรปิด', 'icon' => 'cctv'],
            ['name' => 'ลิฟท์', 'icon' => 'elevator'],
            ['name' => 'อินเทอร์เน็ต / WiFi', 'icon' => 'wifi'],
            ['name' => 'สวนส่วนกลาง', 'icon' => 'garden'],
            ['name' => 'เครื่องซักผ้า', 'icon' => 'washing-machine'],
            ['name' => 'ร้านสะดวกซื้อ', 'icon' => 'convenience-store'],
            ['name' => 'ระเบียง', 'icon' => 'balcony'],
            ['name' => 'ห้องประชุม', 'icon' => 'meeting-room'],
            ['name' => 'ร้านอาหาร', 'icon' => 'restaurant'],
            ['name' => 'ซาวน่า', 'icon' => 'sauna'],
            ['name' => 'จากุซซี่', 'icon' => 'jacuzzi'],
            ['name' => 'เครื่องทำน้ำอุ่น', 'icon' => 'water-heater'],
            ['name' => 'ตู้เย็น', 'icon' => 'refrigerator'],
            ['name' => 'ไมโครเวฟ', 'icon' => 'microwave'],
            ['name' => 'ทีวี', 'icon' => 'tv'],
            ['name' => 'Digital Door Lock', 'icon' => 'digital-lock'],
            ['name' => 'Co-working Space', 'icon' => 'coworking'],
            ['name' => 'ห้องเด็กเล่น', 'icon' => 'playroom'],
        ];

        foreach ($facilities as $facility) {
            Facility::create([
                'name' => $facility['name'],
                'slug' => Str::slug($facility['name']),
                'icon' => $facility['icon'],
            ]);
        }
    }
}