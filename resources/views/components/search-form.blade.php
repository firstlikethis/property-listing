<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 md:p-6 mb-6">
    <form action="{{ route('search') }}" method="GET">
        <div class="mb-4">
            <label for="q" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">คำค้นหา</label>
            <input type="text" name="q" id="q" value="{{ request('q') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="ชื่อโครงการ, คำอธิบาย, ที่อยู่...">
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="district_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">อำเภอ/เขต</label>
                <select name="district_id" id="district_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">ทั้งหมด</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="bts_station_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">สถานีรถไฟฟ้า</label>
                <select name="bts_station_id" id="bts_station_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">ทั้งหมด</option>
                    @foreach($btsStations as $station)
                        <option value="{{ $station->id }}" {{ request('bts_station_id') == $station->id ? 'selected' : '' }}>{{ $station->name }} ({{ $station->line }})</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ประเภทที่พัก</label>
                <select name="type_id" id="type_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">ทั้งหมด</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ราคา</label>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="ต่ำสุด">
                    </div>
                    <div>
                        <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="สูงสุด">
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">จำนวนห้อง</label>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="bedrooms" class="block text-xs text-gray-500 dark:text-gray-400">ห้องนอน</label>
                        <select name="bedrooms" id="bedrooms" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">ทั้งหมด</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}+</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="bathrooms" class="block text-xs text-gray-500 dark:text-gray-400">ห้องน้ำ</label>
                        <select name="bathrooms" id="bathrooms" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">ทั้งหมด</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}+</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">สิ่งอำนวยความสะดวก</label>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                @foreach($facilities as $facility)
                    <div class="flex items-center">
                        <input type="checkbox" name="facilities[]" id="facility_{{ $facility->id }}" value="{{ $facility->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ in_array($facility->id, request('facilities', [])) ? 'checked' : '' }}>
                        <label for="facility_{{ $facility->id }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300">เรียงตาม</label>
                <select name="sort" id="sort" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>ใหม่ล่าสุด</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>ราคาน้อยไปมาก</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>ราคามากไปน้อย</option>
                </select>
            </div>
            
            <div class="flex space-x-2">
                <a href="{{ route('search') }}" class="py-2 px-4 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md text-sm font-medium transition-colors duration-200">
                    รีเซ็ต
                </a>
                <button type="submit" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium transition-colors duration-200">
                    ค้นหา
                </button>
            </div>
        </div>
    </form>
</div>