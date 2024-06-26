<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class INV1 extends Model
{
    //
    protected $connection = 'sqlsrv';
    protected $table = 'INV1';

    public function oinv()
    {
        return $this->belongsTo(OINV::class, 'DocEntry', 'DocEntry');
    }
}
