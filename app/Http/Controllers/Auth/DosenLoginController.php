<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use Carbon\Carbon;


class DosenLoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.dosen-login');
    }

    protected function guard()
    {
        return Auth::guard('dosen');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::route('dosen.logins');
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
    
    protected $redirectTo = '/dosen/';
    
    public function __construct()
    {
        $this->middleware('guest:dosen')->except('logout');
    }

    function authenticated(Request $request, $user)
{
    $user->update([
        'last_login_at' => Carbon::now()->toDateTimeString(),
        'last_login_ip' => $request->getClientIp()
    ]);
}
}