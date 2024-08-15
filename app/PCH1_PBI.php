<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCH1_PBI extends Model
{
    //
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'PCH1';

    public function chart_of_account()
    {
        return $this->belongsTo(OACT::class,'AcctCode','AcctCode');
    }
}
