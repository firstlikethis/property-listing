<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // สร้าง Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123456'),
            'role' => 'admin',
        ]);

        // สร้าง Owner ตัวอย่าง
        User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('owner123456'),
            'phone' => '0812345678',
            'role' => 'owner',
        ]);

        // สร้าง User ทั่วไปตัวอย่าง
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user123456'),
            'role' => 'user',
        ]);
    }
}