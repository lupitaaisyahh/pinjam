<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class AdminLoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::route('admin.logins');
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
    
    use AuthenticatesUsers;
    
    protected $redirectTo = '/admin';
    
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}