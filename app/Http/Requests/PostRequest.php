<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // เจ้าของประกาศหรือผู้ดูแลระบบเท่านั้น
        return auth()->check() && (auth()->user()->isOwner() || auth()->user()->isAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_unit' => 'required|in:month,day,night',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'size' => 'nullable|numeric|min:0',
            'floor' => 'nullable|string|max:50',
            'building' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_line' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'type_id' => 'required|exists:types,id',
            'district_id' => 'required|exists:districts,id',
            'bts_station_id' => 'nullable|exists:bts_stations,id',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ];

        // กรณีแอดมิน
        if (auth()->user()->isAdmin()) {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['is_published'] = 'boolean';
            $rules['is_featured'] = 'boolean';
            $rules['expires_at'] = 'nullable|date';
        }

        // กรณีสร้างโพสต์ใหม่
        if ($this->isMethod('post')) {
            $rules['images'] = 'required|array|min:1';
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        } 
        // กรณีแก้ไขโพสต์
        else if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['new_images'] = 'nullable|array';
            $rules['new_images.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['delete_images'] = 'nullable|array';
            $rules['delete_images.*'] = 'exists:images,id';
            $rules['primary_image'] = 'nullable|exists:images,id';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'กรุณาระบุชื่อประกาศ',
            'description.required' => 'กรุณาระบุรายละเอียด',
            'price.required' => 'กรุณาระบุราคา',
            'price.numeric' => 'ราคาต้องเป็นตัวเลขเท่านั้น',
            'price.min' => 'ราคาต้องมีค่ามากกว่าหรือเท่ากับ 0',
            'price_unit.required' => 'กรุณาระบุหน่วยราคา',
            'bedrooms.required' => 'กรุณาระบุจำนวนห้องนอน',
            'bathrooms.required' => 'กรุณาระบุจำนวนห้องน้ำ',
            'type_id.required' => 'กรุณาเลือกประเภทที่พัก',
            'district_id.required' => 'กรุณาเลือกอำเภอ/เขต',
            'images.required' => 'กรุณาอัปโหลดรูปภาพอย่างน้อย 1 รูป',
            'images.min' => 'กรุณาอัปโหลดรูปภาพอย่างน้อย 1 รูป',
            'images.*.image' => 'ไฟล์ต้องเป็นรูปภาพเท่านั้น',
            'images.*.mimes' => 'รูปภาพต้องเป็นไฟล์ประเภท jpeg, png, jpg หรือ gif เท่านั้น',
            'images.*.max' => 'รูปภาพต้องมีขนาดไม่เกิน 2MB',
        ];
    }
}