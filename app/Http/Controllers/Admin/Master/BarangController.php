<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

use App\Model\Master\JenisBarang as JenisBarang;
use App\Model\Master\SatuanBarang as SatuanBarang;
use App\Model\Master\Barang as Barang;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class BarangController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        $jenis = JenisBarang::all();
        $satuan = SatuanBarang::all();
        return view('admin.master.barang.index', compact(['jenis','satuan']));
    }

    public function data(Request $request)
    {
        $datas = Barang::query()->orderBy('id', 'DESC');
        if ($request->jenisxx !='') 
        {
            $datas = $datas->where('jenis_barang_id', 'like', '%' . $request->jenisxx . '%');
        }
        return Datatables::of($datas)
        ->addColumn('jenis', function($data)
        {
            return $data->jenis->jenis_barang;
        })
        ->addColumn('satuan', function($data)
        {
            return $data->satuan->satuan;
        })
        ->addColumn('jumlah', function($data)
        {
            return '<center>'.$data->jumlah.'</center>';
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
                        <a href="#" class="btn btn-icon btn-round btn-secondary btn-sm mr-md-1" data-placement="top" title="" data-original-title="Ubah" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-jenis_barang_id="'.$data->jenis_barang_id.'" data-nama="'.$data->nama.'" data-jumlah="'.$data->jumlah.'" data-satuan_barang_id="'.$data->satuan_barang_id.'" data-keterangan="'.$data->keterangan.'" data-status="'.$data->status.'" data-foto="'.$data->foto.'">
                                <i class="fas fa-pencil-alt fa-sm"></i>
                        </a>
                        <a href="#" data-id="'.$data->id.'" title="Hapus" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm hapusbtn" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-trash fa-sm"></i>
                       </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status','jumlah','satuan','jenis','foto'])
        ->make(true);
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'status' => 'required',
            'foto' => 'required',
            'jumlah' => 'required',
            'jenis_barang_id' => 'required',
            'satuan_barang_id' => 'required',
        ],
        [   
            'nama.required' => 'Masukkan Nama Barang.',
            'status.required' => 'Pilih Status Barang.',
            'jumlah.required' => 'Masukkan Jumlah Barang.',
            'foto.required' => 'Masukkan Foto Barang.',
            'jenis_barang_id.required' => 'Pilih Jenis Barang.',
            'satuan_barang_id.required' => 'Pilih Satuan Barang.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = New Barang;
            $datas->nama = $req->nama;
            $datas->status = $req->status;
            $datas->jenis_barang_id = $req->jenis_barang_id;
            $datas->satuan_barang_id = $req->satuan_barang_id;
            $datas->jumlah = $req->jumlah;
            $datas->jumlah_stok = $req->jumlah;
            if (isset($req->keterangan)) {
                $datas->keterangan = $req->keterangan;
            }
            if (Input::hasFile('foto'))
            {
                $file = Input::file('foto');
                $path = "public/upload/admin/barang";
                $today = md5(rand(0,9));
                $fileName = $req->nama."-".date('d-m-Y')."-".rand(100,999).".jpg";
                $file = $file->move($path, $fileName);
                $datas->foto = $path.'/'.$fileName;
            }else{
                return redirect()->back()->with('message', 'File Gambar Harus Berformat JPG, PNG, JPEG atau GIF !');
            }
            $datas->save();

            return redirect()->route('admin.master.barang.index')->with('pesan', 'Data Berhasil Di Tambahkan!');;
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        $barang = Barang::find($id);
        if (file_exists(public_path().'/../'.$barang->foto) && isset($barang->foto))
        {
            unlink(public_path().'/../'.$barang->foto);
        }
        $barang->delete();
        return redirect()->route('admin.master.barang.index')->with('pesan', 'Data Berhasil Di Hapus!');;
    }

    public function ubah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'jenis_barang_id' => 'required',
            'jumlah' => 'required',
            'satuan_barang_id' => 'required',
        ],
        [   
            'id.required' => 'Masukkan ID Barang.',
            'nama.required' => 'Masukkan Nama Barang.',
            'jumlah.required' => 'Masukkan Jumlah Barang.',
            'status.required' => 'Pilih Status Barang.',
            'jenis_barang_id.required' => 'Pilih Jenis Barang.',
            'satuan_barang_id.required' => 'Pilih Satuan Barang.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $datas = Barang::find($req->id);
            $datas->nama = $req->nama;
            $datas->status = $req->status;
            $datas->jenis_barang_id = $req->jenis_barang_id;
            $datas->satuan_barang_id = $req->satuan_barang_id;
            $datas->jumlah = $req->jumlah;
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
            return redirect()->route('admin.master.barang.index')->with('pesan', 'Data Berhasil Di Ubah!');;

        }
    }

}
