<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCH1 extends Model
{
    ////Items of AP invoice
    protected $connection = 'sqlsrv';
    protected $table = 'PCH1';

    public function chart_of_account()
    {
        return $this->belongsTo(OACT::class,'AcctCode','AcctCode');
    }
}
