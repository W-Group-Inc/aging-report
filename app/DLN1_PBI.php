<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DLN1_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'DLN1';

    public function odln()
    {
        return $this->belongsTo(ODLN_PBI::class, 'DocEntry', 'DocEntry');
    }
    public function ordrPbi()
    {
        return $this->belongsTo(ORDR_PBI::class, 'BaseEntry', 'DocEntry');
    }
    public function oinvPbi()
    {
        return $this->belongsTo(OINV_PBI::class, 'TrgetEntry', 'DocEntry');
    }
}
