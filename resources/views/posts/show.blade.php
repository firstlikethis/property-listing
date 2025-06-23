@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        หน้าแรก
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('posts.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">ประกาศทั้งหมด</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 truncate max-w-xs">{{ $post->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $post->title }}</h1>
                    
                    <div class="flex flex-wrap items-center text-gray-600 dark:text-gray-400 mb-4">
                        <div class="flex items-center mr-4 mb-2">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $post->district->name }}</span>
                        </div>
                        
                        <div class="flex items-center mr-4 mb-2">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>{{ $post->type->name }}</span>
                        </div>
                        
                        @if($post->btsStation)
                        <div class="flex items-center mr-4 mb-2">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                            <span>ใกล้ {{ $post->btsStation->name }}</span>
                        </div>
                        @endif
                        
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $post->created_at->locale('th')->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        @if($post->images->count() > 0)
                            <div x-data="imageSlider()" class="relative">
                                <div class="relative h-96 overflow-hidden rounded-lg">
                                    @foreach($post->images as $index => $image)
                                    <div x-show="activeSlide === {{ $index }}" x-transition class="absolute inset-0 w-full h-full">
                                        <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="absolute inset-0 flex items-center justify-between p-2">
                                    <button @click="prev()" class="p-2 rounded-full bg-gray-800/50 text-white hover:bg-gray-800/70 focus:outline-none">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button @click="next()" class="p-2 rounded-full bg-gray-800/50 text-white hover:bg-gray-800/70 focus:outline-none">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="absolute bottom-4 left-0 right-0">
                                    <div class="flex items-center justify-center space-x-2">
                                        @foreach($post->images as $index => $image)
                                        <button @click="activeSlide = {{ $index }}" :class="{'bg-white': activeSlide === {{ $index }}, 'bg-gray-300': activeSlide !== {{ $index }}}" class="w-2 h-2 rounded-full"></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 grid grid-cols-6 gap-2">
                                @foreach($post->images as $index => $image)
                                <div x-data="{ activeSlide: 0 }" @click="$dispatch('setSlide', {{ $index }})" class="cursor-pointer rounded overflow-hidden aspect-square border-2" :class="activeSlide === {{ $index }} ? 'border-indigo-500' : 'border-transparent'">
                                    <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">รายละเอียด</h2>
                        <div class="prose prose-indigo dark:prose-invert max-w-none">
                            {!! nl2br(e($post->description)) !!}
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">ข้อมูลทั่วไป</h2>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">ประเภท</div>
                                <div class="font-medium text-gray-800 dark:text-white">{{ $post->type->name }}</div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">ห้องนอน</div>
                                <div class="font-medium text-gray-800 dark:text-white">{{ $post->bedrooms }} ห้อง</div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">ห้องน้ำ</div>
                                <div class="font-medium text-gray-800 dark:text-white">{{ $post->bathrooms }} ห้อง</div>
                            </div>
                            
                            @if($post->size)
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">ขนาด</div>
                                <div class="font-medium text-gray-800 dark:text-white">{{ $post->size }} ตร.ม.</div>
                            </div>
                            @endif
                            
                            @if($post->floor)
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">ชั้น</div>
                                <div class="font-medium text-gray-800 dark:text-white">{{ $post->floor }}</div>
                            </div>
                            @endif
                            
                            @if($post->building)
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">อาคาร/ตึก</div>
                                <div class="font-medium text-gray-800 dark:text-white">{{ $post->building }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($post->facilities->count() > 0)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">สิ่งอำนวยความสะดวก</h2>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($post->facilities as $facility)
                            <div class="flex items-center">
                                @if($facility->icon)
                                <i class="{{ $facility->icon }} text-indigo-600 mr-2"></i>
                                @else
                                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                @endif
                                <span class="text-gray-700 dark:text-gray-300">{{ $facility->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($post->address || ($post->latitude && $post->longitude))
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">ที่ตั้ง</h2>
                        
                        @if($post->address)
                        <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $post->address }}</p>
                        @endif
                        
                        @if($post->latitude && $post->longitude)
                        <div class="h-80 bg-gray-200 dark:bg-gray-700 rounded-lg mb-2">
                            <div id="map" class="h-full w-full rounded-lg"></div>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">*ตำแหน่งที่ตั้งโดยประมาณ</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            
            @if($similar->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">ประกาศที่ใกล้เคียง</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($similar as $similarPost)
                    <a href="{{ route('posts.show', $similarPost->slug) }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex-shrink-0 w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded overflow-hidden">
                            @if($similarPost->primaryImage)
                                <img src="{{ Storage::url($similarPost->primaryImage->path) }}" class="w-full h-full object-cover" alt="{{ $similarPost->title }}">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $similarPost->title }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $similarPost->district->name }}</p>
                            <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ number_format($similarPost->price) }} บาท{{ $similarPost->price_unit === 'month' ? '/เดือน' : ($similarPost->price_unit === 'day' ? '/วัน' : '/คืน') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden sticky top-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ number_format($post->price) }} บาท<span class="text-base font-normal">{{ $post->price_unit === 'month' ? '/เดือน' : ($post->price_unit === 'day' ? '/วัน' : '/คืน') }}</span></h2>
                        
                        @if($post->is_featured)
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">แนะนำ</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center mb-4">
                        <img class="w-10 h-10 rounded-full mr-4" src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random" alt="{{ $post->user->name }}">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">เจ้าของประกาศ</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">ข้อมูลติดต่อ</h3>
                    
                    <div class="space-y-3">
                        @if($post->contact_phone)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">{{ $post->contact_phone }}</span>
                        </div>
                        @endif
                        
                        @if($post->contact_line)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 10.6C22 5.8 17.5 2 12 2C6.5 2 2 5.8 2 10.6C2 14.9 5.4 18.5 10 19.3C10.2 19.4 10.5 19.5 10.6 19.7C10.7 19.9 10.7 20.1 10.6 20.4C10.6 20.4 10.3 21.4 10.3 21.5C10.3 21.7 10.2 22 10.4 22.1C10.6 22.2 10.8 22.1 11 22C11.7 21.7 14.4 19.8 15.5 18.8C18.3 16.7 20 13.8 20 10.6H22Z"/>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">{{ $post->contact_line }}</span>
                        </div>
                        @endif
                        
                        @if($post->contact_email)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">{{ $post->contact_email }}</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        @if($post->contact_phone)
                        <a href="tel:{{ $post->contact_phone }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded text-center transition-colors duration-200">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                โทรหาผู้ลงประกาศ
                            </div>
                        </a>
                        @endif
                        
                        @if($post->contact_line)
                        <a href="https://line.me/ti/p/~{{ $post->contact_line }}" target="_blank" class="block w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded text-center transition-colors duration-200">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 10.6C22 5.8 17.5 2 12 2C6.5 2 2 5.8 2 10.6C2 14.9 5.4 18.5 10 19.3C10.2 19.4 10.5 19.5 10.6 19.7C10.7 19.9 10.7 20.1 10.6 20.4C10.6 20.4 10.3 21.4 10.3 21.5C10.3 21.7 10.2 22 10.4 22.1C10.6 22.2 10.8 22.1 11 22C11.7 21.7 14.4 19.8 15.5 18.8C18.3 16.7 20 13.8 20 10.6H22Z"/>
                                </svg>
                                ติดต่อทาง LINE
                            </div>
                        </a>
                        @endif
                        
                        @if($post->contact_email)
                        <a href="mailto:{{ $post->contact_email }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded text-center transition-colors duration-200">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                ส่งอีเมล
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($post->latitude && $post->longitude)
<script>
    function initMap() {
        const mapOptions = {
            center: { lat: {{ $post->latitude }}, lng: {{ $post->longitude }} },
            zoom: 15,
        };
        
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);
        
        new google.maps.Marker({
            position: { lat: {{ $post->latitude }}, lng: {{ $post->longitude }} },
            map: map,
            title: '{{ $post->title }}'
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key', '') }}&callback=initMap" async defer></script>
@endif

<script>
    function imageSlider() {
        return {
            activeSlide: 0,
            totalSlides: {{ $post->images->count() }},
            next() {
                this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
            },
            prev() {
                this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
            },
            init() {
                window.addEventListener('setSlide', (event) => {
                    this.activeSlide = event.detail;
                });
            }
        };
    }
</script>
@endsection