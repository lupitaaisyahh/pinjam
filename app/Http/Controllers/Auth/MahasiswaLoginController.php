<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Session;
use Carbon\Carbon;
use App\Model\User\Mahasiswa as Mahasiswa;


class MahasiswaLoginController extends Controller
{
    

    public function showSignUpForm()
    {
        return view('auth.mahasiswa-signup');
    }

    public function showLoginForm()
    {
        return view('auth.mahasiswa-login');
    }

    public function signups(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswa',
            'password' => 'required',
        ],
        [   
            'nama.required' => 'Masukkan Nama.',
            'nim.required' => 'Masukkan NIM.',
            'nim.unique' => 'NIM Sudah Terdaftar.',
            'password.required' => 'Masukkan Password.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = New Mahasiswa;
            $objek->nama = $req->nama;
            $objek->nim = $req->nim;
            $objek->username = $req->nim;
            $objek->status = 0;
            $objek->password = Hash::make($req->password);
            $objek->save();

            return redirect()->route('mahasiswa.login')->with('pesan', 'Data Berhasil Di Tambahkan!');
        }
    }

    protected function guard()
    {
        return Auth::guard('mahasiswa');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::route('mahasiswa.logins');
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
    
    protected $redirectTo = '/mahasiswa';
    
    public function __construct()
    {
        $this->middleware('guest:mahasiswa')->except('logout');
    }

    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
}