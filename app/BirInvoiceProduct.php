<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirInvoiceProduct extends Model
{
    protected $connection = 'mysql';
    public function invoice()
    {
        return $this->belongsTo(BirInvoice::class);
    }
}
