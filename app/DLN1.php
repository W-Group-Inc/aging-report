<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DLN1 extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'DLN1';

    public function oinvWhi()
    {
        return $this->belongsTo(OINV::class, 'TrgetEntry', 'DocEntry');
    }
}
