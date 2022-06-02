<?php

namespace App\Http\Controllers\Wakildekan\Laporan;

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
use App\Model\User\Dosen as Dosen;

use Auth;
use Redirect;
use App;
use Helper;
use Response;
use Telegram;

class PeminjamanBarangDetailController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:wakildekan')->except('logout');
    }

    public function index($id)
    {
        $barang = Barang::where('status', 'Aktif')->get();
        $jenis = JenisBarang::all();
        return view('wakildekan.laporan.peminjamanbarang.detail.index',compact(['id','jenis','barang']));
    }

    public function data($id, Request $request)
    {
        $items = PeminjamanBarangItems::where('barang_id', $id)->select('peminjaman_barang_id')->get();
        foreach ($items as $key => $value)
        {
            $iditems[] = $value->peminjaman_barang_id;
        }
        if (empty($iditems)) {
            $iditems[]=0;
        }
        $datas = PeminjamanBarang::query()->whereIn('id', $iditems)
        ->where(
        function($query) {
            return $query
                ->where('status_pj', 0)
                ->orWhere('status_pj', 1)
                ->orWhere('status_pj', 2);
        })
        ->where('jenis_pinjaman', 0)
        ->orderBy('id', 'DESC');
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

    public function datas($id, Request $request)
    {
        $items = PeminjamanBarangItems::where('barang_id', $id)->select('peminjaman_barang_id')->get();
        foreach ($items as $key => $value)
        {
            $iditems[] = $value->peminjaman_barang_id;
        }
        if (empty($iditems)) {
            $iditems[]=0;
        }
        $datas = PeminjamanBarang::query()->whereIn('id', $iditems)
        ->where(
        function($query) {
            return $query
                ->where('status_pj', 0)
                ->orWhere('status_pj', 1)
                ->orWhere('status_pj', 2);
        })
        ->where('jenis_pinjaman', 1)
        ->orderBy('id', 'DESC');
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
        ->rawColumns(['aksi','status_wd','status_op','status_pj','mahasiswa','nim','j_kel'])
        ->make(true);
    }

    public function detail($id)
    {
        $data['transaksi'] = PeminjamanBarang::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y | H:i ');
        $data['transaksi']['statusx'] = $data['transaksi']['status'];
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
        $data['transaksi']['lama_pinjam'] = $data['transaksi']['lama_pinjam']." Hari";
        $data['mahasiswa'] = Mahasiswa::find($data['transaksi']['mahasiswa_id']);
        $items = PeminjamanBarangItems::where('peminjaman_barang_id', $data['transaksi']['id'])->get();
        foreach($items as $item){
            $data['items'][] = Helper::ambilBarang($item->barang_id).' ('.$item->jumlah.')';
        }
        return Response::json($data);
    }

    public function details($id)
    {
        $data['transaksi'] = PeminjamanBarang::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y');
        $data['transaksi']['statusx'] = $data['transaksi']['status'];
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
        $data['transaksi']['lama_pinjam'] = $data['transaksi']['lama_pinjam']." Hari";
        $data['dosen'] = Dosen::find($data['transaksi']['dosen_id']);
        $items = PeminjamanBarangItems::where('peminjaman_barang_id', $data['transaksi']['id'])->get();
        foreach($items as $item){
            $data['items'][] = Helper::ambilBarang($item->barang_id).' ('.$item->jumlah.')';
        }
        return Response::json($data);
    }

}
