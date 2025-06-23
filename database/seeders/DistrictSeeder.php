<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // กรุงเทพกลาง
        $centerZone = Zone::where('name', 'กรุงเทพกลาง')->first();
        if ($centerZone) {
            $districts = [
                'พระนคร', 'ดุสิต', 'ป้อมปราบศัตรูพ่าย', 'สัมพันธวงศ์', 'ดินแดง', 'ห้วยขวาง', 'พญาไท', 'ราชเทวี', 'วังทองหลาง'
            ];
            $this->createDistricts($districts, $centerZone->id);
        }

        // กรุงเทพเหนือ
        $northZone = Zone::where('name', 'กรุงเทพเหนือ')->first();
        if ($northZone) {
            $districts = [
                'จตุจักร', 'บางซื่อ', 'ลาดพร้าว', 'หลักสี่', 'ดอนเมือง', 'สายไหม', 'บางเขน'
            ];
            $this->createDistricts($districts, $northZone->id);
        }

        // กรุงเทพใต้
        $southZone = Zone::where('name', 'กรุงเทพใต้')->first();
        if ($southZone) {
            $districts = [
                'คลองเตย', 'บางคอแหลม', 'ปทุมวัน', 'บางรัก', 'สาทร', 'ยานนาวา', 'วัฒนา', 'พระโขนง', 'สวนหลวง', 'บางนา'
            ];
            $this->createDistricts($districts, $southZone->id);
        }

        // กรุงเทพตะวันออก
        $eastZone = Zone::where('name', 'กรุงเทพตะวันออก')->first();
        if ($eastZone) {
            $districts = [
                'บางกะปิ', 'สะพานสูง', 'บึงกุ่ม', 'คันนายาว', 'ลาดกระบัง', 'มีนบุรี', 'หนองจอก', 'คลองสามวา', 'ประเวศ'
            ];
            $this->createDistricts($districts, $eastZone->id);
        }

        // กรุงเทพตะวันตก
        $westZone = Zone::where('name', 'กรุงเทพตะวันตก')->first();
        if ($westZone) {
            $districts = [
                'ธนบุรี', 'คลองสาน', 'จอมทอง', 'บางขุนเทียน', 'บางบอน', 'บางแค', 'ภาษีเจริญ', 'หนองแขม', 'ราษฎร์บูรณะ', 'ทุ่งครุ', 'ทวีวัฒนา', 'ตลิ่งชัน', 'บางพลัด', 'บางกอกน้อย', 'บางกอกใหญ่'
            ];
            $this->createDistricts($districts, $westZone->id);
        }

        // ปริมณฑล
        $suburbanZone = Zone::where('name', 'ปริมณฑล')->first();
        if ($suburbanZone) {
            $districts = [
                'นนทบุรี', 'ปากเกร็ด', 'บางบัวทอง', 'บางใหญ่', 'บางกรวย', 'ไทรน้อย',
                'สมุทรปราการ', 'พระประแดง', 'พระสมุทรเจดีย์', 'บางพลี', 'บางบ่อ', 'เมืองสมุทรปราการ',
                'ปทุมธานี', 'คลองหลวง', 'ธัญบุรี', 'ลำลูกกา', 'ลาดหลุมแก้ว', 'สามโคก', 'หนองเสือ'
            ];
            $this->createDistricts($districts, $suburbanZone->id);
        }
    }

    /**
     * Create districts for a zone.
     */
    private function createDistricts(array $districts, $zoneId)
    {
        foreach ($districts as $name) {
            District::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'zone_id' => $zoneId,
            ]);
        }
    }
}