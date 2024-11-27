<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ORDR_CCC extends Model
{
    protected $connection = 'sqlsrv_ccc';
    protected $table = 'ORDR';

    public function ccc_products()
    {
        return $this->hasMany(RDR1_CCC::class, 'DocEntry', 'DocEntry');
    }

    public function dln1()
    {
        return $this->hasMany(DLN1_PBI::class, 'BaseEntry', 'DocEntry');
    }
}
