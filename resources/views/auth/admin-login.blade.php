@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="bg-red-600 dark:bg-red-700 px-6 py-4">
            <h1 class="text-white text-lg font-semibold">เข้าสู่ระบบสำหรับผู้ดูแลระบบ</h1>
        </div>
        
        <div class="p-6">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">อีเมลผู้ดูแลระบบ</label>
                    <input id="email" type="email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">รหัสผ่าน</label>
                    <input id="password" type="password" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">จดจำฉัน</label>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        เข้าสู่ระบบผู้ดูแล
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <a href="{{ route('login') }}" class="text-red-600 dark:text-red-400 hover:text-red-800">กลับไปหน้าเข้าสู่ระบบผู้ใช้ทั่วไป</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection