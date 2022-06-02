<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Model\Master\JenisBarang as JenisBarang;
use App\Model\Master\SatuanBarang as SatuanBarang;
use App\Model\Master\Barang as Barang;
use App\Model\Master\Gedung as Gedung;
use App\Model\Master\Ruangan as Ruangan;
use App\Model\User\Dosen as Dosen;
use App\Model\Transaksi\PeminjamanBarang as PeminjamanBarang;
use App\Model\Transaksi\PeminjamanRuangan as PeminjamanRuangan;


use Visitor;
use Auth;
use Redirect;
use App;
use Helper;
use File;
use PDF;
use Excel;
use Carbon\Carbon;

class DosenController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:dosen');
    }

    public function index()
    {
        $data['barang'] = Barang::where('status', 'aktif')->count();
        $data['ruangan'] = Ruangan::where('status', 'aktif')->count();
        $data['gedung'] = Gedung::count();

        $riwayatruangan['proses'] = PeminjamanRuangan::where('jenis_pinjaman', 1)->where('status_pj','0')->count();
        $riwayatruangan['pinjam'] = PeminjamanRuangan::where('jenis_pinjaman', 1)->where('status_pj','1')->orWhere('status_pj', 2)->count();
        $riwayatruangan['kembali'] = PeminjamanRuangan::where('jenis_pinjaman', 1)->where('status_pj','3')->count();

        $riwayatbarang['proses'] = PeminjamanBarang::where('jenis_pinjaman', 1)->where('status_pj','0')->count();
        $riwayatbarang['pinjam'] = PeminjamanBarang::where('jenis_pinjaman', 1)->where('status_pj','1')->orWhere('status_pj', 2)->count();
        $riwayatbarang['kembali'] = PeminjamanBarang::where('jenis_pinjaman', 1)->where('status_pj','3')->count();

        $riwayatbr = PeminjamanBarang::where('jenis_pinjaman', 1)->where('status_pj','1')->get();
        $riwayatrg = PeminjamanRuangan::where('jenis_pinjaman', 1)->where('status_pj','1')->get();

        foreach ($riwayatbr as $key => $value) {
            $Dday = Carbon::parse($value->tgl_transaksi);
            $daynew = $Dday->addDays($value->lama_pinjam)->toDateString();

            $hariini =  Carbon::now()->toDateString();
            $satuhari =  Carbon::now()->addDays(1)->toDateString();
            // return $daynew->toDateString();

            if ($daynew == $hariini) {
                $riwayat['hariini'][$value->id] = $value->id;
            }
            if ($daynew < $hariini) {
                $riwayat['lewat'][$value->id] = $value->id;
            }
            if ($daynew == $satuhari) {
                $riwayat['satuhari'][$value->id] = $value->id;
            }
        }


        foreach ($riwayatrg as $keys => $values) {
            $Ddays = Carbon::parse($values->tgl_transaksi);
            $daynews = $Ddays->addDays($values->lama_pinjam)->toDateString();

            $hariinis =  Carbon::now()->toDateString();
            $satuharis =  Carbon::now()->addDays(1)->toDateString();
            // return $daynews->toDateString();

            if ($daynews == $hariinis) {
                $riwayats['hariini'][$values->id] = $values->id;
            }
            if ($daynews < $hariinis) {
                $riwayats['lewat'][$values->id] = $values->id;
            }
            if ($daynews == $satuharis) {
                $riwayats['satuhari'][$values->id] = $values->id;
            }
        }

        if (empty($riwayat)) {
            $riwayat =[];
        }
        if (empty($riwayats)) {
            $riwayats =[];
        }
        
        return view('dashboard.dosen', compact(['data','riwayatruangan','riwayatbarang','riwayat','riwayats']));

    }  

    public function profil()
    {
        $data = Dosen::find(Auth::user()->id);
        return view('dosen.profil', compact(['data']));
    }

    public function ubahprofil(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',
            'chat_id' => 'required',

        ],
        [   
            'id.required' => 'Masukkan ID.',
            'nama.required' => 'Masukkan Nama.',
            'email.required' => 'Masukkan E-Mail.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
            'chat_id.required' => 'Masukkan Chat ID Telegram.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $objek = Dosen::find(Auth::user()->id);
            $objek->nama = $req->nama;
            $objek->username = $req->username;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            $objek->chat_id = $req->chat_id;
            if (isset($req->password)) {
                $objek->password = Hash::make($req->password);
            }
            $objek->save();
            return redirect()->route('dosen.profil',  Auth::user()->id)->with('pesan', 'Data Berhasil Di Ubah!');

        }
    } 
}
