<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

use App\Model\Master\SatuanBarang as SatuanBarang;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class SatuanController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        return view('admin.master.satuanbarang.index');
    }

    public function data(Request $request)
    {
        $datas = SatuanBarang::query()->orderBy('id', 'DESC');
        return Datatables::of($datas)
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" class="btn btn-icon btn-round btn-secondary btn-sm mr-md-1" data-placement="top" title="" data-original-title="Ubah" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-satuan="'.$data->satuan.'">
                                <i class="fas fa-pencil-alt fa-sm"></i>
                        </a>
                        <a href="#" data-id="'.$data->id.'" title="Hapus" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm hapusbtn" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-trash fa-sm"></i>
                       </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'satuan' => 'required',
        ],
        [   
            'satuan.required' => 'Masukkan Data Satuan Barang.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = New SatuanBarang;
            $datas->satuan = $req->satuan;
            $datas->save();

            return redirect()->route('admin.master.satuanbarang.index')->with('pesan', 'Data Berhasil Di Tambahkan!');;
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        SatuanBarang::find($id)->delete();
        return redirect()->route('admin.master.satuanbarang.index')->with('pesan', 'Data Berhasil Di Hapus!');;
    }

    public function ubah(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'satuan' => 'required',
        ],
        [   
            'satuan.required' => 'Masukkan Data Satuan Barang.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $datas = SatuanBarang::find($req->id);
            $datas->satuan = $req->satuan;
            $datas->save();
            return redirect()->route('admin.master.satuanbarang.index')->with('pesan', 'Data Berhasil Di Ubah!');;

        }
    }

}
