<?php

namespace Database\Seeders;

use App\Models\BtsStation;
use Illuminate\Database\Seeder;

class BtsStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // BTS สายสุขุมวิท
        $sukhumvitLineStations = [
            ['name' => 'คูคต', 'slug' => 'khu-khot'],
            ['name' => 'แยก คปอ.', 'slug' => 'yaek-kor-por-aor'],
            ['name' => 'พหลโยธิน 59', 'slug' => 'phahon-yothin-59'],
            ['name' => 'สายหยุด', 'slug' => 'sai-yud'],
            ['name' => 'เสนานิคม', 'slug' => 'sena-nikhom'],
            ['name' => 'รามอินทรา', 'slug' => 'ram-inthra'],
            ['name' => 'มหาวิทยาลัยเกษตรศาสตร์', 'slug' => 'kasetsart-university'],
            ['name' => 'กรมป่าไม้', 'slug' => 'royal-forestry-department'],
            ['name' => 'บางบัว', 'slug' => 'bang-bua'],
            ['name' => 'กรมทหารราบที่ 11', 'slug' => '11th-infantry-regiment'],
            ['name' => 'วัดพระศรีมหาธาตุ', 'slug' => 'wat-phra-sri-mahathat'],
            ['name' => 'พหลโยธิน 24', 'slug' => 'phahon-yothin-24'],
            ['name' => 'ห้าแยกลาดพร้าว', 'slug' => 'ha-yaek-lat-phrao'],
            ['name' => 'รัชโยธิน', 'slug' => 'ratchayothin'],
            ['name' => 'เสนาร่วม', 'slug' => 'sena-ruam'],
            ['name' => 'จตุจักร', 'slug' => 'chatuchak-park'],
            ['name' => 'หมอชิต', 'slug' => 'mo-chit'],
            ['name' => 'สะพานควาย', 'slug' => 'saphan-khwai'],
            ['name' => 'อารีย์', 'slug' => 'ari'],
            ['name' => 'สนามเป้า', 'slug' => 'sanam-pao'],
            ['name' => 'อนุสาวรีย์ชัยสมรภูมิ', 'slug' => 'victory-monument'],
            ['name' => 'พญาไท', 'slug' => 'phaya-thai'],
            ['name' => 'ราชเทวี', 'slug' => 'ratchathewi'],
            ['name' => 'สยาม', 'slug' => 'siam'],
            ['name' => 'ชิดลม', 'slug' => 'chit-lom'],
            ['name' => 'เพลินจิต', 'slug' => 'ploen-chit'],
            ['name' => 'นานา', 'slug' => 'nana'],
            ['name' => 'อโศก', 'slug' => 'asok'],
            ['name' => 'พร้อมพงษ์', 'slug' => 'phrom-phong'],
            ['name' => 'ทองหล่อ', 'slug' => 'thong-lo'],
            ['name' => 'เอกมัย', 'slug' => 'ekkamai'],
            ['name' => 'พระโขนง', 'slug' => 'phra-khanong'],
            ['name' => 'อ่อนนุช', 'slug' => 'on-nut'],
            ['name' => 'บางจาก', 'slug' => 'bang-chak'],
            ['name' => 'ปุณณวิถี', 'slug' => 'punnawithi'],
            ['name' => 'อุดมสุข', 'slug' => 'udom-suk'],
            ['name' => 'บางนา', 'slug' => 'bang-na'],
            ['name' => 'แบริ่ง', 'slug' => 'bearing'],
            ['name' => 'สำโรง', 'slug' => 'samrong'],
            ['name' => 'ปู่เจ้า', 'slug' => 'pu-chao'],
            ['name' => 'ช้างเอราวัณ', 'slug' => 'chang-erawan'],
            ['name' => 'โรงเรียนนายเรือ', 'slug' => 'royal-thai-naval-academy'],
            ['name' => 'ปากน้ำ', 'slug' => 'pak-nam'],
            ['name' => 'ศรีนครินทร์', 'slug' => 'srinagarindra'],
            ['name' => 'แพรกษา', 'slug' => 'phraek-sa'],
            ['name' => 'สายลวด', 'slug' => 'sai-luat'],
            ['name' => 'เคหะฯ', 'slug' => 'kheha']
        ];
        
        foreach ($sukhumvitLineStations as $station) {
            BtsStation::create([
                'name' => $station['name'],
                'slug' => $station['slug'],
                'line' => 'BTS สายสุขุมวิท',
                'color' => '#7FBC43', // สีเขียว
            ]);
        }
        
        // BTS สายสีลม
        $silomLineStations = [
            ['name' => 'สนามกีฬาแห่งชาติ', 'slug' => 'national-stadium'],
            ['name' => 'สยาม', 'slug' => 'siam-silom'],
            ['name' => 'ราชดำริ', 'slug' => 'ratchadamri'],
            ['name' => 'ศาลาแดง', 'slug' => 'sala-daeng'],
            ['name' => 'ช่องนนทรี', 'slug' => 'chong-nonsi'],
            ['name' => 'สุรศักดิ์', 'slug' => 'surasak'],
            ['name' => 'สะพานตากสิน', 'slug' => 'saphan-taksin'],
            ['name' => 'กรุงธนบุรี', 'slug' => 'krung-thon-buri'],
            ['name' => 'วงเวียนใหญ่', 'slug' => 'wongwian-yai'],
            ['name' => 'โพธิ์นิมิตร', 'slug' => 'pho-nimit'],
            ['name' => 'ตลาดพลู', 'slug' => 'talat-phlu'],
            ['name' => 'วุฒากาศ', 'slug' => 'wutthakat'],
            ['name' => 'บางหว้า', 'slug' => 'bang-wa']
        ];
        
        foreach ($silomLineStations as $station) {
            BtsStation::create([
                'name' => $station['name'],
                'slug' => $station['slug'],
                'line' => 'BTS สายสีลม',
                'color' => '#F3991D', // สีทอง
            ]);
        }
        
        // MRT สายสีน้ำเงิน
        $mrtBlueLineStations = [
            ['name' => 'หลักสอง', 'slug' => 'lak-song'],
            ['name' => 'บางแค', 'slug' => 'bang-khae'],
            ['name' => 'ภาษีเจริญ', 'slug' => 'phasi-charoen'],
            ['name' => 'เพชรเกษม 48', 'slug' => 'phetkasem-48'],
            ['name' => 'บางหว้า MRT', 'slug' => 'bang-wa-mrt'],
            ['name' => 'บางไผ่', 'slug' => 'bang-phai'],
            ['name' => 'ท่าพระ', 'slug' => 'tha-phra'],
            ['name' => 'อิสรภาพ', 'slug' => 'itsaraphap'],
            ['name' => 'สนามไชย', 'slug' => 'sanam-chai'],
            ['name' => 'สามยอด', 'slug' => 'sam-yot'],
            ['name' => 'วัดมังกร', 'slug' => 'wat-mangkon'],
            ['name' => 'หัวลำโพง', 'slug' => 'hua-lamphong'],
            ['name' => 'สามย่าน', 'slug' => 'sam-yan'],
            ['name' => 'สีลม', 'slug' => 'si-lom'],
            ['name' => 'ลุมพินี', 'slug' => 'lumphini'],
            ['name' => 'คลองเตย', 'slug' => 'khlong-toei-mrt'],
            ['name' => 'ศูนย์การประชุมแห่งชาติสิริกิติ์', 'slug' => 'queen-sirikit-national-convention-centre'],
            ['name' => 'สุขุมวิท', 'slug' => 'sukhumvit-mrt'],
            ['name' => 'เพชรบุรี', 'slug' => 'phetchaburi'],
            ['name' => 'พระราม 9', 'slug' => 'phra-ram-9'],
            ['name' => 'ศูนย์วัฒนธรรมแห่งประเทศไทย', 'slug' => 'thailand-cultural-centre'],
            ['name' => 'ห้วยขวาง', 'slug' => 'huai-khwang-mrt'],
            ['name' => 'สุทธิสาร', 'slug' => 'sutthisan'],
            ['name' => 'รัชดาภิเษก', 'slug' => 'ratchadaphisek'],
            ['name' => 'ลาดพร้าว', 'slug' => 'lat-phrao-mrt'],
            ['name' => 'พหลโยธิน', 'slug' => 'phahon-yothin-mrt'],
            ['name' => 'สวนจตุจักร', 'slug' => 'chatuchak-park-mrt'],
            ['name' => 'กำแพงเพชร', 'slug' => 'kamphaeng-phet'],
            ['name' => 'บางซื่อ', 'slug' => 'bang-sue-mrt'],
            ['name' => 'เตาปูน', 'slug' => 'tao-poon'],
            ['name' => 'บางโพ', 'slug' => 'bang-pho'],
            ['name' => 'บางอ้อ', 'slug' => 'bang-o'],
            ['name' => 'บางพลัด', 'slug' => 'bang-phlat'],
            ['name' => 'สิรินธร', 'slug' => 'sirindhorn'],
            ['name' => 'บางยี่ขัน', 'slug' => 'bang-yi-khan'],
            ['name' => 'บางขุนนนท์', 'slug' => 'bang-khun-non'],
            ['name' => 'ไฟฉาย', 'slug' => 'fai-chai'],
            ['name' => 'จรัญฯ 13', 'slug' => 'charan-13'],
            ['name' => 'ท่าพระ MRT', 'slug' => 'tha-phra-mrt']
        ];
        
        foreach ($mrtBlueLineStations as $station) {
            BtsStation::create([
                'name' => $station['name'],
                'slug' => $station['slug'],
                'line' => 'MRT สายสีน้ำเงิน',
                'color' => '#1155CB', // สีน้ำเงิน
            ]);
        }
        
        // MRT สายสีม่วง
        $mrtPurpleLineStations = [
            ['name' => 'คลองบางไผ่', 'slug' => 'khlong-bang-phai'],
            ['name' => 'ตลาดบางใหญ่', 'slug' => 'talat-bang-yai'],
            ['name' => 'สามแยกบางใหญ่', 'slug' => 'sam-yaek-bang-yai'],
            ['name' => 'บางพลู', 'slug' => 'bang-phlu'],
            ['name' => 'บางรักใหญ่', 'slug' => 'bang-rak-yai'],
            ['name' => 'บางรักน้อยท่าอิฐ', 'slug' => 'bang-rak-noi-tha-it'],
            ['name' => 'ไทรม้า', 'slug' => 'sai-ma'],
            ['name' => 'สะพานพระนั่งเกล้า', 'slug' => 'saphan-phra-nangklao'],
            ['name' => 'แยกนนทบุรี 1', 'slug' => 'yaek-nonthaburi-1'],
            ['name' => 'บางกระสอ', 'slug' => 'bang-krasor'],
            ['name' => 'ศูนย์ราชการนนทบุรี', 'slug' => 'nonthaburi-civic-center'],
            ['name' => 'กระทรวงสาธารณสุข', 'slug' => 'ministry-of-public-health'],
            ['name' => 'แยกติวานนท์', 'slug' => 'yaek-tiwanon'],
            ['name' => 'วงศ์สว่าง', 'slug' => 'wong-sawang'],
            ['name' => 'บางซ่อน', 'slug' => 'bang-son'],
            ['name' => 'เตาปูน MRT', 'slug' => 'tao-poon-mrt']
        ];
        
        foreach ($mrtPurpleLineStations as $station) {
            BtsStation::create([
                'name' => $station['name'],
                'slug' => $station['slug'],
                'line' => 'MRT สายสีม่วง',
                'color' => '#9B4F96', // สีม่วง
            ]);
        }
        
        // Airport Rail Link
        $airportRailLinkStations = [
            ['name' => 'สุวรรณภูมิ', 'slug' => 'suvarnabhumi'],
            ['name' => 'ลาดกระบัง', 'slug' => 'lat-krabang-arl'],
            ['name' => 'บ้านทับช้าง', 'slug' => 'ban-thap-chang'],
            ['name' => 'หัวหมาก', 'slug' => 'hua-mak'],
            ['name' => 'รามคำแหง', 'slug' => 'ramkhamhaeng'],
            ['name' => 'มักกะสัน', 'slug' => 'makkasan'],
            ['name' => 'ราชปรารภ', 'slug' => 'ratchaprarop'],
            ['name' => 'พญาไท ARL', 'slug' => 'phaya-thai-arl']
        ];
        
        foreach ($airportRailLinkStations as $station) {
            BtsStation::create([
                'name' => $station['name'],
                'slug' => $station['slug'],
                'line' => 'Airport Rail Link',
                'color' => '#EC1C24', // สีแดง
            ]);
        }
    }
}