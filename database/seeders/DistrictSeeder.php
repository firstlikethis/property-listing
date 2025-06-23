<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // กรุงเทพชั้นใน
        $innerBangkok = Zone::where('slug', 'inner-bangkok')->first();
        $innerBangkokDistricts = [
            ['name' => 'ปทุมวัน', 'slug' => 'pathumwan'],
            ['name' => 'บางรัก', 'slug' => 'bangrak'],
            ['name' => 'สาทร', 'slug' => 'sathorn'],
            ['name' => 'วัฒนา', 'slug' => 'watthana'],
            ['name' => 'คลองเตย', 'slug' => 'khlong-toei'],
            ['name' => 'ยานนาวา', 'slug' => 'yan-nawa'],
            ['name' => 'พระโขนง', 'slug' => 'phra-khanong']
        ];
        
        foreach ($innerBangkokDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $innerBangkok->id,
            ]);
        }
        
        // กรุงเทพชั้นกลาง
        $middleBangkok = Zone::where('slug', 'middle-bangkok')->first();
        $middleBangkokDistricts = [
            ['name' => 'ดินแดง', 'slug' => 'din-daeng'],
            ['name' => 'ห้วยขวาง', 'slug' => 'huai-khwang'],
            ['name' => 'พญาไท', 'slug' => 'phaya-thai'],
            ['name' => 'ราชเทวี', 'slug' => 'ratchathewi'],
            ['name' => 'จตุจักร', 'slug' => 'chatuchak'],
            ['name' => 'บางซื่อ', 'slug' => 'bang-sue'],
            ['name' => 'ลาดพร้าว', 'slug' => 'lat-phrao']
        ];
        
        foreach ($middleBangkokDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $middleBangkok->id,
            ]);
        }
        
        // กรุงเทพชั้นนอก
        $outerBangkok = Zone::where('slug', 'outer-bangkok')->first();
        $outerBangkokDistricts = [
            ['name' => 'บางกะปิ', 'slug' => 'bang-kapi'],
            ['name' => 'บางเขน', 'slug' => 'bang-khen'],
            ['name' => 'มีนบุรี', 'slug' => 'min-buri'],
            ['name' => 'ลาดกระบัง', 'slug' => 'lat-krabang'],
            ['name' => 'หนองจอก', 'slug' => 'nong-chok'],
            ['name' => 'ประเวศ', 'slug' => 'prawet'],
            ['name' => 'สวนหลวง', 'slug' => 'suan-luang']
        ];
        
        foreach ($outerBangkokDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $outerBangkok->id,
            ]);
        }
        
        // ปริมณฑล
        $metroArea = Zone::where('slug', 'metropolitan')->first();
        $metroAreaDistricts = [
            ['name' => 'นนทบุรี', 'slug' => 'nonthaburi'],
            ['name' => 'ปากเกร็ด', 'slug' => 'pak-kret'],
            ['name' => 'บางใหญ่', 'slug' => 'bang-yai'],
            ['name' => 'สมุทรปราการ', 'slug' => 'samut-prakan'],
            ['name' => 'บางพลี', 'slug' => 'bang-phli'],
            ['name' => 'คลองหลวง', 'slug' => 'khlong-luang'],
            ['name' => 'ธัญบุรี', 'slug' => 'thanyaburi']
        ];
        
        foreach ($metroAreaDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $metroArea->id,
            ]);
        }
        
        // หาดใหญ่
        $haiYai = Zone::where('slug', 'hatyai')->first();
        $haiYaiDistricts = [
            ['name' => 'หาดใหญ่', 'slug' => 'hat-yai'],
            ['name' => 'คลองแห', 'slug' => 'khlong-hae'],
            ['name' => 'คอหงส์', 'slug' => 'kho-hong'],
            ['name' => 'ควนลัง', 'slug' => 'khuan-lang'],
            ['name' => 'คลองหลา', 'slug' => 'khlong-la']
        ];
        
        foreach ($haiYaiDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $haiYai->id,
            ]);
        }
        
        // เชียงใหม่
        $chiangMai = Zone::where('slug', 'chiang-mai')->first();
        $chiangMaiDistricts = [
            ['name' => 'เมืองเชียงใหม่', 'slug' => 'mueang-chiang-mai'],
            ['name' => 'นิมมานเหมินทร์', 'slug' => 'nimman'],
            ['name' => 'สันทราย', 'slug' => 'san-sai'],
            ['name' => 'ช้างเผือก', 'slug' => 'chang-phueak'],
            ['name' => 'แม่ริม', 'slug' => 'mae-rim'],
            ['name' => 'สันกำแพง', 'slug' => 'san-kamphaeng']
        ];
        
        foreach ($chiangMaiDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $chiangMai->id,
            ]);
        }
        
        // พัทยา
        $pattaya = Zone::where('slug', 'pattaya')->first();
        $pattayaDistricts = [
            ['name' => 'พัทยาเหนือ', 'slug' => 'north-pattaya'],
            ['name' => 'พัทยากลาง', 'slug' => 'central-pattaya'],
            ['name' => 'พัทยาใต้', 'slug' => 'south-pattaya'],
            ['name' => 'จอมเทียน', 'slug' => 'jomtien'],
            ['name' => 'บางละมุง', 'slug' => 'bang-lamung'],
            ['name' => 'นาเกลือ', 'slug' => 'na-kluea']
        ];
        
        foreach ($pattayaDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $pattaya->id,
            ]);
        }
        
        // ภูเก็ต
        $phuket = Zone::where('slug', 'phuket')->first();
        $phuketDistricts = [
            ['name' => 'เมืองภูเก็ต', 'slug' => 'mueang-phuket'],
            ['name' => 'ป่าตอง', 'slug' => 'patong'],
            ['name' => 'กะทู้', 'slug' => 'kathu'],
            ['name' => 'ฉลอง', 'slug' => 'chalong'],
            ['name' => 'กะรน', 'slug' => 'karon'],
            ['name' => 'กมลา', 'slug' => 'kamala']
        ];
        
        foreach ($phuketDistricts as $district) {
            District::create([
                'name' => $district['name'],
                'slug' => $district['slug'],
                'zone_id' => $phuket->id,
            ]);
        }
    }
}