<?php

namespace App\Http\Controllers\Operator\Keloladata;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Hash;

use App\Model\Master\KontrakKerja as KontrakKerja;
use App\Model\Master\IndikatorKerja as IndikatorKerja;
use App\Model\Master\Bidang as Bidang;
use App\Model\Keloladata\RencanaKerja as RencanaKerja;
use App\Model\Keloladata\NilaiIndikatorKerja as NilaiIndikatorKerja;

use Auth;
use Redirect;
use App;
use Helper;
use Response;

class RencanaKerjaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:operator')->except('logout');
    }

    public function index()
    {
        $iku = IndikatorKerja::all();
        $kontrakkerja = KontrakKerja::all();
        return view('operator.keloladata.rencanakerja.index',compact(['iku','kontrakkerja']));
    }

    public function data(Request $request)
    {
        $datas = RencanaKerja::query()->where('master_bidang_id', Auth::user()->master_bidang_id);
        if ($request->status_kepala_bidang !='') 
        {
            $datas = $datas->where('status_kepala_bidang', 'like', '%' . $request->status_kepala_bidang . '%');
        }
        if ($request->master_indikator_kinerja_idxx !='') 
        {
            $datas = $datas->where('master_indikator_kinerja_id', 'like', '%' . $request->master_indikator_kinerja_idxx . '%');
        }
        if ($request->tahunxx !='') 
        {
            $datas = $datas->where('tahun', 'like', '%' . $request->tahunxx . '%');
        }
        return Datatables::of($datas)
        ->addColumn('aksi', function ($data)
        {
            if ($data->status_kepala_bidang == 1){
                return '
                    <center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-black dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bars fa-lg"></i> &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#" rel="tooltip" data-toggle="modal" data-target="#detailraker" data-id="'.$data->id.'" class="detailraker"><i class="fa fa-eye fa-fw"></i>Detail</a>
                                </li>
                                <li>
                                    <a href="#" title="Edit" rel="tooltip" data-original-title="Edit" data-toggle="modal" data-target="#dedit" data-id="'.$data->id.'" data-nama="'.$data->nama.'" data-tahun="'.$data->tahun.'" data-master_indikator_kinerja_id="'.$data->master_indikator_kinerja_id.'" data-master_kontrak_kerja_id="'.$data->master_kontrak_kerja_id.'" data-master_bidang_id="'.$data->master_bidang_id.'" data-target_waktu="'.$data->target_waktu.'" data-target_waktu="'.$data->target_waktu.'" data-target_realisasi="'.Helper::Rupiahs($data->target_realisasi).'" data-realisasi="'.$data->realisasi.'" data-file="'.$data->file.'" data-target_anggaran="'.Helper::Rupiahs($data->target_anggaran).'"><i class="fa fa-pencil fa-fw"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="tambahrealisasi" rel="tooltip" data-original-title="tambahrealisasi" data-toggle="modal" data-target="#tambahrealisasi" data-id="'.$data->id.'" data-nama="'.$data->nama.'"  data-tahun="'.$data->tahun.'" data-master_indikator_kinerja_id="'.$data->indikatorkerja->kode.' - '.$data->indikatorkerja->indikator_kinerja.'" data-master_kontrak_kerja_id="'.$data->kontrakkerja->kegiatan.'" data-master_bidang_id="'.$data->bidang->bidang.'" data-target_waktu="'.$data->target_waktu.'" data-target_realisasi="'.Helper::Rupiahs($data->target_realisasi).'" data-realisasi="'.Helper::Rupiahs($data->realisasi).'" data-target_anggaran="'.Helper::Rupiah($data->target_anggaran).'" data-anggaran="'.Helper::Rupiahs($data->anggaran).'"><i class="fa fa-plus fa-fw"></i>Realisasi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </center>
                ';
            }else{
                return '
                    <center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-black dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bars fa-lg"></i> &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#" rel="tooltip" data-toggle="modal" data-target="#detailraker" data-id="'.$data->id.'" class="detailraker"><i class="fa fa-eye fa-fw"></i>Detail</a>
                                </li>
                                <li>
                                    <a href="#" title="Edit" rel="tooltip" data-original-title="Edit" data-toggle="modal" data-target="#edit" data-id="'.$data->id.'" data-nama="'.$data->nama.'" data-tahun="'.$data->tahun.'"  data-master_indikator_kinerja_id="'.$data->master_indikator_kinerja_id.'" data-master_kontrak_kerja_id="'.$data->master_kontrak_kerja_id.'" data-master_bidang_id="'.$data->master_bidang_id.'" data-target_waktu="'.$data->target_waktu.'" data-target_realisasi="'.Helper::Rupiahs($data->target_realisasi).'" data-realisasi="'.$data->realisasi.'" data-file="'.$data->file.'" data-target_anggaran="'.Helper::Rupiahs($data->target_anggaran).'"><i class="fa fa-pencil fa-fw"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="hapusbtn" data-id="'.$data->id.'" rel="tooltip"><i class="fa fa-times fa-fw"></i>Hapus
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </center>
                ';
            }
        })
        ->addColumn('status', function($data)
        {
            return '<code style="color:green !important;">'.$data->status_kepala_bidang.'</code>';
            
        })
        ->addColumn('kontrakkerja', function($data)
        {
            return '<code style="color:green !important;">'.$data->kontrakkerja->kegiatan.'</code>';
            
        })
        ->addColumn('target_realisasi', function($data)
        {
            return '<code style="color:blue !important;">'.$data->target_realisasi.'</code>';
            
        })
        ->addColumn('realisasi', function($data)
        {
            return '<code style="color:blue !important;">'.$data->realisasi.'</code>';
            
        })
        ->addColumn('indikatorkerja', function($data)
        {
            return '<code style="color:blue !important;">'.$data->indikatorkerja->kode.'</code>';
            // return '<code style="color:blue !important;">'.$data->indikatorkerja->kode.'</code> - '.$data->indikatorkerja->indikator_kinerja;
            
        })
        ->addColumn('target_waktu', function($data)
        {
            return '<code style="color:green !important;">'.Helper::indonesian_date($data->target_waktu,'j M  Y').'</code>';
        })
        ->addColumn('status', function($data)
        {
            if ($data->status_kepala_bidang == 1) {
                return '<button type="button" class="btn btn-success btn-xs">Diverifikasi</button>';
            }else if ($data->status_kepala_bidang == 0) {
                return '<button type="button" class="btn btn-danger btn-xs">Ditolak</button>';
            }else{
                return '<button type="button" class="btn btn-warning btn-xs">Belum Diproses</button>';
            }
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','indikatorkerja','target_waktu','kontrakkerja','status','target_realisasi','realisasi'])
        ->make(true);
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'master_kontrak_kerja_id' => 'required',
            'master_indikator_kinerja_id' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
            'target_waktu' => 'required',
            'target_realisasi' => 'required',
            'target_anggaran' => 'required',
        ],
        [   
            'master_kontrak_kerja_id' => 'Pilih Kontrak Kerja',
            'master_indikator_kinerja_id' => 'Pilih Indikator Kerja',
            'nama' => 'Masukkan Rencana Kerja',
            'tahun' => 'Masukkan Tahun Rencana Kerja',
            'target_waktu' => 'Masukkan Target Waktu',
            'target_realisasi' => 'Masukkan Target Realisasi',
            'target_anggaran' => 'Masukkan Target Anggaran',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = New RencanaKerja;
            $objek->master_kontrak_kerja_id = $req->master_kontrak_kerja_id;
            $objek->master_bidang_id  = Auth::user()->master_bidang_id;
            $objek->master_indikator_kinerja_id = $req->master_indikator_kinerja_id;
            $objek->nama = $req->nama;
            $objek->tahun = $req->tahun;
            $objek->target_waktu = $req->target_waktu;
            $objek->target_realisasi = $req->target_realisasi;
            $objek->target_anggaran = str_replace('.', '', $req->target_anggaran);
            $objek->status_kepala_bidang = 2;
            if (Input::hasFile('file'))
            {
                $file = Input::file('file');
                $path = "public/upload/operator/".Auth::user()->master_bidang_id;
                $today = 'file-'.date("Y-m-d-H-i-s",time()).'-'.rand(000,999);
                $fileName = $today.".pdf";
                $file = $file->move($path, $fileName);
                $objek->file = $path.'/'.$fileName;
            }
            $objek->save();
            return redirect()->route('operator.keloladata.rencanakerja.index')->with('pesan', 'Data Berhasil Di Tambahkan!');
        }
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        RencanaKerja::find($id)->delete();
        return redirect()->route('operator.keloladata.rencanakerja.index')->with('pesan', 'Data Berhasil Di Hapus!');
    }

    public function ubah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'master_kontrak_kerja_id' => 'required',
            'master_indikator_kinerja_id' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
            'target_waktu' => 'required',
            'target_realisasi' => 'required',
            'target_anggaran' => 'required',
        ],
        [   
            'id' => 'Masukkan ID',
            'master_kontrak_kerja_id' => 'Pilih Kontrak Kerja',
            'master_indikator_kinerja_id' => 'Pilih Indikator Kerja',
            'nama' => 'Masukkan Rencana Kerja',
            'tahun' => 'Masukkan Tahun Rencana Kerja',
            'target_waktu' => 'Masukkan Target Waktu',
            'target_realisasi' => 'Masukkan Target Realisasi',
            'target_anggaran' => 'Masukkan Target Anggaran',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = RencanaKerja::find($req->id);
            $objek->master_kontrak_kerja_id = $req->master_kontrak_kerja_id;
            $objek->master_bidang_id  = Auth::user()->master_bidang_id;
            $objek->master_indikator_kinerja_id = $req->master_indikator_kinerja_id;
            $objek->nama = $req->nama;
            $objek->target_waktu = $req->target_waktu;
            $objek->tahun = $req->tahun;
            $objek->target_anggaran = str_replace('.', '', $req->target_anggaran);
            $objek->target_realisasi = str_replace('.', '', $req->target_realisasi);
            if (Input::hasFile('file'))
            {
                if (file_exists(public_path().'/../'.$objek->file) && isset($objek->file))
                {
                    unlink(public_path().'/../'.$objek->file);
                }
                $file = Input::file('file');
                $path = "public/upload/operator/".Auth::user()->master_bidang_id;
                $today = 'file-'.date("Y-m-d-H-i-s",time()).'-'.rand(000,999);
                $fileName = $today.".pdf";
                $file = $file->move($path, $fileName);
                $objek->file = $path.'/'.$fileName;
            }
            $objek->save();
            return redirect()->route('operator.keloladata.rencanakerja.index')->with('pesan', 'Data Berhasil Di Ubah !');
        }
    }

    public function ubahs(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'target_waktu' => 'required',
        ],
        [   
            'id' => 'Masukkan ID',
            'target_waktu' => 'Masukkan Target Waktu',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = RencanaKerja::find($req->id);
            $objek->target_waktu = $req->target_waktu;
            $objek->save();
            return redirect()->route('operator.keloladata.rencanakerja.index')->with('pesan', 'Data Berhasil Di Ubah !');
        }
    }

    public function tambahrealisasi(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'realisasi' => 'required',
            'anggaran' => 'required',
        ],
        [   
            'id' => 'Masukkan ID',
            'realisasi' => 'Masukkan Realisasi',
            'anggaran' => 'Masukkan Anggaran',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $objek = RencanaKerja::find($req->id);
            $objek->anggaran = str_replace('.', '', $req->anggaran);
            $objek->realisasi = str_replace('.', '', $req->realisasi);
            $objek->nilai = $objek->realisasi/$objek->target_realisasi*100;
            if (Input::hasFile('files'))
            {
                if (file_exists(public_path().'/../'.$objek->files) && isset($objek->files))
                {
                    unlink(public_path().'/../'.$objek->files);
                }
                $files = Input::file('files');
                $path = "public/upload/operator/".Auth::user()->master_bidang_id;
                $today = 'file-'.date("Y-m-d-H-i-s",time()).'-'.rand(000,999);
                $fileName = $today.".pdf";
                $files = $files->move($path, $fileName);
                $objek->files = $path.'/'.$fileName;
            }
            $objek->save();

            return redirect()->route('operator.keloladata.rencanakerja.index')->with('pesan', 'Realisasi Berhasil Di Tambahkan !');
        }
    }

    public function sort($id)
    {
        $data = IndikatorKerja::where('master_kontrak_kerja_id', $id)->get();
        return response()->json($data);
    }

    public function detail($id)
    {
        $data['raker'] = RencanaKerja::find($id);
        $data['raker']['target_anggaran'] = Helper::Rupiah($data['raker']['target_anggaran']);
        $data['raker']['anggaran'] = Helper::Rupiah($data['raker']['anggaran']);
        $data['iku'] = IndikatorKerja::find($data['raker']->master_indikator_kinerja_id);
        $data['konrak'] = KontrakKerja::find($data['raker']->master_kontrak_kerja_id);
        $data['bidang'] = Bidang::find($data['raker']->master_bidang_id);
        return Response::json($data);
    }

}
