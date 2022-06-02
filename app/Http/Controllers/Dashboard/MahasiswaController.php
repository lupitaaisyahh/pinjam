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
use App\Model\User\Mahasiswa as Mahasiswa;
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


class MahasiswaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:mahasiswa');
    }

    public function index()
    {
        $data['barang'] = Barang::where('status', 'aktif')->count();
        $data['ruangan'] = Ruangan::where('status', 'aktif')->count();
        $data['gedung'] = Gedung::count();

        $riwayatruangan['proses'] = PeminjamanRuangan::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','0')->count();
        $riwayatruangan['pinjam'] = PeminjamanRuangan::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','1')->orWhere('status_pj', 2)->count();
        $riwayatruangan['kembali'] = PeminjamanRuangan::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','3')->count();

        $riwayatbarang['proses'] = PeminjamanBarang::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','0')->count();
        $riwayatbarang['pinjam'] = PeminjamanBarang::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','1')->orWhere('status_pj', 2)->count();
        $riwayatbarang['kembali'] = PeminjamanBarang::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','3')->count();

        $riwayatbr = PeminjamanBarang::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','1')->get();
        $riwayatrg = PeminjamanRuangan::where('jenis_pinjaman', 0)->where('mahasiswa_id', Auth::user()->id)->where('status_pj','1')->get();

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
        
        return view('dashboard.mahasiswa', compact(['data','riwayatruangan','riwayatbarang','riwayat','riwayats']));

    } 

    public function profil()
    {
        $data = Mahasiswa::find(Auth::user()->id);
        return view('mahasiswa.profil', compact(['data']));
    }

    public function ubahprofil(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'j_kel' => 'required',
            'no_telp' => 'required',
            'jurusan' => 'required',
            'chat_id' => 'required',
            'ktm' => 'required|max:2048',
        ],
        [   
            'id.required' => 'Masukkan ID.',
            'nama.required' => 'Masukkan Nama.',
            'nim.required' => 'Masukkan NIM.',
            'jurusan.required' => 'Masukkan Jurusan.',
            'email.required' => 'Masukkan E-Mail.',
            'j_kel.required' => 'Masukkan Jenis Kelamin.',
            'no_telp.required' => 'Masukkan No Telp.',
            'chat_id.required' => 'Masukkan Chat ID Telegram.',
            'ktm.required' => 'Masukkan File KTM.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $objek = Mahasiswa::find(Auth::user()->id);
            $objek->nama = $req->nama;
            $objek->nim = $req->nim;
            $objek->username = $req->nim;
            $objek->email = $req->email;
            $objek->j_kel = $req->j_kel;
            $objek->no_telp = $req->no_telp;
            $objek->jurusan = $req->jurusan;
            $objek->chat_id = $req->chat_id;
            if (isset($req->password)) {
                $objek->password = Hash::make($req->password);
            }
            if (Input::hasFile('ktm'))
            {
                $file = Input::file('ktm');
                $path = "public/upload/ktm";
                $today = md5(rand(0,9));
                $fileName = $req->nama."-".date('d-m-Y')."-".rand(100,999).".jpg";
                $file = $file->move($path, $fileName);
                $objek->ktm = $path.'/'.$fileName;
            }else{
                return redirect()->back()->with('message', 'File Gambar Harus Berformat JPG, PNG, JPEG atau GIF !');
            }
            $objek->save();
            return redirect()->route('mahasiswa.profile',  Auth::user()->id)->with('pesan', 'Data Berhasil Di Ubah!');

        }
    }
}
