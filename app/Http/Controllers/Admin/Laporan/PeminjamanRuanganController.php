<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Hash;

use App\Model\Transaksi\PeminjamanRuangan as PeminjamanRuangan;
use App\Model\Master\Gedung as Gedung;
use App\Model\Master\Ruangan as Ruangan;
use App\Model\User\Mahasiswa as Mahasiswa;
use App\Model\User\Dosen as Dosen;

use Auth;
use Redirect;
use App;
use Helper;
use Response;
use Telegram;

class PeminjamanRuanganController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();
        return view('admin.laporan.peminjamanruangan.index',compact(['ruangan','gedung']));
    }

    public function data(Request $request)
    {
        $datas = PeminjamanRuangan::query()
        ->where('jenis_pinjaman', 0)
        ->orderBy('id', 'DESC');
        if ($request->statusss !='') 
        {
            $datas = $datas->where('status_pj', 'like', '%' . $request->statusss . '%');
        }
        return Datatables::of($datas)
        ->addColumn('nama', function($data)
        {
            return Helper::ambilMahasiswa($data->mahasiswa_id,'nama');
        })
        ->addColumn('jumlah_hari', function($data)
        {
            return $data->jumlah_hari." Hari";
        })
        ->addColumn('gedung', function($data)
        {
            return '<button type="button" class="btn btn-danger btn-xs">'.Helper::AmbilGedung($data->ruangan->gedung_id).'</button>';
        })
        ->addColumn('ruangan', function($data)
        {
            return '<button type="button" class="btn btn-danger btn-xs">'.$data->ruangan->nama.'</button>';
        })
        ->addColumn('status_wd', function($data)
        {
            if ($data->status_wd == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_wd == 1) {
                return '<center><code style="color:green !important;">Terverifikasi</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Diverifikasi</code></center>';
            }
            
        })
        ->addColumn('status_op', function($data)
        {
            if ($data->status_op == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_op == 1) {
                return '<center><code style="color:green !important;">Terverifikasi</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Diverifikasi</code></center>';
            }
            
        })
        ->addColumn('status_pj', function($data)
        {
            if ($data->status_pj == 0) {
                return '<center><code style="color:blue !important;">Sedang Diproses</code></center>';
            }elseif ($data->status_pj == 1) {
                return '<center><code style="color:green !important;">Sedang Dipinjam</code></center>';
            }elseif ($data->status_pj == 2) {
                return '<center><code style="color:blue !important;">Proses Pengembalian</code></center>';
            }elseif ($data->status_pj == 3) {
                return '<center><code style="color:green !important;">Selesai</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Disetujui</code></center>';
            }
            
        })
        ->addColumn('tgl_transaksi', function($data)
        {
            return Helper::indonesian_date($data->tgl_transaksi,'j F Y');
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status_wd','status_op','gedung','status_pj','ruangan','nama'])
        ->make(true);
    }

    public function datax(Request $request)
    {
        $datas = PeminjamanRuangan::query()
        ->where('jenis_pinjaman', 1)
        ->orderBy('id', 'DESC');
        if ($request->statusss !='') 
        {
            $datas = $datas->where('status_pj', 'like', '%' . $request->statusss . '%');
        }
        return Datatables::of($datas)
        ->addColumn('nama', function($data)
        {
            return Helper::ambilDosen($data->dosen_id,'nama');
        })
        ->addColumn('jumlah_hari', function($data)
        {
            return $data->jumlah_hari." Hari";
        })
        ->addColumn('gedung', function($data)
        {
            return '<button type="button" class="btn btn-danger btn-xs">'.Helper::AmbilGedung($data->ruangan->gedung_id).'</button>';
        })
        ->addColumn('ruangan', function($data)
        {
            return '<button type="button" class="btn btn-danger btn-xs">'.$data->ruangan->nama.'</button>';
        })
        ->addColumn('status_wd', function($data)
        {
            if ($data->status_wd == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_wd == 1) {
                return '<center><code style="color:green !important;">Terverifikasi</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Diverifikasi</code></center>';
            }
            
        })
        ->addColumn('status_op', function($data)
        {
            if ($data->status_op == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_op == 1) {
                return '<center><code style="color:green !important;">Terverifikasi</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Diverifikasi</code></center>';
            }
            
        })
        ->addColumn('status_pj', function($data)
        {
            if ($data->status_pj == 0) {
                return '<center><code style="color:blue !important;">Sedang Diproses</code></center>';
            }elseif ($data->status_pj == 1) {
                return '<center><code style="color:green !important;">Sedang Dipinjam</code></center>';
            }elseif ($data->status_pj == 2) {
                return '<center><code style="color:blue !important;">Proses Pengembalian</code></center>';
            }elseif ($data->status_pj == 3) {
                return '<center><code style="color:green !important;">Selesai</code></center>';
            }else{
                return '<center><code style="color:red !important;">Tidak Disetujui</code></center>';
            }
            
        })
        ->addColumn('tgl_transaksi', function($data)
        {
            return Helper::indonesian_date($data->tgl_transaksi,'j F Y | H:i');
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#details" class="btn btn-icon btn-round btn-info btn-sm details" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status_wd','status_op','gedung','status_pj','ruangan','nama'])
        ->make(true);
    }

    public function datas(Request $request)
    {
        $datas = Ruangan::query()->orderBy('id', 'DESC')->where('status', 'Aktif');
        if ($request->gedungxx !='') 
        {
            $datas = $datas->where('gedung_id', 'like', '%' . $request->gedungxx . '%');
        }
        if ($request->statusx !='') 
        {
            $datas = $datas->where('status_pj', 'like', '%' . $request->statusx . '%');
        }
        return Datatables::of($datas)
        ->addColumn('gedung', function($data)
        {
            return $data->gedung->gedung;
        })
        ->addColumn('status_pj', function($data)
        {
            if ($data->status_pj == 1) {
                return '<center><code style="color:blue !important;">Sedang Dipinjam</code></center>';
            }else{
                return '<center><code style="color:green !important;">Tersedia</code></center>';
            }
            
        })
        ->addColumn('foto', function($data)
        {
            return '<center><div class="avatar avatar-xxl"><img src="../../'.$data->foto.'" alt="..." class="avatar-img rounded"></div><center>';
            
        })
        ->addIndexColumn()
        ->rawColumns(['status_pj','gedung','foto'])
        ->make(true);
    }

    public function detail($id)
    {
        $data['transaksi'] = PeminjamanRuangan::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y | H:i');
        $data['transaksi']['gedung'] = Helper::AmbilGedung($data['transaksi']->ruangan->gedung_id);
        $data['transaksi']['ruangans'] = $data['transaksi']->ruangan->nama;
        $data['transaksi']['foto'] = $data['transaksi']->ruangan->foto;
        $data['transaksi']['jumlah_hari'] = $data['transaksi']['jumlah_hari'].' Hari';
        if ($data['transaksi']['status_pj'] == 0) {
            $data['transaksi']['status_pj'] = "Sedang Diproses";
        }else if ($data['transaksi']['status_pj'] == 1){
            $data['transaksi']['status_pj'] = "Sedang Dipinjam";
        }else if ($data['transaksi']['status_pj'] == 2){
            $data['transaksi']['status_pj'] = "Proses Pengembalian";
        }else if ($data['transaksi']['status_pj'] == 3){
            $data['transaksi']['status_pj'] = "Selesai";
        }else{
            $data['transaksi']['status_pj'] = "Tidak Disetujui";
        }

        if ($data['transaksi']['status_wd'] == 0) {
            $data['transaksi']['status_wd'] = "Belum Diverifikasi";
        }else if ($data['transaksi']['status_wd'] == 1){
            $data['transaksi']['status_wd'] = "Sudah Diverifikasi";
        }else{
            $data['transaksi']['status_wd'] = "Tidak Diverifikasi";
        }
        
        if ($data['transaksi']['status_op'] == 0) {
            $data['transaksi']['status_op'] = "Belum Diverifikasi";
        }else if ($data['transaksi']['status_op'] == 1){
            $data['transaksi']['status_op'] = "Sudah Diverifikasi";
        }else{
            $data['transaksi']['status_op'] = "Tidak Diverifikasi";
        }
        $data['mahasiswa'] = Mahasiswa::find($data['transaksi']['mahasiswa_id']);
        return Response::json($data);
    }

    public function details($id)
    {
        $data['transaksi'] = PeminjamanRuangan::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y');
        $data['transaksi']['gedung'] = Helper::AmbilGedung($data['transaksi']->ruangan->gedung_id);
        $data['transaksi']['ruangans'] = $data['transaksi']->ruangan->nama;
        $data['transaksi']['foto'] = $data['transaksi']->ruangan->foto;
        $data['transaksi']['jumlah_hari'] = $data['transaksi']['jumlah_hari'].' Hari';
        if ($data['transaksi']['status_pj'] == 0) {
            $data['transaksi']['status_pj'] = "Sedang Diproses";
        }else if ($data['transaksi']['status_pj'] == 1){
            $data['transaksi']['status_pj'] = "Sedang Dipinjam";
        }else if ($data['transaksi']['status_pj'] == 2){
            $data['transaksi']['status_pj'] = "Proses Pengembalian";
        }else if ($data['transaksi']['status_pj'] == 3){
            $data['transaksi']['status_pj'] = "Selesai";
        }else{
            $data['transaksi']['status_pj'] = "Tidak Disetujui";
        }

        if ($data['transaksi']['status_wd'] == 0) {
            $data['transaksi']['status_wd'] = "Belum Diverifikasi";
        }else if ($data['transaksi']['status_wd'] == 1){
            $data['transaksi']['status_wd'] = "Sudah Diverifikasi";
        }else{
            $data['transaksi']['status_wd'] = "Tidak Diverifikasi";
        }
        
        if ($data['transaksi']['status_op'] == 0) {
            $data['transaksi']['status_op'] = "Belum Diverifikasi";
        }else if ($data['transaksi']['status_op'] == 1){
            $data['transaksi']['status_op'] = "Sudah Diverifikasi";
        }else{
            $data['transaksi']['status_op'] = "Tidak Diverifikasi";
        }
        $data['dosen'] = Dosen::find($data['transaksi']['dosen_id']);
        return Response::json($data);
    }

}
