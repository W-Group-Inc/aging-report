<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCH1_CCC extends Model
{
    //
    protected $connection = 'sqlsrv_ccc';
    protected $table = 'PCH1';

    public function chart_of_account()
    {
        return $this->belongsTo(OACT_CCC::class,'AcctCode','AcctCode');
    }
}
