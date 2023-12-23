<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Constructor for LoginController.
     */
    public function __construct(private $validated = null, private $name = "")
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display a listing for User of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Process login for User.
     */
    public function login(Request $request)
    {
        $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'   => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (!$validated->fails()) {
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
                return redirect()->route('home');
            }
            return redirect()->route('login')->with('loginError', 'Email atau Password salah');
        } else {
            return redirect()->route('login')->with('loginError', $validated->getMessageBag());
        }
    }

    /**
     * Process logout for User.
     */
    public function logout(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            \Illuminate\Support\Facades\Auth::logout();
            return redirect()->route('login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('login');
    }
}
