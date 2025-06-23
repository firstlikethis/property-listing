<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check.admin');
    }

    /**
     * Display the settings page.
     */
    public function index()
    {
        // อ่านการตั้งค่าจากไฟล์ settings.json
        $settings = $this->getSettings();
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string',
            'post_expiry_days' => 'required|integer|min:1',
            'featured_price' => 'required|numeric|min:0',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'default_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'auto_delete_expired' => 'boolean',
            'auto_approve_posts' => 'boolean',
            'allow_registration' => 'boolean',
            'google_maps_api_key' => 'nullable|string',
        ]);

        // รับการตั้งค่าปัจจุบัน
        $settings = $this->getSettings();
        
        // อัปเดตการตั้งค่า
        $settings['site_name'] = $request->site_name;
        $settings['site_description'] = $request->site_description;
        $settings['contact_email'] = $request->contact_email;
        $settings['contact_phone'] = $request->contact_phone;
        $settings['contact_address'] = $request->contact_address;
        $settings['post_expiry_days'] = (int) $request->post_expiry_days;
        $settings['featured_price'] = (float) $request->featured_price;
        $settings['auto_delete_expired'] = $request->has('auto_delete_expired');
        $settings['auto_approve_posts'] = $request->has('auto_approve_posts');
        $settings['allow_registration'] = $request->has('allow_registration');
        $settings['google_maps_api_key'] = $request->google_maps_api_key;

        // อัปโหลดโลโก้
        if ($request->hasFile('logo')) {
            // ลบไฟล์เก่า (ถ้ามี)
            if (isset($settings['logo']) && $settings['logo']) {
                Storage::delete('public/' . $settings['logo']);
            }
            
            $path = $request->file('logo')->store('public/images/settings');
            $settings['logo'] = str_replace('public/', '', $path);
        }

        // อัปโหลด favicon
        if ($request->hasFile('favicon')) {
            // ลบไฟล์เก่า (ถ้ามี)
            if (isset($settings['favicon']) && $settings['favicon']) {
                Storage::delete('public/' . $settings['favicon']);
            }
            
            $path = $request->file('favicon')->store('public/images/settings');
            $settings['favicon'] = str_replace('public/', '', $path);
        }

        // อัปโหลดรูปตัวอย่างเริ่มต้น
        if ($request->hasFile('default_thumbnail')) {
            // ลบไฟล์เก่า (ถ้ามี)
            if (isset($settings['default_thumbnail']) && $settings['default_thumbnail']) {
                Storage::delete('public/' . $settings['default_thumbnail']);
            }
            
            $path = $request->file('default_thumbnail')->store('public/images/settings');
            $settings['default_thumbnail'] = str_replace('public/', '', $path);
        }

        // บันทึกการตั้งค่า
        $this->saveSettings($settings);
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'การตั้งค่าถูกบันทึกเรียบร้อยแล้ว');
    }

    /**
     * Get the settings from the settings.json file.
     */
    private function getSettings()
    {
        $path = storage_path('app/settings.json');
        
        if (!file_exists($path)) {
            // สร้างการตั้งค่าเริ่มต้น
            $defaultSettings = [
                'site_name' => 'ระบบประกาศที่พัก/คอนโด',
                'site_description' => 'ค้นหาที่พักและคอนโดได้ง่ายๆ',
                'contact_email' => 'contact@example.com',
                'contact_phone' => '',
                'contact_address' => '',
                'post_expiry_days' => 30,
                'featured_price' => 0,
                'auto_delete_expired' => false,
                'auto_approve_posts' => true,
                'allow_registration' => true,
                'google_maps_api_key' => '',
                'logo' => '',
                'favicon' => '',
                'default_thumbnail' => '',
            ];
            
            file_put_contents($path, json_encode($defaultSettings, JSON_PRETTY_PRINT));
            
            return $defaultSettings;
        }
        
        return json_decode(file_get_contents($path), true);
    }

    /**
     * Save the settings to the settings.json file.
     */
    private function saveSettings($settings)
    {
        $path = storage_path('app/settings.json');
        file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
    }
}