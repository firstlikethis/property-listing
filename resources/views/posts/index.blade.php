@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">ประกาศทั้งหมด</h1>
        <p class="text-gray-600 dark:text-gray-400">ค้นหาที่พักที่ตรงกับความต้องการของคุณ</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-1">
            <x-search-form :districts="$districts" :btsStations="$btsStations" :types="$types" :facilities="$facilities" />
        </div>
        
        <div class="lg:col-span-3">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6">
                <div class="flex justify-between items-center">
                    <p class="text-gray-600 dark:text-gray-400">แสดง {{ $posts->firstItem() ?? 0 }} - {{ $posts->lastItem() ?? 0 }} จาก {{ $posts->total() ?? 0 }} รายการ</p>
                    
                    <div class="flex items-center">
                        <label for="sort" class="mr-2 text-gray-700 dark:text-gray-300 text-sm">เรียงตาม:</label>
                        <select id="sort" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" onchange="window.location.href=this.options[this.selectedIndex].value">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>ใหม่ล่าสุด</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>ราคาน้อยไปมาก</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>ราคามากไปน้อย</option>
                        </select>
                    </div>
                </div>
            </div>
            
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
                    @foreach($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
                
                <div>
                    {{ $posts->withQueryString()->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">ไม่พบประกาศที่คุณค้นหา</h3>
                    <p class="text-gray-500 dark:text-gray-400">ลองปรับการค้นหาใหม่หรือลองใช้ตัวกรองอื่น</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection