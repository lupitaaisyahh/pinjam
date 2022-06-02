<?php

namespace App\Model\Transaksi;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    protected $table = 'peminjaman_barang';

    protected $guarded = [
        '_token'
    ];
    
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\User\Mahasiswa', 'mahasiswa_id');
    }

    public function barang()
    {
        return $this->hasMany('App\Model\Transaksi\PeminjamanBarangItems', 'peminjaman_barang_id');
    }
}
