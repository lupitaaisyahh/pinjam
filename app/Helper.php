<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;


class Helper
{
    public static function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
        
        if (trim ($timestamp) == '')
        {
                $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
            $timestamp = strtotime ($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia 😛
        $date_format = preg_replace ("/S/", "", $date_format);

        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
            'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
            'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date}";

        return $date;
    }

    public static function dataAplikasi($parm) 
    {
        $result = DB::table('pengaturan')->select('*')->where('id', 1)->first();

        $datas['url'] = isset($_SERVER['HTTPS']) ? 'https://'.$_SERVER['HTTP_HOST'] : 'http://'.$_SERVER['HTTP_HOST'];
        $datas['aplikasi'] = isset($result->aplikasi) ? $result->aplikasi : '';
        $datas['pemilik'] = isset($result->pemilik) ? $result->pemilik : '';
        $datas['kode_pos'] = isset($result->kode_pos) ? $result->kode_pos : '';
        $datas['website'] = isset($result->website) ? $result->website : '';
        $datas['folder'] = isset($result->folder) ? $result->folder : '';
        $datas['singkatan'] = isset($result->singkatan) ? $result->singkatan : '';
        $datas['telp'] = isset($result->telp) ? $result->telp : '';
        $datas['email'] = isset($result->email) ? $result->email : '';
        $datas['alamat'] = isset($result->alamat) ? $result->alamat : '';
        $datas['version'] = isset($result->version) ? $result->version : '1.1';
        $datas['logo'] = isset($result->logo) ? $result->logo : '/public/bower_components/admin/img/key.png';
        $datas['favicon'] = isset($result->favicon) ? $result->favicon : '/public/bower_components/admin/img/favicon.png';

        return $datas[$parm];
    }

    public static function Ngcurl($url) 
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,0); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOSIGNAL, 1);
        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);
        $content = curl_exec($curl);
        curl_close($curl);
        if ($curl_errno > 0) {
        } else {                
            return $content;
        }
    }

    public static function wordCutString($text, $chars = 25) {
        if (strlen($text) <= $chars) {
            return $text;
        }
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text.".";
        return $text;
    }

    public static function ambilBarang($id) 
    {
        $data = DB::table('barang')->select('nama')->where('id', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->nama;
        }
    }

    public static function ambilIdItemsBarang($id) 
    {
        $data = DB::table('peminjaman_barang_items')->select('barang_id','jumlah')->where('peminjaman_barang_id', $id )->get();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data;
        }
    }

    public static function ambilTransaksiBarang($id,$parm) 
    {
        $data = DB::table('peminjaman_barang')->select($parm)->where('id', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->$parm;
        }
    }

    public static function ambilTransaksiRuangan($id,$parm) 
    {
        $data = DB::table('peminjaman_ruangan')->select($parm)->where('id', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->$parm;
        }
    }

    public static function ambilRuangan($id,$parm) 
    {
        $data = DB::table('ruangan')->select($parm)->where('id', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->$parm;
        }
    }
    
    public static function ambilItemsBarang($id,$parm) 
    {
        $data = DB::table('peminjaman_barang_items')->select($parm)->where('peminjaman_barang_id', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->$parm;
        }
    }

    public static function ambilGedung($id) 
    {
        $data = DB::table('gedung')->select('gedung')->where('id', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->gedung;
        }
    }

    public static function ambilMahasiswa($id,$parm) 
    {
        $data = DB::table('mahasiswa')->select($parm)->where('id', '=', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->$parm;
        }
    }

    public static function ambilDosen($id,$parm) 
    {
        $data = DB::table('user_dosen')->select($parm)->where('id', '=', $id )->first();
        if (empty($data)){
            $data = '-';
            return $data;
        }else{
            return $data->$parm;
        }
    }
}


// AND
// $results = SomeModel::where('location', $location)->where('blood_group', $bloodGroup)->get();

// OR
// $results = SomeModel::where('location', $location)->orWhere('blood_group', $bloodGroup)->get();