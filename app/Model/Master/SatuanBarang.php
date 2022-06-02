<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    protected $table = 'satuan_barang';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';

}
