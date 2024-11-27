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
        return $this->belongsTo(OSLP_CCC::class,'SlpCode','SlpCode');
    }
    public function location()
    {
        return $this->belongsTo(OCDR::class, 'CardCode', 'CardCode')->with('ocrg');
    }
    public function remark() 
    {
        return $this->hasOne(Remark::class, 'docentry', 'DocNum');
    }
    public function ap_whi()
    {
        return $this->hasMany(PCH1_CCC::class,'U_InvoiceNo','U_InvoiceNo');
    }
    public function warehouse()
    {
        return $this->belongsTo(INV_CCC::class,'DocEntry','DocEntry');
    }
    public function octgModel()
    {
        return $this->belongsTo(OCTG_CCC::class,'GroupNum','GroupNum');
    }
    public function NewCreditNote() 
    {
        return $this->hasOne(CreditNote::class, 'DocNum', 'DocEntry');
    }
    
}
