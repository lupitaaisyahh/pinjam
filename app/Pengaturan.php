<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';
}
