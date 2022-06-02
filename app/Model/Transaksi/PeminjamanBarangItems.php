<?php

namespace App\Model\Transaksi;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBarangItems extends Model
{
    protected $table = 'peminjaman_barang_items';

    protected $guarded = [
        '_token'
    ];
    
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function transaksi()
    {
        return $this->belongsTo('App\Model\Transaksi\PeminjamanBarang', 'peminjaman_barang_id');
    }

    public function barang()
    {
        return $this->belongsTo('App\Model\Master\Barang', 'barang_id');
    }
}
