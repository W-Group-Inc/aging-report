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
