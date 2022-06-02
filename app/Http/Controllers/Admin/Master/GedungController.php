<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

use App\Model\Master\Gedung as Gedung;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class GedungController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        return view('admin.master.gedung.index');
    }

    public function data(Request $request)
    {
        $datas = Gedung::query()->orderBy('id', 'DESC');
        return Datatables::of($datas)
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" class="btn btn-icon btn-round btn-secondary btn-sm mr-md-1" data-placement="top" title="" data-original-title="Ubah" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-gedung="'.$data->gedung.'">
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
            'gedung' => 'required',
        ],
        [   
            'gedung.required' => 'Masukkan Data Gedung.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = New Gedung;
            $datas->gedung = $req->gedung;
            $datas->save();

            return redirect()->route('admin.master.gedung.index')->with('pesan', 'Data Berhasil Di Tambahkan!');;
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        Gedung::find($id)->delete();
        return redirect()->route('admin.master.gedung.index')->with('pesan', 'Data Berhasil Di Hapus!');;
    }

    public function ubah(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'gedung' => 'required',
        ],
        [   
            'gedung.required' => 'Masukkan Data Gedung.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $datas = Gedung::find($req->id);
            $datas->gedung = $req->gedung;
            $datas->save();
            return redirect()->route('admin.master.gedung.index')->with('pesan', 'Data Berhasil Di Ubah!');;

        }
    }

}
