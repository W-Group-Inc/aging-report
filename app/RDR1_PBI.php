<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RDR1_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'RDR1';
}
