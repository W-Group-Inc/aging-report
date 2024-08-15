<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OPCH extends Model
{
    ////AP Invoice
    protected $connection = 'sqlsrv';
    protected $table = 'OPCH';

    public function items()
    {
        return $this->hasMany(PCH1::class,'DocEntry','DocEntry');
    }
}
