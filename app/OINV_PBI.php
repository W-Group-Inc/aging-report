<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OINV_PBI extends Model
{
    //
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'OINV';

    public function payments()
    {
        return $this->hasMany(INV_PBI::class,'DocEntry','DocEntry');
    }
    public function terms()
    {
        return $this->belongsTo(OCTG_PBI::class,'GroupNum','GroupNum');
    }
}
