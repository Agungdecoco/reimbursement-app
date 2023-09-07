<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    // public function username()
    // {
    //     return 'nip';
    // }

    public function authenticated(\Illuminate\Http\Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->jabatan === 'DIREKTUR') {
                $user = auth()->user()->nama;
                return redirect()->route('director.home')->with('success', ('Selamat datang ' . $user . '!'));
            } else if (auth()->user()->jabatan === 'FINANCE') {
                $user = auth()->user()->nama;
                return redirect()->route('finance.home')->with('success', ('Selamat datang ' . $user . '!'));
            } else if (auth()->user()->jabatan === 'STAFF') {
                $user = auth()->user()->nama;
                return redirect()->route('staff.home')->with('success', ('Selamat datang ' . $user . '!'));
            }
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
