<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $guarded = [
        '_token'
    ];
    
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function jenis()
    {
        return $this->belongsTo('App\Model\Master\JenisBarang', 'jenis_barang_id');
    }

    public function satuan()
    {
        return $this->belongsTo('App\Model\Master\SatuanBarang', 'satuan_barang_id');
    }
}
