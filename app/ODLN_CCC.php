<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ODLN_CCC extends Model
{
    protected $connection = 'sqlsrv_ccc';
    protected $table = 'ODLN';
    public function ccc_products()
    {
        return $this->hasMany(DLN1_CCC::class, 'DocEntry', 'DocEntry');
    }

    public function asNew() 
    {
        return $this->hasOne(BirInvoice::class, 'DocNum', 'DocEntry');
    }
    public function cccOctg()
    {
        return $this->belongsTo(OCTG_CCC::class,'GroupNum','GroupNum');
    }
    public function NewCreditNote() 
    {
        return $this->hasOne(CreditNote::class, 'DocNum', 'DocEntry');
    }
    public function PoNumbers() 
    {
        return $this->hasMany(ORDR_CCC::class, 'NumAtCard', 'NumAtCard')->select('U_BuyersPO');
    }
}
