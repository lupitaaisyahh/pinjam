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

use App\Model\Transaksi\PeminjamanBarang as PeminjamanBarang;
use App\Model\Transaksi\PeminjamanBarangItems as PeminjamanBarangItems;
use App\Model\Master\JenisBarang as JenisBarang;
use App\Model\Master\SatuanBarang as SatuanBarang;
use App\Model\Master\Barang as Barang;
use App\Model\Master\Gedung as Gedung;
use App\Model\Master\Ruangan as Ruangan;
use App\Model\User\Mahasiswa as Mahasiswa;

use Auth;
use Redirect;
use App;
use Helper;
use Response;
use Telegram;

class PeminjamanBarangController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        $barang = Barang::where('status', 'Aktif')->get();
        $jenis = JenisBarang::all();
        return view('admin.laporan.peminjamanbarang.index',compact(['jenis','barang']));
    }

    public function data(Request $request)
    {
        $datas = Barang::query()->orderBy('id', 'DESC');
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
        ->addColumn('jumlah_stok', function($data)
        {
            return '<center>'.$data->jumlah_stok.'</center>';
        })
        ->addColumn('dipinjam', function($data)
        {
            $pinjam = $data->jumlah-$data->jumlah_stok;
            return '<center>'.$pinjam.'</center>';
        })
        ->addColumn('status', function($data)
        {
            if ($data->status == "Aktif") {
                return '<center><code style="color:blue !important;">'.$data->status.'</code></center>';
            }else{
                return '<center><code style="color:red !important;">'.$data->status.'</code></center>';
            }
            
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="'.route("admin.laporan.peminjamanbarang.detail.index", $data->id).'" class="btn btn-icon btn-round btn-info btn-sm">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status','jumlah','satuan','jenis','jumlah_stok','dipinjam'])
        ->make(true);
    }

    public function datas(Request $request)
    {
        $datas = PeminjamanBarang::query()->where('jenis_pinjaman', 0)->orderBy('status_pj', 'ASC');
        if ($request->statusss !='') 
        {
            $datas = $datas->where('status_pj', 'like', '%' . $request->statusss . '%');
        }
        return Datatables::of($datas)
        ->addColumn('mahasiswa', function($data)
        {
            return Helper::ambilMahasiswa($data->mahasiswa_id,'nama');
        })
        ->addColumn('nim', function($data)
        {
            return Helper::ambilMahasiswa($data->mahasiswa_id,'nim');
        })
        ->addColumn('j_kel', function($data)
        {
            return Helper::ambilMahasiswa($data->mahasiswa_id,'j_kel');
        })
        ->addColumn('jumlah', function($data)
        {
            return Helper::ambilItemsBarang($data->id,'jumlah');
        })
        ->addColumn('status_wd', function($data)
        {
            if ($data->status_wd == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_wd == 1) {
                return '<center><code style="color:green !important;">Terverifikasi<br>'.$data->tgl_verifikasi_wd.'</code></center> ';
            }else{
                return '<center><code style="color:red !important;">Tidak Diverifikasi</code></center>';
            }
        })
        ->addColumn('status_op', function($data)
        {
            if ($data->status_op == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_op == 1) {
                return '<center><code style="color:green !important;">Terverifikasi<br>'.$data->tgl_verifikasi_op.'</code></center> ';
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
            return Helper::indonesian_date($data->tgl_transaksi,'j F Y | H:i ');
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="detail">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status_wd','status_op','status_pj','mahasiswa','nim','j_kel'])
        ->make(true);
    }

    public function datass(Request $request)
    {
        $datas = PeminjamanBarang::query()->where('jenis_pinjaman', 1)->orderBy('status_pj', 'ASC');
        if ($request->statussss !='') 
        {
            $datas = $datas->where('status_pj', 'like', '%' . $request->statussss . '%');
        }
        return Datatables::of($datas)
        ->addColumn('dosen', function($data)
        {
            return Helper::ambilDosen($data->dosen_id,'nama');
        })
        
        ->addColumn('j_kel', function($data)
        {
            return Helper::ambilDosen($data->dosen_id,'j_kel');
        })
        ->addColumn('jumlah', function($data)
        {
            return Helper::ambilItemsBarang($data->id,'jumlah');
        })
        ->addColumn('status_wd', function($data)
        {
            if ($data->status_wd == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_wd == 1) {
                return '<center><code style="color:green !important;">Terverifikasi<br>'.$data->tgl_verifikasi_wd.'</code></center> ';
            }else{
                return '<center><code style="color:red !important;">Tidak Diverifikasi</code></center>';
            }
        })
        ->addColumn('status_op', function($data)
        {
            if ($data->status_op == 0) {
                return '<center><code style="color:blue !important;">Belum Diverifikasi</code></center>';
            }elseif ($data->status_op == 1) {
                return '<center><code style="color:green !important;">Terverifikasi<br>'.$data->tgl_verifikasi_op.'</code></center> ';
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
            return Helper::indonesian_date($data->tgl_transaksi,'j F Y | H:i ');
        })
        ->addColumn('aksi', function ($data)
        {
            
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#details" class="btn btn-icon btn-round btn-info btn-sm details" data-placement="top" title="" data-original-title="details">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status_wd','status_op','status_pj','dosen','j_kel'])
        ->make(true);
    }


}
