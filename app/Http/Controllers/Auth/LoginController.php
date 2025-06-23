<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // ตรวจสอบว่าผู้ใช้เป็น admin หรือไม่ ถ้าใช่ให้ logout และแจ้งให้ใช้หน้า admin login
            if (Auth::user()->role === 'admin') {
                Auth::logout();
                return redirect()->route('login')
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['email' => 'Admin กรุณาเข้าสู่ระบบผ่านหน้า Admin Login']);
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
    
    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectTo()
    {
        // ถ้าเป็น owner ให้ redirect ไปที่หน้า owner dashboard
        if (Auth::user()->role === 'owner') {
            return route('owner.dashboard');
        }
        
        // ถ้าเป็น user ธรรมดา ให้ redirect ไปที่หน้าแรก
        return $this->redirectTo;
    }
}