<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedung';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';

}
