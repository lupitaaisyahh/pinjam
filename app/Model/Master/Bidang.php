<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'master_bidang';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';

}
