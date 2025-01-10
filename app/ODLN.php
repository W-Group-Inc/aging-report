<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ODLN extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'ODLN';

    public function inv1()
    {
        return $this->hasMany(INV1::class, 'docentry', 'docentry');
    }
    public function dln1()
    {
        return $this->hasMany(DLN1::class, 'DocEntry', 'DocEntry');
    }
    public function whiOctg()
    {
        return $this->belongsTo(OCTG::class,'GroupNum','GroupNum');
    }
    public function asNew() 
    {
        return $this->hasOne(BirInvoice::class, 'DocNum', 'DocEntry');
    }
}
