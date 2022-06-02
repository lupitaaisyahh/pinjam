<?php

namespace App\Http\Controllers\Admin\Kelolauser;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Hash;

use App\Model\User\Admin as Admin;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index($id)
    {
        $admin = Admin::find($id);
        return view('admin.kelolauser.admin.index', compact(['admin']));
    }

    public function ubah(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',

        ],
        [   
            'id.required' => 'Masukkan ID.',
            'nama.required' => 'Masukkan Nama.',
            'username.required' => 'Masukkan Username.',
            'email.required' => 'Masukkan E-Mail.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $objek = Admin::find(Auth::user()->id);
            $objek->nama = $req->nama;
            $objek->username = $req->username;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            if (isset($req->password)) {
                $objek->password = Hash::make($req->password);
            }
            $objek->save();
            return redirect()->route('admin.kelolauser.admin.index',  Auth::user()->id)->with('pesan', 'Data Berhasil Di Ubah!');

        }
    }

}
