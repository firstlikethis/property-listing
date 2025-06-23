property-listing/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                      # Controller สำหรับหลังบ้าน
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── PostController.php      
│   │   │   │   ├── UserController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── Owner/                      # Controller สำหรับเจ้าของประกาศ
│   │   │   │   ├── PostController.php
│   │   │   │   └── ProfileController.php
│   │   │   ├── HomeController.php          # หน้าแรก
│   │   │   ├── PostController.php          # แสดงประกาศ (สำหรับผู้ใช้ทั่วไป)
│   │   │   └── SearchController.php        # ระบบค้นหา
│   │   ├── Middleware/
│   │   │   ├── CheckOwner.php              # ตรวจสอบสิทธิ์ Owner
│   │   │   └── CheckAdmin.php              # ตรวจสอบสิทธิ์ Admin
│   │   └── Requests/                       # Form Validation
│   │       ├── PostRequest.php
│   │       └── ...
│   ├── Models/
│   │   ├── User.php
│   │   ├── Post.php
│   │   ├── Type.php                        # ประเภทที่พัก
│   │   ├── District.php                    # อำเภอ
│   │   ├── BtsStation.php                  # สถานีรถไฟฟ้า
│   │   ├── Facility.php                    # สิ่งอำนวยความสะดวก
│   │   ├── Zone.php                        # โซน (optional)
│   │   └── Image.php                       # รูปภาพ
│   └── Services/
│       └── ImageService.php                # จัดการอัปโหลดรูปภาพ
├── database/
│   ├── migrations/                         # ไฟล์สร้างโครงสร้างฐานข้อมูล
│   ├── seeders/                            # ข้อมูลตั้งต้น
│   └── factories/                          # สร้างข้อมูลจำลอง
├── resources/
│   ├── views/
│   │   ├── layouts/                        # Layout หลัก
│   │   ├── components/                     # Component Blade
│   │   ├── home/                           # หน้าแรก
│   │   ├── posts/                          # แสดงประกาศ
│   │   ├── search/                         # หน้าค้นหา
│   │   ├── owner/                          # ส่วน Owner
│   │   │   ├── posts/
│   │   │   └── profile/
│   │   └── admin/                          # ส่วน Admin
│   │       ├── dashboard/
│   │       ├── posts/
│   │       ├── users/
│   │       ├── categories/
│   │       └── settings/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php                             # Route หลัก
│   ├── admin.php                           # Route สำหรับ Admin
│   └── owner.php                           # Route สำหรับ Owner
└── public/
    └── storage/                            # Symbolic link ไปยัง storage
        └── images/                         # รูปภาพประกาศ