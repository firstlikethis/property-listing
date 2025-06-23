<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'เครื่องปรับอากาศ', 'slug' => 'air-conditioner', 'icon' => 'fas fa-snowflake'],
            ['name' => 'เฟอร์นิเจอร์ครบ', 'slug' => 'fully-furnished', 'icon' => 'fas fa-couch'],
            ['name' => 'เครื่องทำน้ำอุ่น', 'slug' => 'water-heater', 'icon' => 'fas fa-temperature-high'],
            ['name' => 'Wi-Fi', 'slug' => 'wifi', 'icon' => 'fas fa-wifi'],
            ['name' => 'ที่จอดรถ', 'slug' => 'parking', 'icon' => 'fas fa-parking'],
            ['name' => 'ลิฟท์', 'slug' => 'elevator', 'icon' => 'fas fa-arrow-up'],
            ['name' => 'ระบบรักษาความปลอดภัย 24 ชม.', 'slug' => 'security-24hr', 'icon' => 'fas fa-shield-alt'],
            ['name' => 'กล้องวงจรปิด', 'slug' => 'cctv', 'icon' => 'fas fa-video'],
            ['name' => 'สระว่ายน้ำ', 'slug' => 'swimming-pool', 'icon' => 'fas fa-swimming-pool'],
            ['name' => 'ฟิตเนส', 'slug' => 'fitness', 'icon' => 'fas fa-dumbbell'],
            ['name' => 'ซาวน่า', 'slug' => 'sauna', 'icon' => 'fas fa-hot-tub'],
            ['name' => 'สวนส่วนกลาง', 'slug' => 'garden', 'icon' => 'fas fa-tree'],
            ['name' => 'ห้องประชุม', 'slug' => 'meeting-room', 'icon' => 'fas fa-users'],
            ['name' => 'ห้องสมุด', 'slug' => 'library', 'icon' => 'fas fa-book'],
            ['name' => 'ห้องเล่นเกม', 'slug' => 'game-room', 'icon' => 'fas fa-gamepad'],
            ['name' => 'สนามเด็กเล่น', 'slug' => 'playground', 'icon' => 'fas fa-child'],
            ['name' => 'ร้านสะดวกซื้อ', 'slug' => 'convenience-store', 'icon' => 'fas fa-store'],
            ['name' => 'ร้านซักรีด', 'slug' => 'laundry', 'icon' => 'fas fa-tshirt'],
            ['name' => 'รับเลี้ยงสัตว์เลี้ยง', 'slug' => 'pet-friendly', 'icon' => 'fas fa-paw'],
            ['name' => 'ร้านอาหาร', 'slug' => 'restaurant', 'icon' => 'fas fa-utensils'],
            ['name' => 'รถรับส่ง', 'slug' => 'shuttle-service', 'icon' => 'fas fa-shuttle-van'],
            ['name' => 'ระเบียง', 'slug' => 'balcony', 'icon' => 'fas fa-door-open'],
            ['name' => 'ตู้เย็น', 'slug' => 'refrigerator', 'icon' => 'fas fa-temperature-low'],
            ['name' => 'เครื่องซักผ้า', 'slug' => 'washing-machine', 'icon' => 'fas fa-soap'],
            ['name' => 'ไมโครเวฟ', 'slug' => 'microwave', 'icon' => 'fas fa-radiation'],
            ['name' => 'เตาไฟฟ้า', 'slug' => 'electric-stove', 'icon' => 'fas fa-fire'],
            ['name' => 'ตู้เสื้อผ้า', 'slug' => 'wardrobe', 'icon' => 'fas fa-archive'],
            ['name' => 'โต๊ะทำงาน', 'slug' => 'desk', 'icon' => 'fas fa-desk'],
            ['name' => 'เคเบิลทีวี', 'slug' => 'cable-tv', 'icon' => 'fas fa-tv'],
            ['name' => 'ทีวีดิจิตอล', 'slug' => 'digital-tv', 'icon' => 'fas fa-tv'],
            ['name' => 'ตู้นิรภัย', 'slug' => 'safe-box', 'icon' => 'fas fa-lock'],
        ];

        foreach ($facilities as $facility) {
            Facility::create([
                'name' => $facility['name'],
                'slug' => $facility['slug'],
                'icon' => $facility['icon'],
            ]);
        }
    }
}