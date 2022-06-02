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
        $this->middleware('auth:wakildekan')->except('logout');
    }

    public function index()
    {
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();
        return view('wakildekan.laporan.peminjamanruangan.index',compact(['ruangan','gedung']));
    }

    public function data(Request $request)
    {
        $datas = PeminjamanRuangan::query()->orderBy('id', 'DESC');
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
            return '
                <center>
                        <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#detail" class="btn btn-icon btn-round btn-info btn-sm detail" data-placement="top" title="" data-original-title="Hapus">
                            <i class="fas fa-eye fa-sm"></i>
                        </a>
                </center>
            ';
        })
        ->addIndexColumn()
        ->rawColumns(['aksi','status_wd','status_op','gedung','status_pj','ruangan'])
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

    public function verifikasi(Request $req)
    {
        // return $req->all();
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
            $datas->status = $req->status;
            $datas->save();
            if ($req->status == 1) {
                $status = "Terverifikasi";
            }else{
                $status = "Tidak Diverifikasi";
            }

            try{
                $text1 = '== Peminjaman Ruangan ==';
                $text2 = 'ID Peminjaman : '.$datas->id;
                $text2 = 'Status : '.$status;
                $text3 = 'Nama : '.$req->nama;
                $text4 = 'NIM : '.$req->nim;
                $text5 = 'Tanggal : '.$req->tgl_transaksi;
                $text6 = 'Gedung : '.$req->gedung;
                $text7 = 'Ruangan : '.$req->ruangan;
                $text8 = 'Jumlah Hari : '.$req->jumlah_hari;
                $text9 = 'Catatan : ';
                $text10 = $datas->catatan;
                $chat_id = Helper::ambilMahasiswa($req->iduser,'chat_id');
                $data = $text1 . "\n" . $text2. "\n" . $text3. "\n" . $text4. "\n" . $text5. "\n" . $text6. "\n" . $text7. "\n" . $text8. "\n" . $text9. "\n" . $text10;
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                echo $e->getMessage();
            }
        }
        return redirect()->route('wakildekan.laporan.peminjamanruangan.index')->with('pesan', 'Data Berhasil Di Verifikasi !');
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        PeminjamanRuangan::find($id)->delete();
        return redirect()->route('wakildekan.laporan.peminjamanruangan.index')->with('pesan', 'Data Berhasil Di Hapus!');
    }

    public function detail($id)
    {
        $data['transaksi'] = PeminjamanRuangan::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y | H:i');
        $data['transaksi']['gedung'] = Helper::AmbilGedung($data['transaksi']->ruangan->gedung_id);
        $data['transaksi']['ruangans'] = $data['transaksi']->ruangan->nama;
        $data['transaksi']['foto'] = $data['transaksi']->ruangan->foto;
        $data['transaksi']['jumlah_hari'] = $data['transaksi']['jumlah_hari'].' Hari';
        if ($data['transaksi']['status'] == 0) {
            $data['transaksi']['status'] = "Belum Diverifikasi";
        }else if ($data['transaksi']['status'] == 1) {
            $data['transaksi']['status'] = 'Terverifikasi';
        }else{
            $data['transaksi']['status'] = "Tidak Diverifikasi";
        }
        $data['mahasiswa'] = Mahasiswa::find($data['transaksi']['mahasiswa_id']);
        return Response::json($data);
    }

}
