<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ORDR_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'ORDR';
}
