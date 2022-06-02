<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

use App\Model\Master\Ruangan as Ruangan;
use App\Model\Master\Gedung as Gedung;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class RuanganController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        $gedung = Gedung::all();
        return view('admin.master.ruangan.index', compact(['gedung']));
    }

    public function data(Request $request)
    {
        $datas = Ruangan::query()->orderBy('id', 'DESC');
        if ($request->gedungxx !='') 
        {
            $datas = $datas->where('gedung_id', 'like', '%' . $request->gedungxx . '%');
        }
        return Datatables::of($datas)
        ->addColumn('gedung', function($data)
        {
            return $data->gedung->gedung;
        })
        ->addColumn('status', function($data)
        {
            if ($data->status == "Aktif") {
                return '<center><code style="color:blue !important;">'.$data->status.'</code></center>';
            }else{
                return '<center><code style="color:red !important;">'.$data->status.'</code></center>';
            }
            
        })
        ->addColumn('foto', function($data)
        {
            return '<center><div class="avatar avatar-xxl"><img src="../../'.$data->foto.'" alt="..." class="avatar-img rounded"></div><center>';
            
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" class="btn btn-icon btn-round btn-secondary btn-sm mr-md-1" data-placement="top" title="" data-original-title="Ubah" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-gedung_id="'.$data->gedung_id.'" data-nama="'.$data->nama.'" data-keterangan="'.$data->keterangan.'" data-status="'.$data->status.'" data-foto="'.$data->foto.'">
                                <i class="fas fa-pencil-alt fa-sm"></i>
                        </a>
                        <a href="#" data-id="'.$data->id.'" title="Hapus" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm hapusbtn" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-trash fa-sm"></i>
                       </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status','gedung','foto'])
        ->make(true);
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'status' => 'required',
            'foto' => 'required',
            'gedung_id' => 'required',
        ],
        [   
            'nama.required' => 'Masukkan Nama Ruangan.',
            'status.required' => 'Pilih Status Ruangan.',
            'foto.required' => 'Masukkan Foto Ruangan.',
            'gedung_id.required' => 'Pilih Data Gedung.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = New Ruangan;
            $datas->nama = $req->nama;
            $datas->status = $req->status;
            $datas->status_pj = 0;
            $datas->gedung_id = $req->gedung_id;
            if (isset($req->keterangan)) {
                $datas->keterangan = $req->keterangan;
            }
            if (Input::hasFile('foto'))
            {
                $file = Input::file('foto');
                $path = "public/upload/admin/ruangan";
                $today = md5(rand(0,9));
                $fileName = $req->nama."-".date('d-m-Y')."-".rand(100,999).".jpg";
                $file = $file->move($path, $fileName);
                $datas->foto = $path.'/'.$fileName;
            }else{
                return redirect()->back()->with('message', 'File Gambar Harus Berformat JPG, PNG, JPEG atau GIF !');
            }
            $datas->save();

            return redirect()->route('admin.master.ruangan.index')->with('pesan', 'Data Berhasil Di Tambahkan!');;
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        Ruangan::find($id)->delete();
        return redirect()->route('admin.master.ruangan.index')->with('pesan', 'Data Berhasil Di Hapus!');;
    }

    public function ubah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'gedung_id' => 'required',
        ],
        [   
            'id.required' => 'Masukkan ID Ruangan.',
            'nama.required' => 'Masukkan Nama Ruangan.',
            'status.required' => 'Pilih Status Ruangan.',
            'gedung_id.required' => 'Pilih Data Gedung.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $datas = Ruangan::find($req->id);
            $datas->nama = $req->nama;
            $datas->status = $req->status;
            $datas->gedung_id = $req->gedung_id;
            if (isset($req->keterangan)) {
                $datas->keterangan = $req->keterangan;
            }
            if (Input::hasFile('foto'))
            {
                if (file_exists(public_path().'/../'.$datas->foto))
                {
                    unlink(public_path().'/../'.$datas->foto);
                }

                $file = Input::file('foto');
                $path = "public/upload/admin/ruangan";
                $today = md5(rand(0,9));
                $fileName = $req->nama."-".date('d-m-Y')."-".rand(100,999).".jpg";
                $file = $file->move($path, $fileName);
                $datas->foto = $path.'/'.$fileName;
            }
            $datas->save();
            return redirect()->route('admin.master.ruangan.index')->with('pesan', 'Data Berhasil Di Ubah!');;

        }
    }

}
