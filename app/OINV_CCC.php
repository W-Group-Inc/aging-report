<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OINV_CCC extends Model
{
    //
    protected $connection = 'sqlsrv_ccc';
    protected $table = 'OINV';

    public function payments()
    {
        return $this->hasMany(INV_CCC::class,'DocEntry','DocEntry');
    }
    public function terms()
    {
        return $this->belongsTo(OCTG_CCC::class,'GroupNum','GroupNum');
    }
}
