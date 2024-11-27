<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingStatement extends Model
{
    protected $connection = 'mysql';
    protected $table = 'billing_statements';

    public function billingProducts()
    {
        return $this->hasMany(BillingStatementProduct::class, 'DocNum', 'id');
    }
    // public function clientRequest()
    // {
    //     return $this->hasMany(BirInvoiceProduct::class, 'DocNum', 'id')
    //     ->where('PbiSiType', '=', 'PbiSi');
    // }
}
