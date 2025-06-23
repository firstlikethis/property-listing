<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // กรองตาม role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // ค้นหาตาม keyword
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhere('phone', 'like', "%{$keyword}%");
            });
        }

        // จัดเรียง
        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,owner,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'ผู้ใช้ถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // โหลดโพสต์ของผู้ใช้
        $posts = $user->posts()
            ->with(['district', 'type'])
            ->latest()
            ->paginate(10);
            
        return view('admin.users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,owner,admin',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ];

        // อัปเดตรหัสผ่านเฉพาะเมื่อมีการระบุ
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'ผู้ใช้ถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // ตรวจสอบว่าไม่ใช่ผู้ใช้ปัจจุบัน
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'คุณไม่สามารถลบบัญชีตัวเองได้');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'ผู้ใช้ถูกลบเรียบร้อยแล้ว');
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(User $user)
    {
        // สร้างรหัสผ่านแบบสุ่ม
        $password = Str::random(10);
        
        $user->update([
            'password' => Hash::make($password),
        ]);

        // ส่งอีเมลรหัสผ่านใหม่ (ในตัวอย่างนี้เราแสดงผลในหน้าเว็บ)
        return redirect()->route('admin.users.show', $user)
            ->with('success', "รหัสผ่านถูกรีเซ็ตเรียบร้อยแล้ว รหัสผ่านใหม่คือ: {$password}");
    }
}