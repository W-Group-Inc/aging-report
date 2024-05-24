<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OINV extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'OINV';
    
    public function payments()
    {
        return $this->hasMany(INV::class,'DocEntry','DocEntry');
    }
    public function warehouse()
    {
        return $this->belongsTo(INV1::class,'DocEntry','DocEntry');
    }
    public function terms()
    {
        return $this->belongsTo(OCTG::class,'GroupNum','GroupNum');
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
