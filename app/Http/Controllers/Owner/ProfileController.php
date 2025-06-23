<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check.owner');
    }

    /**
     * Show the owner's profile.
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('owner.profile.index', compact('user'));
    }

    /**
     * Update the owner's profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        
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
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // ตรวจสอบรหัสผ่านปัจจุบัน
        if ($request->filled('current_password') && !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง'])
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // อัปเดตรหัสผ่านเฉพาะเมื่อมีการระบุ
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('owner.profile.index')
            ->with('success', 'โปรไฟล์ถูกอัปเดตเรียบร้อยแล้ว');
    }
}