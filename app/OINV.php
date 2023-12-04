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
    public function terms()
    {
        return $this->belongsTo(OCTG::class,'GroupNum','GroupNum');
    }
}
