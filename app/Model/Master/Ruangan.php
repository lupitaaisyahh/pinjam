<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function gedung()
    {
        return $this->belongsTo('App\Model\Master\Gedung', 'gedung_id');
    }
}
