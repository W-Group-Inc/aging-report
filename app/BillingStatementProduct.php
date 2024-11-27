<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingStatementProduct extends Model
{
    protected $connection = 'mysql';
    protected $table = 'billing_statement_products';

    // public function invoice()
    // {
    //     return $this->belongsTo(BirInvoice::class);
    // }
}
