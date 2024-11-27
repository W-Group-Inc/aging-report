<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OHEM_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'OHEM';
}
