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
    public function manager()
    {
        return $this->belongsTo(OSLP::class,'SlpCode','SlpCode');
    }
    public function location()
    {
        return $this->belongsTo(OCDR::class, 'CardCode', 'CardCode')->with('ocrg');
    }
    public function remark() 
    {
        return $this->hasOne(Remark::class, 'docentry', 'DocNum');
    }
}
