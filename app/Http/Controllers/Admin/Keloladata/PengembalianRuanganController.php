<?php

namespace App\Http\Controllers\Admin\Keloladata;

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

class PengembalianRuanganController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index()
    {
        $ruangan = Ruangan::all();
        return view('admin.keloladata.pengembalianruangan.index',compact(['ruangan']));
    }

    public function data(Request $request)
    {
        $datas = PeminjamanRuangan::query()
        ->where(
        function($query) {
             return $query
                    ->where('status_pj', 2);
        })
        ->where('jenis_pinjaman', 0)
        ->orderBy('id', 'DESC');
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
            return Helper::indonesian_date($data->tgl_transaksi,'j F Y | H:i');
        })
        ->addColumn('aksi', function ($data)
        {
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#verifikasi" class="btn btn-icon btn-round btn-primary btn-sm verifikasi" data-placement="top" title="" data-original-title="verifikasi">
                            <i class="fas fa-check fa-sm"></i>
                        </a>
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

    public function datas(Request $request)
    {
        $datas = PeminjamanRuangan::query()
        ->where(
        function($query) {
             return $query
                    ->where('status_pj', 2);
        })
        ->where('jenis_pinjaman', 1)
        ->orderBy('id', 'DESC');
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
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#verifikasis" class="btn btn-icon btn-round btn-primary btn-sm verifikasis" data-placement="top" title="" data-original-title="verifikasis">
                            <i class="fas fa-check fa-sm"></i>
                        </a>
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

    public function verifikasi(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'idtransaksi' => 'required',
            'status' => 'required',
        ],
        [   
            'idtransaksi' => 'Masukkan ID Transaksi',
            'status' => 'Pilih Status Verifikasi',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = PeminjamanRuangan::find($req->idtransaksi);
            if ($req->status == 1) {
                $datas->status_pj = 3;
            }else{
                $datas->status_pj = 3;
            }
            $datas->save();

            $ruangan = Ruangan::find($datas->ruangan_id);
            $ruangan->status_pj=0;
            $ruangan->save();

            try{
                $text1 = '== Peminjaman Ruangan ==';
                $text2 = 'ID Peminjaman : '.$datas->id;
                $text24 = 'Status Peminjaman : Selesai';
                $text29 = 'Pengembalian Terverifikasi, Ruangan Sudah Tidak Digunakan Lagi.';
                $text3 = 'Nama : '.$req->nama;
                $text4 = 'NIM : '.$req->nim;
                $text41 = 'Lama Peminjaman : '.$req->lama_pinjamxs;
                $text5 = 'Tanggal Peminjaman: '.Helper::indonesian_date($datas->tgl_transaksi,'j F Y | H:i ');
                $text51 = 'Tanggal Pengembalian: '.Helper::indonesian_date($datas->tgl_kembali,'j F Y | H:i ');
                $text6 = 'Gedung : '.$req->gedungs;
                $text71 = 'Ruangan : '.$req->ruangans;
                $text7 = 'Catatan : ';
                $text8 = $datas->catatan_kmbl;
                $chat_id = Helper::ambilMahasiswa($req->iduser,'chat_id');
                $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n" . $text3. "\n" . $text4. "\n". $text41. "\n" . $text5. "\n" . $text51. "\n" . $text6. "\n" . $text71. "\n" . $text7. "\n" . $text8. "\n" . "\n" . $text29;
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        return redirect()->route('admin.keloladata.pengembalianruangan.index')->with('pesan', 'Data Berhasil Di Verifikasi !');
    }

    public function verifikasis(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'idtransaksi' => 'required',
            'status' => 'required',
        ],
        [   
            'idtransaksi' => 'Masukkan ID Transaksi',
            'status' => 'Pilih Status Verifikasi',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = PeminjamanRuangan::find($req->idtransaksi);
            if ($req->status == 1) {
                $datas->status_pj = 3;
            }else{
                $datas->status_pj = 3;
            }
            $datas->save();

            $ruangan = Ruangan::find($datas->ruangan_id);
            $ruangan->status_pj=0;
            $ruangan->save();

            try{
                $text1 = '== Peminjaman Ruangan ==';
                $text2 = 'ID Peminjaman : '.$datas->id;
                $text24 = 'Status Peminjaman : Selesai';
                $text29 = 'Pengembalian Terverifikasi, Ruangan Sudah Tidak Digunakan Lagi.';
                $text3 = 'Nama Dosen : '.$req->nama;
                $text41 = 'Lama Peminjaman : '.$req->lama_pinjamxs;
                $text5 = 'Tanggal Peminjaman: '.Helper::indonesian_date($datas->tgl_transaksi,'j F Y | H:i ');
                $text51 = 'Tanggal Pengembalian: '.Helper::indonesian_date($datas->tgl_kembali,'j F Y | H:i ');
                $text6 = 'Gedung : '.$req->gedungs;
                $text71 = 'Ruangan : '.$req->ruangans;
                $text7 = 'Catatan : ';
                $text8 = $datas->catatan_kmbl;
                $chat_id = Helper::ambilDosen($req->iduser,'chat_id');
                $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n" . $text3. "\n" . $text41. "\n" . $text5. "\n" . $text51. "\n" . $text6. "\n" . $text71. "\n" . $text7. "\n" . $text8. "\n" . "\n" . $text29;
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        return redirect()->route('admin.keloladata.pengembalianruangan.index')->with('pesan', 'Data Berhasil Di Verifikasi !');
    }

    public function detail($id)
    {
        $data['transaksi'] = PeminjamanRuangan::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y | H:i');
        if (isset($data['transaksi']['tgl_kembali'])) {
            $data['transaksi']['tgl_kembali'] = Helper::indonesian_date($data['transaksi']['tgl_kembali'],'j F Y | H:i');
        }else{
            $data['transaksi']['tgl_kembali'] = '-';
        }
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
        if (isset($data['transaksi']['tgl_kembali'])) {
            $data['transaksi']['tgl_kembali'] = Helper::indonesian_date($data['transaksi']['tgl_kembali'],'j F Y');
        }else{
            $data['transaksi']['tgl_kembali'] = '-';
        }
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
