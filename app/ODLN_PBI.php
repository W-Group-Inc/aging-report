<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ODLN_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'ODLN';

    public function dln1()
    {
        return $this->hasMany(DLN1_PBI::class, 'DocEntry', 'DocEntry');
    }
    public function octgModel()
    {
        return $this->belongsTo(OCTG_PBI::class,'GroupNum','GroupNum');
    }
    public function asNew() 
    {
        return $this->hasOne(BirInvoice::class, 'DocNum', 'DocEntry');
    }
}
