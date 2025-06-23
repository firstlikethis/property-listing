@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">ลงประกาศใหม่</h1>
        <p class="text-gray-600 dark:text-gray-400">กรอกข้อมูลให้ครบถ้วนเพื่อลงประกาศที่พักของคุณ</p>
    </div>
    
    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <p class="font-bold">เกิดข้อผิดพลาด</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('owner.posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        @csrf
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">ข้อมูลทั่วไป</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ชื่อประกาศ <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ประเภทที่พัก <span class="text-red-500">*</span></label>
                    <select name="type_id" id="type_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="">เลือกประเภทที่พัก</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="district_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">อำเภอ/เขต <span class="text-red-500">*</span></label>
                    <select name="district_id" id="district_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="">เลือกอำเภอ/เขต</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name }}{{ $district->zone ? ' ('.$district->zone->name.')' : '' }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="bts_station_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">สถานีรถไฟฟ้าใกล้เคียง</label>
                    <select name="bts_station_id" id="bts_station_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">ไม่มี</option>
                        @foreach($btsStations as $station)
                            <option value="{{ $station->id }}" {{ old('bts_station_id') == $station->id ? 'selected' : '' }}>{{ $station->name }} ({{ $station->line }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="lg:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">รายละเอียด <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="6" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('description') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">รายละเอียดเกี่ยวกับที่พัก สภาพแวดล้อม สิ่งอำนวยความสะดวก ฯลฯ</p>
                </div>
            </div>
        </div>
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">ข้อมูลที่พัก</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ราคา <span class="text-red-500">*</span></label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="number" name="price" id="price" value="{{ old('price') }}" class="flex-grow rounded-l-md border-r-0 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-sm">
                            บาท
                        </span>
                    </div>
                </div>
                
                <div>
                    <label for="price_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">หน่วย <span class="text-red-500">*</span></label>
                    <select name="price_unit" id="price_unit" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="month" {{ old('price_unit') == 'month' ? 'selected' : '' }}>ต่อเดือน</option>
                        <option value="day" {{ old('price_unit') == 'day' ? 'selected' : '' }}>ต่อวัน</option>
                        <option value="night" {{ old('price_unit') == 'night' ? 'selected' : '' }}>ต่อคืน</option>
                    </select>
                </div>
                
                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">จำนวนห้องนอน <span class="text-red-500">*</span></label>
                    <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms', 1) }}" min="0" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">จำนวนห้องน้ำ <span class="text-red-500">*</span></label>
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', 1) }}" min="0" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ขนาด (ตร.ม.)</label>
                    <input type="number" name="size" id="size" value="{{ old('size') }}" min="0" step="0.01" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                
                <div>
                    <label for="floor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ชั้นที่</label>
                    <input type="text" name="floor" id="floor" value="{{ old('floor') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                
                <div>
                    <label for="building" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">อาคาร/ตึก</label>
                    <input type="text" name="building" id="building" value="{{ old('building') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">สิ่งอำนวยความสะดวก</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($facilities as $facility)
                    <div class="flex items-center">
                        <input type="checkbox" name="facilities[]" id="facility_{{ $facility->id }}" value="{{ $facility->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ in_array($facility->id, old('facilities', [])) ? 'checked' : '' }}>
                        <label for="facility_{{ $facility->id }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">ที่ตั้ง</h2>
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ที่อยู่</label>
                    <textarea name="address" id="address" rows="2" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('address') }}</textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ละติจูด (Latitude)</label>
                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ลองจิจูด (Longitude)</label>
                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">รูปภาพ <span class="text-red-500">*</span></h2>
            
            <div class="mb-4">
                <div
                    x-data="{ files: null }"
                    class="bg-gray-100 dark:bg-gray-900 p-6 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700"
                >
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="mt-2">
                            <label for="images" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span class="px-4 py-2">อัปโหลดรูปภาพ</span>
                                <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*" x-on:change="files = Object.values($event.target.files)">
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            PNG, JPG, GIF สูงสุด 5 MB
                        </p>
                    </div>
                    
                    <div class="mt-4">
                        <template x-if="files !== null">
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">รูปภาพที่เลือก (<span x-text="files.length"></span>)</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <template x-for="(file, index) in files" :key="index">
                                        <div class="relative aspect-square bg-gray-200 dark:bg-gray-700 rounded overflow-hidden">
                                            <img :src="URL.createObjectURL(file)" class="w-full h-full object-cover">
                                            <div class="absolute top-2 right-2 bg-white dark:bg-gray-800 rounded-full p-1 shadow">
                                                <button type="button" x-on:click="files = files.filter((_, i) => i !== index)" class="text-red-500 hover:text-red-700">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">รูปแรกจะถูกใช้เป็นรูปหลักของประกาศ</p>
            </div>
        </div>
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">ข้อมูลติดต่อ</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ชื่อผู้ติดต่อ</label>
                    <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', auth()->user()->name) }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">เบอร์โทรศัพท์</label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', auth()->user()->phone) }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                
                <div>
                    <label for="contact_line" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Line ID</label>
                    <input type="text" name="contact_line" id="contact_line" value="{{ old('contact_line') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">อีเมล</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', auth()->user()->email) }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>
        
        <div class="p-6 flex justify-end">
            <a href="{{ route('owner.posts.index') }}" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-md mr-4">
                ยกเลิก
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">
                ลงประกาศ
            </button>
        </div>
    </form>
</div>
@endsection