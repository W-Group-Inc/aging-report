<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class SoaProduct extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $connection = 'mysql';
    // public function invoice()
    // {
    //     return $this->belongsTo(SalesInvoice::class);
    // }
    // public function auditProductHistory()
    // {
    //     return $this->morphMany(\OwenIt\Auditing\Models\Audit::class, 'auditable')
    //     ->where('auditable_type','App\SalesInvoiceProduct');
    // }
}
