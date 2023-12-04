<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OCTG_PBI extends Model
{
    //
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'OCTG';
}
