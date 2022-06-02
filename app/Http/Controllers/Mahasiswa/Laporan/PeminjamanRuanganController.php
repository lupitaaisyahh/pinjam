<?php

namespace App\Http\Controllers\Mahasiswa\Laporan;

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
        $this->middleware('auth:mahasiswa')->except('logout');
    }

    public function index()
    {
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();
        return view('mahasiswa.laporan.peminjamanruangan.index',compact(['ruangan','gedung']));
    }

    public function data(Request $request)
    {
        $datas = PeminjamanRuangan::query()->orderBy('id', 'DESC')->where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id);
        if ($request->statusss !='') 
        {
            $datas = $datas->where('status_pj', 'like', '%' . $request->statusss . '%');
        }
        return Datatables::of($datas)
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
            if ($data->status_wd == 0) {
                return '
                    <center>
                            <a href="#" data-id="'.$data->id.'" title="Hapus" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm hapusbtn" data-placement="top" title="" data-original-title="Hapus">
                                <i class="fas fa-trash fa-sm"></i>
                            </a>
                            <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="Hapus">
                                <i class="fas fa-eye fa-sm"></i>
                            </a>
                    </center>
                ';
            }else{
                if ($data->status_pj == 1) {
                    return '
                        <center>
                                <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#pengembalian" class="btn btn-icon btn-round btn-primary btn-sm pengembalian" data-placement="top" title="" data-original-title="pengembalian">
                                    <i class="fas fa-reply fa-sm"></i>
                                </a>
                                <a href="#" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm disabled" data-placement="top" title="" data-original-title="Hapus">
                                    <i class="fas fa-trash fa-sm"></i>
                                </a>
                                <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="Hapus">
                                    <i class="fas fa-eye fa-sm"></i>
                                </a>
                        </center>
                    ';
                }else{
                    return '
                        <center>
                                <a href="#" rel="tooltip" class="btn btn-icon btn-round btn-danger btn-sm disabled" data-placement="top" title="" data-original-title="Hapus">
                                    <i class="fas fa-trash fa-sm"></i>
                                </a>
                                <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="Hapus">
                                    <i class="fas fa-eye fa-sm"></i>
                                </a>
                        </center>
                    ';
                }
            }
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status_pj','status_op','status_wd','ruangan','gedung'])
        ->make(true);
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        $ruanganx = PeminjamanRuangan::find($id);

        $ruangan = Ruangan::find($ruanganx->ruangan_id);
        $ruangan->status_pj = 0;
        $ruangan->save();

        $ruanganx->delete();
        return redirect()->route('mahasiswa.laporan.peminjamanruangan.index')->with('pesan', 'Data Berhasil Di Hapus!');
    }

    public function pengembalian(Request $req)
    {
        // return $req->all();
        $validator = Validator::make($req->all(), [
            'idtransaksi' => 'required',
        ],
        [   
            'idtransaksi' => 'Masukkan ID Transaksi',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = PeminjamanRuangan::find($req->idtransaksi);
            $datas->status_pj = 2;
            date_default_timezone_set('Asia/Jakarta'); 
            $datas->tgl_kembali = date("Y-m-d H:i:s");
            if (isset($req->catatan_kmbl)) {
                $datas->catatan_kmbl = $req->catatan_kmbl;
                $catatan_kmbl = $req->catatan_kmbl;
            }else{
                $catatan_kmbl = '';
            }
            $datas->save();
            $string='';

            try{
                    $text1 = '== Peminjaman Ruangan ==';
                    $text2 = 'ID Peminjaman : '.$datas->id;
                    if ($datas->status_pj == 2) {
                        $text24 = 'Status Peminjaman : Proses Pengembalian';
                    }else{
                        $text24 = 'Status Peminjaman : Sedang Dipinjam';
                    }
                    $text3 = 'Nama : '.$req->nama;
                    $text4 = 'NIM : '.$req->nim;
                    $text41 = 'Lama Peminjaman : '.$req->lama_pinjamxs;
                    $text5 = 'Tanggal Peminjaman: '.Helper::indonesian_date($datas->tgl_transaksi,'j F Y | H:i');
                    $text51 = 'Tanggal Pengembalian: '.Helper::indonesian_date($datas->tgl_kembali,'j F Y | H:i');
                    $text6 = 'Gedung : '.$req->gedungs;
                    $text71 = 'Ruangan : '.$req->ruangans;
                    $text7 = 'Catatan : ';
                    $text8 = $catatan_kmbl;
                    $chat_id = Helper::ambilMahasiswa($req->iduser,'chat_id');
                    $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n". $text3. "\n" . $text4. "\n". $text41. "\n" . $text5. "\n" . $text51. "\n" . $text6. "\n" . $text71. "\n" . $string. "\n" . $text7. "\n" . $text8;
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        return redirect()->route('mahasiswa.laporan.peminjamanruangan.index')->with('pesan', 'Data Berhasil Di Simpan !');
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
        $data['mahasiswa'] = Mahasiswa::find(Auth::user()->id);
        return Response::json($data);
    }

}
