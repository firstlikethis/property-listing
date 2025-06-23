@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-indigo-500 to-purple-600 py-12 mb-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">ค้นหาที่พักในฝันของคุณ</h1>
            <p class="text-lg md:text-xl mb-8">มีที่พักให้เลือกมากมายในทำเลที่คุณต้องการ</p>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
                    <div class="flex-1">
                        <label for="q" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-1">ค้นหา</label>
                        <input type="text" name="q" id="q" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="ชื่อโครงการ, ทำเล, ...">
                    </div>
                    
                    <div class="w-full md:w-48">
                        <label for="district_id" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-1">อำเภอ/เขต</label>
                        <select name="district_id" id="district_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">ทั้งหมด</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="w-full md:w-48">
                        <label for="type_id" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-1">ประเภทที่พัก</label>
                        <select name="type_id" id="type_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">ทั้งหมด</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-6 rounded-md font-medium transition-colors duration-200">
                            ค้นหา
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 mb-12">
    @if($featured->count() > 0)
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">ที่พักแนะนำ</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featured as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </div>
    @endif
    
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">ประกาศล่าสุด</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latest as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-6 rounded-md font-medium transition-colors duration-200">
                ดูทั้งหมด
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection