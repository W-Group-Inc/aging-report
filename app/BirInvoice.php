<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirInvoice extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bir_invoices';

    public function products()
    {
        return $this->hasMany(BirInvoiceProduct::class, 'DocNum', 'id')
        ->where(function ($query) {
            $query->whereNull('PbiSiType')
                  ->orWhere('PbiSiType', '=', '');
        });
    }
    public function specialProducts()
    {
        return $this->hasMany(BirInvoiceProduct::class, 'DocNum', 'id')
        ->where(function ($query) {
            $query->Where('PbiSiType', '=', '1');
        });
    }
    public function specialProductsOrig()
    {
        return $this->hasMany(BirInvoiceProduct::class, 'DocNum', 'id')
        ->where(function ($query) {
            $query->Where('PbiSiType', '=', '0');
        });
    }
    public function clientRequest()
    {
        return $this->hasMany(BirInvoiceProduct::class, 'DocNum', 'id')
        ->where('PbiSiType', '=', 'PbiSi');
    }
    public function allProducts()
    {
        return $this->hasMany(BirInvoiceProduct::class, 'DocNum', 'id');
    }
}
