<?php

namespace App\Model\Transaksi;

use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    protected $table = 'peminjaman_ruangan';

    protected $guarded = [
        '_token'
    ];
    
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\User\Mahasiswa', 'mahasiswa_id');
    }
    public function ruangan()
    {
        return $this->belongsTo('App\Model\Master\Ruangan', 'ruangan_id');
    }
}
