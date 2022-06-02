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

use App\Model\User\Mahasiswa as Mahasiswa;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class MahasiswaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        return view('admin.kelolauser.mahasiswa.index');
    }

    public function data(Request $request)
    {
        $datas = Mahasiswa::query();
        return Datatables::of($datas)
        ->addColumn('status', function($data)
        {
            if ($data->status == 0) {
                return '<center><code style="color:blue !important;">Belum Terverifikasi</code></center>';
            }else if ($data->status == 1) {
                return '<center><code style="color:green !important;">Sudah Terverifikasi</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Terverifikasi</code></center>';
            }
            
        })
        ->addColumn('lastlogin', function($data)
        {
            return Helper::indonesian_date($data->last_login_at,'j M  Y / H:i', 'WIB');
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#verifikasi" class="btn btn-icon btn-round btn-primary btn-sm verifikasi" data-placement="top" title="" data-original-title="verifikasi">
                            <i class="fas fa-check fa-sm"></i>
                        </a>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="detail">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-round btn-secondary btn-sm mr-md-1" data-placement="top" title="" data-original-title="Ubah" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-nama="'.$data->nama.'" data-email="'.$data->email.'" data-username="'.$data->username.'" data-nim="'.$data->nim.'" data-jurusan="'.$data->jurusan.'" data-j_kel="'.$data->j_kel.'" data-no_telp="'.$data->no_telp.'" data-chat_id="'.$data->chat_id.'">
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
        ->rawColumns(['aksi','lastlogin','username','status'])
        ->make(true);
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswa',
            'email' => 'required',
            'jurusan' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',
            'password' => 'required',
            'chat_id' => 'required',

        ],
        [   
            'nama.required' => 'Masukkan Nama.',
            'jurusan.required' => 'Masukkan jurusan.',
            'nim.required' => 'Masukkan NIM.',
            'nim.unique' => 'NIM Sudah Terdaftar.',
            'email.required' => 'Masukkan E-Mail.',
            'email.unique' => 'E-Mail Sudah Terdaftar.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
            'password.required' => 'Masukkan Password.',
            'chat_id.required' => 'Masukkan Chat ID.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = New Mahasiswa;
            $objek->nama = $req->nama;
            $objek->nim = $req->nim;
            $objek->username = $req->nim;
            $objek->jurusan = $req->jurusan;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            $objek->chat_id = $req->chat_id;
            $objek->password = Hash::make($req->password);
            $objek->save();

            return redirect()->route('admin.kelolauser.mahasiswa.index')->with('pesan', 'Data Berhasil Di Tambahkan!');
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        Mahasiswa::find($id)->delete();
        return redirect()->route('admin.kelolauser.mahasiswa.index')->with('pesan', 'Data Berhasil Di Hapus!');
    }

    public function ubah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',
            'jurusan' => 'required',
            'chat_id' => 'required',

        ],
        [   
            'id.required' => 'Masukkan ID.',
            'nama.required' => 'Masukkan Nama.',
            'nim.required' => 'Masukkan NIM.',
            'email.required' => 'Masukkan E-Mail.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
            'jurusan.required' => 'Masukkan Jurusan.',
            'chat_id.required' => 'Masukkan Chat ID.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = Mahasiswa::find($req->id);;
            $objek->nama = $req->nama;
            $objek->username = $req->nim;
            $objek->nim = $req->nim;
            $objek->jurusan = $req->jurusan;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            $objek->chat_id = $req->chat_id;
            if (isset($req->password)) {
                $objek->password = Hash::make($req->password);
            }
            $objek->save();

            return redirect()->route('admin.kelolauser.mahasiswa.index')->with('pesan', 'Data Berhasil Di Tambahkan!');
        }
    }
    public function verifikasi(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'status' => 'required',

        ],
        [   
            'id.required' => 'Masukkan ID.',
            'status.required' => 'Pilih Status.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = Mahasiswa::find($req->id);;
            $objek->status = $req->status;
            $objek->save();

            return redirect()->route('admin.kelolauser.mahasiswa.index')->with('pesan', 'Data Berhasil Verifikasi!');
        }
    }

    public function detail($id)
    {
        $data = Mahasiswa::find($id);
        if ($data['status'] == 0) {
            $data['status'] = "Belum Terverifikasi";
        }else if ($data['status'] == 1) {
            $data['status'] = "Sudah Terverifikasi";
        }else{
            $data['status'] = "Tidak Terverifikasi";
        }
        return Response::json($data);
    }

}
