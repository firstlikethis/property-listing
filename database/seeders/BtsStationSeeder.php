<?php

namespace Database\Seeders;

use App\Models\BtsStation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BtsStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // BTS สายสุขุมวิท (สีเขียวอ่อน)
        $sukhumvitLineStations = [
            'คูคต', 'ลำสาลี', 'พหลโยธิน 59', 'สายหยุด', 'พหลโยธิน 24', 'รัชโยธิน', 'เสนานิคม', 'จตุจักร', 'หมอชิต', 
            'สะพานควาย', 'อารีย์', 'สนามเป้า', 'อนุสาวรีย์ชัย', 'พญาไท', 'ราชเทวี', 'สยาม', 'ชิดลม', 'เพลินจิต', 
            'นานา', 'อโศก', 'พร้อมพงษ์', 'ทองหล่อ', 'เอกมัย', 'พระโขนง', 'อ่อนนุช', 'บางจาก', 'ปุณณวิถี', 
            'อุดมสุข', 'บางนา', 'แบริ่ง', 'สำโรง', 'ปู่เจ้า', 'ช้างเอราวัณ', 'โรงเรียนนายเรือ', 'ปากน้ำ', 
            'ศรีนครินทร์', 'แพรกษา', 'สายลวด', 'เคหะฯ'
        ];
        $this->createBtsStations($sukhumvitLineStations, 'สายสุขุมวิท', '#7acb4f');

        // BTS สายสีลม (สีเขียวเข้ม)
        $silomLineStations = [
            'สนามกีฬาแห่งชาติ', 'สยาม', 'ราชดำริ', 'ศาลาแดง', 'ช่องนนทรี', 'สุรศักดิ์', 'สะพานตากสิน', 'กรุงธนบุรี', 
            'วงเวียนใหญ่', 'โพธิ์นิมิตร', 'ตลาดพลู', 'วุฒากาศ', 'บางหว้า'
        ];
        $this->createBtsStations($silomLineStations, 'สายสีลม', '#026c3c');

        // MRT สายสีน้ำเงิน
        $mrtBlueLineStations = [
            'หลักสอง', 'บางแค', 'ภาษีเจริญ', 'บางหว้า', 'เพชรเกษม 48', 'ภาษีเจริญ', 'บางไผ่', 'บางหว้า', 
            'ท่าพระ', 'อิสรภาพ', 'สนามไชย', 'สามยอด', 'วัดมังกร', 'หัวลำโพง', 'สามย่าน', 'สีลม', 'ลุมพินี', 
            'คลองเตย', 'ศูนย์การประชุมแห่งชาติสิริกิติ์', 'สุขุมวิท', 'เพชรบุรี', 'พระราม 9', 'ศูนย์วัฒนธรรมแห่งประเทศไทย', 
            'ห้วยขวาง', 'สุทธิสาร', 'รัชดาภิเษก', 'ลาดพร้าว', 'พหลโยธิน', 'จตุจักร', 'กำแพงเพชร', 'บางซื่อ', 
            'เตาปูน', 'บางโพ', 'บางอ้อ', 'บางพลัด', 'สิรินธร', 'บางยี่ขัน', 'บางขุนนนท์', 'ไฟฉาย', 'จรัญสนิทวงศ์ 13', 
            'ท่าพระ'
        ];
        $this->createBtsStations($mrtBlueLineStations, 'MRT สายสีน้ำเงิน', '#1e3a8a');

        // MRT สายสีม่วง
        $mrtPurpleLineStations = [
            'คลองบางไผ่', 'ตลาดบางใหญ่', 'สามแยกบางใหญ่', 'บางพลู', 'บางรักใหญ่', 'บางรักน้อย-ท่าอิฐ', 
            'ไทรม้า', 'สะพานพระนั่งเกล้า', 'แยกนนทบุรี 1', 'บางกระสอ', 'ศูนย์ราชการนนทบุรี', 'กระทรวงสาธารณสุข', 
            'แยกติวานนท์', 'วงศ์สว่าง', 'บางซ่อน', 'เตาปูน'
        ];
        $this->createBtsStations($mrtPurpleLineStations, 'MRT สายสีม่วง', '#8e24aa');

        // Airport Rail Link
        $airportRailLinkStations = [
            'พญาไท', 'ราชปรารภ', 'มักกะสัน', 'รามคำแหง', 'หัวหมาก', 'บ้านทับช้าง', 'ลาดกระบัง', 'สุวรรณภูมิ'
        ];
        $this->createBtsStations($airportRailLinkStations, 'Airport Rail Link', '#a64b2a');
    }

    /**
     * Create BTS stations for a line.
     */
    private function createBtsStations(array $stations, string $line, string $color)
    {
        foreach ($stations as $name) {
            BtsStation::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'line' => $line,
                'color' => $color,
            ]);
        }
    }
}