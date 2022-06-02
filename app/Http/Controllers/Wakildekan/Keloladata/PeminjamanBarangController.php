<?php

namespace App\Http\Controllers\Wakildekan\Keloladata;

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

class PeminjamanBarangController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:wakildekan')->except('logout');
    }

    public function index()
    {
        $barang = Barang::where('status', 'Aktif')->get();
        $jenis = JenisBarang::all();
        return view('wakildekan.keloladata.peminjamanbarang.index',compact(['jenis','barang']));
    }

    public function data(Request $request)
    {
        $datas = PeminjamanBarang::query()
        ->where(
        function($query) {
             return $query
                    ->where('status_pj', 0)
                    ->orWhere('status_pj', 1);
        })
        ->where('jenis_pinjaman', 0)->orderBy('id', 'DESC');
        if ($request->jenisxx !='') 
        {
            $datas = $datas->where('jenis_barang_id', 'like', '%' . $request->jenisxx . '%');
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
        ->addColumn('no_telp', function($data)
        {
            return Helper::ambilMahasiswa($data->mahasiswa_id,'no_telp');
        })
        ->addColumn('barang', function($data)
        {
            if (isset($data->barang)) {
                foreach ($data->barang as $barangs){
                    $datax[] = '<button type="button" class="btn btn-danger btn-xs">'.Helper::ambilBarang($barangs->barang_id).' ('.$barangs->jumlah.')</button> ';
                }
                return implode(" ",$datax);
            }else{
                return '<button type="button" class="btn btn-danger btn-xs">-</button> ';
            }
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
                return '<center><code style="color:green !important;">Proses Pengembalian</code></center>';
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
        ->rawColumns(['aksi','status_wd','status_op','barang','status_pj'])
        ->make(true);
    }

    public function datas(Request $request)
    {
        $datas = PeminjamanBarang::query()
        ->where(
        function($query) {
             return $query
                    ->where('status_pj', 0)
                    ->orWhere('status_pj', 1);
        })
        ->where('jenis_pinjaman', 1)->orderBy('id', 'DESC');
        if ($request->jenisxx !='') 
        {
            $datas = $datas->where('jenis_barang_id', 'like', '%' . $request->jenisxx . '%');
        }
        return Datatables::of($datas)
        ->addColumn('nama', function($data)
        {
            return Helper::ambilDosen($data->dosen_id,'nama');
        })
        ->addColumn('j_kel', function($data)
        {
            return Helper::ambilDosen($data->dosen_id,'j_kel');
        })
        ->addColumn('no_telp', function($data)
        {
            return Helper::ambilDosen($data->dosen_id,'no_telp');
        })
        ->addColumn('barang', function($data)
        {
            if (isset($data->barang)) {
                foreach ($data->barang as $barangs){
                    $datax[] = '<button type="button" class="btn btn-danger btn-xs">'.Helper::ambilBarang($barangs->barang_id).' ('.$barangs->jumlah.')</button> ';
                }
                return implode(" ",$datax);
            }else{
                return '<button type="button" class="btn btn-danger btn-xs">-</button> ';
            }
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
                return '<center><code style="color:green !important;">Proses Pengembalian</code></center>';
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
        ->rawColumns(['aksi','status_wd','status_op','barang','status_pj'])
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
            $datas = PeminjamanBarang::find($req->idtransaksi);
            $datas->status_wd = $req->status;
            $datas->tgl_verifikasi_wd = $req->tgl_verifikasi_wd;

            if ($datas->status_wd == 1) {
                $datas->status_pj = 0;
                $datas->status_op = 0;
            }else{
                $datas->status_pj = 4;
                $datas->status_op = 2;
            }

            $datas->save();

            $items = PeminjamanBarangItems::where('peminjaman_barang_id', $req->idtransaksi)->get();
            foreach($items as $itemsx)
            { 
                $barangall[$itemsx->barang_id][] = Helper::ambilBarang($itemsx->barang_id) . ' ('.$itemsx->jumlah.') -';
            }
            $string='';

            try{
                foreach ($barangall as $key => $value) {
                    $text1 = '== Peminjaman Barang ==';
                    $text2 = 'ID Peminjaman : '.$datas->id;
                    if ($datas->status_wd == 1) {
                        $text24 = 'Status Peminjaman : Sedang Diproses';
                        $text25 = 'Verifikasi Wakildekan : Terverifikasi';
                        $text26 = 'Tanggal Verifikasi WD : '.$datas->tgl_verifikasi_wd;
                        $text23 = 'Verifikasi Operator : Belum Diverifikasi';
                    }else{
                        $text24 = 'Status Peminjaman : Tidak Disetujui';
                        $text25 = 'Verifikasi Wakildekan : Tidak Diverifikasi';
                        $text26 = 'Tanggal Verifikasi WD : '.$datas->tgl_verifikasi_wd;
                        $text23 = 'Verifikasi Operator : Tidak Diverifikasi';
                    }
                    $text3 = 'Nama : '.$req->nama;
                    $text4 = 'NIM : '.$req->nim;
                    $text41 = 'Lama Peminjaman : '.$datas->lama_pinjam.' Hari';
                    $text5 = 'Tanggal Peminjaman : '.Helper::indonesian_date($datas->tgl_transaksi,'j F Y | H:i');
                    $text22 = 'Barang :';
                    $text6 = str_replace(array('_', '-', '.'), chr(10), $barangall[$key]);
                    foreach ($text6 as $values){
                       $string .=  '- '.$values;
                    }
                    $text7 = 'Catatan : ';
                    $text8 = $datas->catatan;
                    $chat_id = Helper::ambilMahasiswa($req->iduser,'chat_id');
                    $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n" . $text25. "\n" . $text26. "\n" . $text23. "\n" . $text3. "\n" . $text4. "\n". $text41. "\n" . $text5. "\n" . $text22. "\n" . $string. "\n" . $text7. "\n" . $text8;
                }
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        return redirect()->route('wakildekan.keloladata.peminjamanbarang.index')->with('pesan', 'Data Berhasil Di Verifikasi !');
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
            $datas = PeminjamanBarang::find($req->idtransaksi);
            $datas->status_wd = $req->status;
            $datas->tgl_verifikasi_wd = $req->tgl_verifikasi_wd;

            if ($datas->status_wd == 1) {
                $datas->status_pj = 0;
                $datas->status_op = 0;
            }else{
                $datas->status_pj = 4;
                $datas->status_op = 2;
            }
            $datas->save();

            $items = PeminjamanBarangItems::where('peminjaman_barang_id', $req->idtransaksi)->get();
            foreach($items as $itemsx)
            { 
                $barangall[$itemsx->barang_id][] = Helper::ambilBarang($itemsx->barang_id) . ' ('.$itemsx->jumlah.') -';
            }
            $string='';

            try{
                foreach ($barangall as $key => $value) {
                    $text1 = '== Peminjaman Barang ==';
                    $text2 = 'ID Peminjaman : '.$datas->id;
                    if ($datas->status_wd == 1) {
                        $text24 = 'Status Peminjaman : Sedang Diproses';
                        $text25 = 'Verifikasi Wakildekan : Terverifikasi';
                        $text26 = 'Tanggal Verifikasi WD : '.$datas->tgl_verifikasi_wd;
                        $text23 = 'Verifikasi Operator : Belum Diverifikasi';
                    }else{
                        $text24 = 'Status Peminjaman : Tidak Disetujui';
                        $text25 = 'Verifikasi Wakildekan : Tidak Diverifikasi';
                        $text26 = 'Tanggal Verifikasi WD : '.$datas->tgl_verifikasi_wd;
                        $text23 = 'Verifikasi Operator : Tidak Diverifikasi';
                    }
                    $text3 = 'Nama Dosen: '.$req->nama;
                    $text41 = 'Lama Peminjaman : '.$datas->lama_pinjam.' Hari';
                    $text5 = 'Tanggal Peminjaman : '.Helper::indonesian_date($datas->tgl_transaksi,'j F Y | H:i');
                    $text22 = 'Barang :';
                    $text6 = str_replace(array('_', '-', '.'), chr(10), $barangall[$key]);
                    foreach ($text6 as $values){
                       $string .=  '- '.$values;
                    }
                    $text7 = 'Catatan : ';
                    $text8 = $datas->catatan;
                    $chat_id = Helper::ambilDosen($req->iduser,'chat_id');
                    $data = $text1 . "\n" . "\n" . $text2. "\n" . $text24. "\n" . $text25. "\n" . $text26. "\n" . $text23. "\n" . $text3. "\n" . $text41. "\n" . $text5. "\n" . $text22. "\n" . $string. "\n" . $text7. "\n" . $text8;
                }
                
                $response = Telegram::sendMessage([
                  'chat_id' => $chat_id, 
                  'text' => $data
                ]);
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        return redirect()->route('wakildekan.keloladata.peminjamanbarang.index')->with('pesan', 'Data Berhasil Di Verifikasi !');
    }

    public function hapus(Request $req)
    {
        $id = $req->id;
        PeminjamanBarang::find($id)->delete();
        return redirect()->route('wakildekan.keloladata.peminjamanbarang.index')->with('pesan', 'Data Berhasil Di Hapus!');
    }

    public function detail($id)
    {
        $data['transaksi'] = PeminjamanBarang::find($id);
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y | H:i');
        if (isset($data['transaksi']['tgl_kembali'])) {
            $data['transaksi']['tgl_kembali'] = $data['transaksi']['tgl_kembali'];
        }else{
            $data['transaksi']['tgl_kembali'] = '-';
        }
        if (isset($data['transaksi']['catatan'])) {
            $data['transaksi']['catatan'] = $data['transaksi']['catatan'];
        }else{
            $data['transaksi']['catatan'] = '-';
        }
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
        $data['transaksi']['tgl_transaksi'] = Helper::indonesian_date($data['transaksi']['tgl_transaksi'],'j F Y | H:i');
        if (isset($data['transaksi']['tgl_kembali'])) {
            $data['transaksi']['tgl_kembali'] = $data['transaksi']['tgl_kembali'];
        }else{
            $data['transaksi']['tgl_kembali'] = '-';
        }
        if (isset($data['transaksi']['catatan'])) {
            $data['transaksi']['catatan'] = $data['transaksi']['catatan'];
        }else{
            $data['transaksi']['catatan'] = '-';
        }
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
