<?php

namespace App\Model\Keloladata;

use Illuminate\Database\Eloquent\Model;

class NilaiRencanaKerja extends Model
{
    protected $table = 'kelola_kontrak_kerja_bidang';

    protected $guarded = [
        '_token'
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function bidang()
    {
        return $this->belongsTo('App\Model\Master\Bidang', 'master_bidang_id');
    }

    public function kontrakkerja()
    {
        return $this->belongsTo('App\Model\Master\KontrakKerja', 'master_kontrak_kerja_id');
    }
}
