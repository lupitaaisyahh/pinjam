<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $table = 'jenis_barang';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';

}
