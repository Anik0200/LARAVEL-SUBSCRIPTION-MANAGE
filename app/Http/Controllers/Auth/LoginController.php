<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = '/';

    public function login(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required',
                'password' => 'required',
            ],
            [
                'email'    => 'Email Is Required',
                'password' => 'Password Is Required',
            ]
        );

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard.index')->with('success', 'You Are loged In!');
        } else {
            return back()->with('error', 'Invalid Credential!');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
