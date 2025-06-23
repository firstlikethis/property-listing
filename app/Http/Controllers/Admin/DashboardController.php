<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Show the admin dashboard.
     */
    public function index()
    {
        // จำนวนโพสต์ทั้งหมด
        $totalPosts = Post::count();
        
        // จำนวนโพสต์ที่เป็น featured
        $featuredPosts = Post::featured()->count();
        
        // จำนวนผู้ใช้ทั้งหมด แยกตาม role
        $users = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'owner' => User::where('role', 'owner')->count(),
            'user' => User::where('role', 'user')->count(),
        ];
        
        // โพสต์ล่าสุด 10 รายการ
        $recentPosts = Post::with(['user', 'district', 'type'])
            ->latest()
            ->take(10)
            ->get();
            
        // ผู้ใช้ล่าสุด 10 ราย
        $recentUsers = User::latest()
            ->take(10)
            ->get();
            
        // โพสต์ที่จะหมดอายุภายใน 7 วัน
        $expiringPosts = Post::with(['user', 'district', 'type'])
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays(7)])
            ->get();
            
        return view('admin.dashboard.index', compact(
            'totalPosts',
            'featuredPosts',
            'users',
            'recentPosts',
            'recentUsers',
            'expiringPosts'
        ));
    }
}