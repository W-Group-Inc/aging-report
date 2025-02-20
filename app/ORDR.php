<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ORDR extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'ORDR';

    public function whiOctgs()
    {
        return $this->belongsTo(OCTG::class,'GroupNum','GroupNum');
    }
    public function rdr1()
    {
        return $this->hasMany(RDR1::class, 'DocEntry', 'DocEntry');
    }
    public function asNew() 
    {
        return $this->hasOne(StatementOfAccount::class, 'DocNum', 'DocEntry');
    }
}
