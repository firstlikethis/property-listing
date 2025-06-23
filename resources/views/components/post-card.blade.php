@props(['post'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg border border-gray-200 dark:border-gray-700">
    <div class="relative h-52 overflow-hidden">
        @if($post->primaryImage)
            <img class="w-full h-full object-cover" src="{{ Storage::url($post->primaryImage->path) }}" alt="{{ $post->title }}">
        @else
            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        
        @if($post->is_featured)
            <div class="absolute top-0 right-0 bg-yellow-500 text-white px-2 py-1 text-xs font-bold">
                แนะนำ
            </div>
        @endif
        
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
            <span class="text-white text-lg font-semibold">{{ number_format($post->price) }} บาท<span class="text-sm">{{ $post->price_unit === 'month' ? '/เดือน' : ($post->price_unit === 'day' ? '/วัน' : '/คืน') }}</span></span>
        </div>
    </div>
    
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">{{ $post->title }}</h3>
        
        <div class="mt-2 flex items-center text-sm text-gray-600 dark:text-gray-300">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="truncate">{{ $post->district->name }}{{ $post->btsStation ? ', ใกล้ ' . $post->btsStation->name : '' }}</span>
        </div>
        
        <div class="mt-2 flex justify-between text-sm text-gray-600 dark:text-gray-300">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>{{ $post->type->name }}</span>
            </div>
            
            <div class="flex space-x-2">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                    </svg>
                    <span>{{ $post->bedrooms }} ห้องนอน</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $post->bathrooms }} ห้องน้ำ</span>
                </div>
                
                @if($post->size)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                    </svg>
                    <span>{{ $post->size }} ตร.ม.</span>
                </div>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('posts.show', $post->slug) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition-colors duration-200">
                ดูรายละเอียด
            </a>
        </div>
    </div>
</div>