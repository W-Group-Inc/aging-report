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
        return $this->belongsTo(OSLP_PBI::class,'SlpCode','SlpCode');
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
        return $this->hasMany(PCH1_PBI::class,'U_InvoiceNo','U_InvoiceNo');
    }
    public function warehouse()
    {
        return $this->belongsTo(INV_PBI::class,'DocEntry','DocEntry');
    }
    public function octgModel()
    {
        return $this->belongsTo(OCTG_PBI::class,'GroupNum','GroupNum');
    }
    public function ap_has_commision()
    {
        return $this->hasMany(PCH1_PBI::class,'U_InvoiceNo2','U_InvoiceNo2');
    }

}
