<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DLN1_CCC extends Model
{
    protected $connection = 'sqlsrv_ccc';
    protected $table = 'DLN1';

    public function oinvCCC()
    {
        return $this->belongsTo(OINV_CCC::class, 'TrgetEntry', 'DocEntry');
    }
}
