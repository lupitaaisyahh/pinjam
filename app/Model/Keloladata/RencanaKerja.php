<?php

namespace App\Model\Keloladata;

use Illuminate\Database\Eloquent\Model;

class RencanaKerja extends Model
{
    protected $table = 'kelola_rencana_kerja';

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
    public function indikatorkerja()
    {
        return $this->belongsTo('App\Model\Master\IndikatorKerja', 'master_indikator_kinerja_id');
    }
}
