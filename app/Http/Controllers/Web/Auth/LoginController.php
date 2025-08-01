<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'auth']);
        // $this->middleware('auth')->only('logout');
    }

    public function showLoginRestaurant()
    {
        return view('auth.loginRestaurant');
    }

    public function showLoginAdmin()
    {
        return view('auth.login');
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin-panel/dashboard');
        }

        return redirect()->back()->with('error', 'Wrong Credentials');
    }

    public function loginRestaurant(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('restaurant')->attempt($credentials)) {
            return redirect()->route('restaurant.dashboard');
        }

        return redirect()->back()->with('error', 'Wrong Credentials');

        // return redirect()->back()->withErrors([
        //     'email' => 'بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.',
        // ])->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('restaurant')->check()) {
            Auth::guard('restaurant')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
