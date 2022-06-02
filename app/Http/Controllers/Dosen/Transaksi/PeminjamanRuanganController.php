<?php

namespace App\Http\Controllers\Dosen\Transaksi;

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
use App\Model\User\Dosen as Dosen;

use Auth;
use Redirect;
use App;
use Helper;
use Response;
use Telegram;
use Carbon\Carbon;

class PeminjamanRuanganController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:dosen')->except('logout');
    }

    public function index()
    {
        $gedung = Gedung::all();
        return view('dosen.transaksi.peminjamanruangan.index',compact(['gedung']));
    }

    public function tambah(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'iduser' => 'required',
            'tgl_transaksi' => 'required',
            'nama' => 'required',
            'idruangan' => 'required',
            'jumlah_hari' => 'required',
        ],
        [   
            'iduser' => 'Masukkan ID User',
            'tgl_transaksi' => 'Masukkan Tanggal Transaksi',
            'nama' => 'Masukkan Nama User',
            'idruangan' => 'Pilih Ruangan',
            'jumlah_hari' => 'Masukkan Jumlah Hari',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = New PeminjamanRuangan;
            $datas->dosen_id = Auth::user()->id;
            $datas->ruangan_id = $req->idruangan;
            $datas->jumlah_hari = $req->jumlah_hari;
            $datas->status_wd = 0;
            $datas->status_op = 0;
            $datas->status_pj = 0;
            $datas->jenis_pinjaman = 1;
            date_default_timezone_set('Asia/Jakarta'); 

            $currentDateTime = Carbon::now();
            $datas->tgl_transaksi = $currentDateTime->toDateTimeString();
            if (isset($req->catatan)) {
                $datas->catatan = $req->catatan;
                $catatan = $req->catatan;
            }else{
                $catatan = '';
            }
            $datas->save();

            $ruangan = Ruangan::find($datas->ruangan_id);
            $ruangan->status_pj = 1;
            $ruangan->save();

            try{
                $text1 = '== Peminjaman Ruangan ==';
                $text2 = 'ID Peminjaman : '.$datas->id;
                $text24 = 'Status Peminjaman : Dalam Proses';
                $text23 = 'Verifikasi Wakildekan : Belum Diverifikasi';
                $text25 = 'Verifikasi Operator : Belum Diverifikasi';
                $text3 = 'Nama Dosen: '.$req->nama;
                $text5 = 'Tanggal Peminjaman: '.Helper::indonesian_date($req->tgl_transaksi,'j F Y');
                $text6 = 'Gedung : '.$req->namagedung;
                $text7 = 'Ruangan : '.$req->namaruangan;
                $text8 = 'Jumlah Hari : '.$req->jumlah_hari.' Hari';
                $text9 = 'Catatan : ';
                $text10 = $catatan;
                $chat_id = Auth::user()->chat_id;
                $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n". $text23. "\n". $text25. "\n" . $text3. "\n" . $text5. "\n" . $text6. "\n" . $text7. "\n" . $text8. "\n" . $text9. "\n" . $text10;
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                echo $e->getMessage();
            }
        }
        return redirect()->route('dosen.laporan.peminjamanruangan.index')->with('pesan', 'Peminjaman Barang Berhasil !');
    }

    public function detail($id)
    {
        $data['ruangan'] = Ruangan::where('gedung_id', $id)->where('status_pj', 0)->get();
        return Response::json($data);
    }

}
