<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ORDR_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'ORDR';

    public function rdr1()
    {
        return $this->hasMany(RDR1_PBI::class, 'DocEntry', 'DocEntry');
    }
    public function asNew() 
    {
        return $this->hasOne(StatementOfAccount::class, 'DocNum', 'DocEntry');
    }
    public function whiOctgs()
    {
        return $this->belongsTo(OCTG::class,'GroupNum','GroupNum');
    }
}
