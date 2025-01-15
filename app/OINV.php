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
    public function inv1()
    {
        return $this->hasMany(INV1::class, 'DocEntry', 'DocEntry');
    }
    public function ap_whi()
    {
        return $this->hasMany(PCH1::class,'U_InvoiceNo','U_InvoiceNo');
    }
    public function octgModel()
    {
        return $this->belongsTo(OCTG::class,'GroupNum','GroupNum');
    }
    public function asNew() 
    {
        return $this->hasOne(BirInvoice::class, 'DocNum', 'DocEntry');
    }
    public function ocrdModel()
    {
        return $this->belongsTo(OCRD::class,'CardCode','CardCode');
    }
    public function NewCreditNote() 
    {
        return $this->hasOne(CreditNote::class, 'DocNum', 'DocEntry');
    }
    public function newNonTrade() 
    {
        return $this->hasOne(BillingStatement::class, 'DocNum', 'DocEntry');
    }
    public function ap_has_commision()
    {
        return $this->hasMany(PCH1::class,'U_InvoiceNo2','U_InvoiceNo2');
    }
}
