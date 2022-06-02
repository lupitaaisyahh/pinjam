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

use App\Model\User\WakilDekan as WakilDekan;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class WakilDekanController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        return view('admin.kelolauser.wakildekan.index');
    }

    public function data(Request $request)
    {
        $datas = WakilDekan::query();
        return Datatables::of($datas)
        ->addColumn('lastlogin', function($data)
        {
            return Helper::indonesian_date($data->last_login_at,'j M  Y / H:i', 'WIB');
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" class="btn btn-icon btn-round btn-secondary btn-sm mr-md-1" data-placement="top" title="" data-original-title="Ubah" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-nama="'.$data->nama.'" data-email="'.$data->email.'" data-username="'.$data->username.'" data-j_kel="'.$data->j_kel.'" data-no_telp="'.$data->no_telp.'" data-chat_id="'.$data->chat_id.'">
                                <i class="fas fa-pencil-alt fa-sm"></i>
                        </a>
                        <a href="#" data-id="'.$data->id.'" title="Hapus" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm hapusbtn" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-trash fa-sm"></i>
                       </a>
                </center>
            ';
        })
        ->addColumn('username', function($data)
        {
            return '<button type="button" class="btn btn-danger btn-xs">'.$data->username.'</button>';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','lastlogin','username'])
        ->make(true);
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'username' => 'required|unique:user_wakildekan',
            'email' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',
            'password' => 'required',
            'chat_id' => 'required',

        ],
        [   
            'nama.required' => 'Masukkan Nama.',
            'username.required' => 'Masukkan Username.',
            'username.unique' => 'NIM Sudah Terdaftar.',
            'email.required' => 'Masukkan E-Mail.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
            'password.required' => 'Masukkan Password.',
            'chat_id.required' => 'Masukkan Chat ID.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = New WakilDekan;
            $objek->nama = $req->nama;
            $objek->username = $req->username;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            $objek->chat_id = $req->chat_id;
            $objek->password = Hash::make($req->password);
            $objek->save();

            return redirect()->route('admin.kelolauser.wakildekan.index')->with('pesan', 'Data Berhasil Di Tambahkan!');
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        WakilDekan::find($id)->delete();
        return redirect()->route('admin.kelolauser.wakildekan.index')->with('pesan', 'Data Berhasil Di Hapus!');
    }

    public function ubah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',
            'chat_id' => 'required',

        ],
        [   
            'id.required' => 'Masukkan ID.',
            'nama.required' => 'Masukkan Nama.',
            'email.required' => 'Masukkan E-Mail.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
            'chat_id.required' => 'Masukkan Chat ID.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = WakilDekan::find($req->id);;
            $objek->nama = $req->nama;
            $objek->username = $req->username;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            $objek->chat_id = $req->chat_id;
            if (isset($req->password)) {
                $objek->password = Hash::make($req->password);
            }
            $objek->save();

            return redirect()->route('admin.kelolauser.wakildekan.index')->with('pesan', 'Data Berhasil Di Tambahkan!');
        }
    }

}
