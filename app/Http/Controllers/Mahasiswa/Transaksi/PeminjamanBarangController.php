<?php

namespace App\Http\Controllers\Mahasiswa\Transaksi;

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
use Carbon\Carbon;

class PeminjamanBarangController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:mahasiswa')->except('logout');
    }

    public function index()
    {
        $barang = Barang::where('status', 'Aktif')->get();
        $jenis = JenisBarang::all();
        return view('mahasiswa.transaksi.peminjamanbarang.index',compact(['jenis','barang']));
    }

    public function tambah(Request $req)
    {
        if (Auth::user()->status == 0)
        {
            return redirect()->back()->with('status', 'Akun Anda Belum Terverifikasi !');
        }

        $validator = Validator::make($req->all(), [
            'iduser' => 'required',
            'tgl_transaksi' => 'required',
            'nama' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required',
        ],
        [   
            'iduser' => 'Masukkan ID User',
            'tgl_transaksi' => 'Masukkan Tanggal Transaksi',
            'nama' => 'Masukkan Nama User',
            'barang_id' => 'Pilih Barang',
            'jumlah' => 'Masukkan Jumlah Barang',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $datas = New PeminjamanBarang;
            $datas->mahasiswa_id = $req->iduser;
            $datas->lama_pinjam = $req->lama_pinjam;
            $datas->status_wd = 0;
            $datas->status_op = 0;
            $datas->status_pj = 0;
            $datas->jenis_pinjaman = 0;
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

            for ($i=0; $i < count($req->barang_id) ; $i++)
            { 
                //simpan data items barang
                $barang = New PeminjamanBarangItems;
                $barang->barang_id = $req->barang_id[$i];
                $barang->jumlah = $req->jumlah[$i];
                $barang->peminjaman_barang_id = $datas->id;
                $barang->save();

                //Mengurangi stok
                $barangkurang = Barang::find($barang->barang_id);
                $barangkurang->jumlah_stok = $barangkurang->jumlah_stok-$barang->jumlah;
                $barangkurang->save();

                $barangall[$req->barang_id[$i]][] = Helper::ambilBarang($req->barang_id[$i]) . ' ('.$req->jumlah[$i].') -';
            }

            $string='';

            try{
                foreach ($barangall as $key => $value) {
                    $text1 = '== Peminjaman Barang ==';
                    $text2 = 'ID Peminjaman : '.$datas->id;
                    $text24 = 'Status Peminjaman : Dalam Proses';
                    $text23 = 'Verifikasi Wakildekan : Belum Diverifikasi';
                    $text25 = 'Verifikasi Operator : Belum Diverifikasi';
                    $text3 = 'Nama : '.$req->nama;
                    $text4 = 'NIM : '.$req->nim;
                    $text41 = 'Lama Peminjaman : '.$datas->lama_pinjam.' Hari';
                    $text5 = 'Tanggal : '.Helper::indonesian_date($req->tgl_transaksi,'j F Y');
                    $text22 = 'Barang :';
                    $text6 = str_replace(array('_', '-', '.'), chr(10), $barangall[$key]);
                    foreach ($text6 as $values){
                       $string .=  '- '.$values;
                    }
                    $text7 = 'Catatan : ';
                    $text8 = $catatan;
                    $chat_id = Helper::ambilMahasiswa($req->iduser,'chat_id');
                    $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n" . $text23. "\n" . $text25. "\n" . $text3. "\n" . $text4. "\n" . $text41. "\n" . $text5. "\n" . $text22. "\n" . $string. "\n" . $text7. "\n" . $text8;
                }
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                echo $e->getMessage();
            }
        }

        return redirect()->route('mahasiswa.laporan.peminjamanbarang.index')->with('pesan', 'Peminjaman Barang Berhasil !');
    }

}
